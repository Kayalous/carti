<template>
    <div
        class="w-full overflow-hidden bg-white group rounded-lg shadow-md border border-gray-200 dark:bg-gray-800 flex flex-col items-center justify-between">
        <div class="px-4 py-2 w-full">
            <h3 class="text-xs font-medium text-teal-600 uppercase dark:text-teal-400">Product</h3>
            <inertia-link :href="`/products/${product.id}`"
                          class="text-3xl font-bold text-gray-800 uppercase dark:text-white font-sans">{{
                    product.name
                }}
            </inertia-link>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ product.description }}
            </p>
            <p class="mt-1 text-xs text-gray-400">
                In stock: {{ product.qty }}
            </p>
        </div>

        <div class="w-full">

            <inertia-link :href="`/products/${product.id}`">
                <img class="object-contain w-full h-48 mt-2 py-4"
                     :src="product.image"
                     :alt="product.name"/>
            </inertia-link>
            <div class="flex items-center justify-between px-4 py-2 bg-gray-900">
                <h1 class="text-lg font-bold text-white">{{ product.price.toFixed(2) }} EGP</h1>
                <div
                    class="flex flex-nowrap gap-x-5 items-center justify-center opacity-100 md:opacity-0 group-hover:opacity-100 focus-within:opacity-100 transition duration-200 ease-in-out">
                    <div
                        title="Quantity"
                        class="flex flex-nowrap items-center justify-center w-24 h-8 shadow transition duration-200 ease-in-out">
                        <button @click="form.qty -= 1"
                                class="transition duration-200 ease-in-out bg-gray-200 text-gray-600 h-full hover:text-gray-700 flex-grow hover:bg-gray-300 rounded-l cursor-pointer outline-none">
                            <span class="font-thin">−</span>
                        </button>
                        <input type="number"
                               class="transition focus:ring-0 h-8 duration-200 px-1 ease-in-out !outline-none focus:!outline-none focus:!shadow-none focus:!border-0 hover:bg-gray-300 !shadow-none !border-0 text-center w-10 bg-gray-200 font-semibold text-md hover:text-black focus:text-black  md:text-basecursor-default flex items-center text-gray-700"
                               name="custom-input-number"
                               v-model="form.qty"
                               min="1"
                               :max="product.qty"
                               placeholder="1"

                        />
                        <button @click="form.qty += 1"
                                class="transition duration-200 ease-in-out bg-gray-200 text-gray-600 h-full hover:text-gray-700 flex-grow hover:bg-gray-300 rounded-r cursor-pointer outline-none">
                            <span class="font-thin">+</span>
                        </button>
                    </div>
                    <button
                        @click="addToCart"
                        type="button"
                        class="inline-flex transition duration-200 ease-in-out border border-transparent items-center px-4 py-2 bg-teal-500 rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:bg-teal-600 focus:outline-none focus:border-teal-300 focus:shadow-outline-teal active:bg-gray-50 transition ease-in-out duration-150">
                        Add To Cart
                        <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M3 3H5L5.4 5M7 13H17L21 5H5.4M7 13L5.4 5M7 13L4.70711 15.2929C4.07714 15.9229 4.52331 17 5.41421 17H17M17 17C15.8954 17 15 17.8954 15 19C15 20.1046 15.8954 21 17 21C18.1046 21 19 20.1046 19 19C19 17.8954 18.1046 17 17 17ZM9 19C9 20.1046 8.10457 21 7 21C5.89543 21 5 20.1046 5 19C5 17.8954 5.89543 17 7 17C8.10457 17 9 17.8954 9 19Z"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['product'],
    name: "ProductCard",
    data() {
        return {
            form: this.$inertia.form({
                _method: 'post',
                product_id: this.product.id,
                qty: 1
            })
        }
    },
    methods: {
        addToCart() {
            if (!this.$page.props.user) {
                this.showAlert('error', 'Please login to add this product to your cart.')
                return;
            }
            this.form.post(route('cart.add'), {
                onSuccess: (msg) => {

                    if (msg.props.flash.success)
                        this.showAlert('success', msg.props.flash.success);
                    else if (msg.props.flash.info)
                        this.showAlert('info', msg.props.flash.info);

                    this.form.qty = 1;
                },
                onError: (msg) => {

                    this.showAlert('error', 'Check the data you entered for errors.')
                    console.log(msg)

                },
                preserveScroll: true,
            });
        }
    },
    watch: {
        'form.qty': function (val) {
            if (val < 1) this.form.qty = 1
            else if (val > this.product.qty) this.form.qty = this.product.qty
            this.form.qty = parseInt(this.form.qty);
        }
    }
}
</script>

<style>

</style>
