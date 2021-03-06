<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_types')->insert([
            'name' => 'paperback',
            'description' => Str::random(10),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('product_types')->insert([
            'name' => 'digital',
            'description' => Str::random(10),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
