<template>
  <div>
      <a href="/cart/index" style="color: black;">
        <button class="btn btn-warning primary float-right mr-3">
        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
        <p>{{ getCartItems.length }}</p>
      </button>
    </a>
  </div>
</template>

<script>
    import { mapGetters } from 'vuex';
    import { mapActions } from 'vuex';
    import { VueGoodTable } from 'vue-good-table';
    import 'vue-good-table/dist/vue-good-table.css';

    export default {
        name: 'cart-component',
        computed: {
            ...mapGetters(
                'cartItem', ['getCartItems'])
        },
        methods: {
            ...mapActions(
                'cartItem',
                [
                    'setCartItems',
                ]),
        },
        created() {
            this.setCartItems();
        },
    }
</script>
