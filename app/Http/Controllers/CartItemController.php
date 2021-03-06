<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CartItemController extends Controller
{
    public function store(Request $request)
    {
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

        $cartItem = CartItem::where('product_id', $request->productId)
            ->where('cart_id', $cart->id)
            ->first();

        if ($cartItem === null) {
            $cartItem = CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $request->productId,
                'quantity' => 1
            ]);

            $message = 'New item added to cart!';
        } else {
            $cartItem->quantity= $cartItem->quantity + 1;
            $cartItem->save();

            $message = 'Quantity increased!';
        }

        return response()->json([
            'cartItem' => $cartItem,
            'status' => 'success',
            'message' => $message
        ]);
    }

    public function update(Request $request, $id)
    {
        $cartItem = CartItem::find($id);

        if (!is_numeric($request->value)) {

            $request->value == 'increase' ? $cartItem->quantity++ : $cartItem->quantity--;
            $message = $request->value == 'increase' ? 'Quantity increased!' : 'Quantity decreased';

            $cartItem->save();

            return response()->json([
                'quantity' => $cartItem->quantity,
                'status' => 'success',
                'message' => $message
            ]);
        }

        $cartItem->quantity = $request->value;

        $cartItem->save();

        return response()->json([
            'quantity' => $cartItem->quantity,
            'status' => 'success',
            'message' => 'Quantity updated!'
        ]);
    }

    public function destroy(CartItem $cartItem)
    {
        $cartItem->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Item removed!'
        ]);
    }
}
