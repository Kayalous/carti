<template>

    <div class="mx-auto flex flex-wrap max-w-6xl w-full flex-grow p-5 shadow rounded-md bg-white">
        <img :alt="product.name" class="lg:w-1/2 w-full h-64 sm:h-auto object-contain rounded "
             :src="product.image">
        <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0 flex flex-grow flex-col justify-between">
            <div>
                <h2 class="text-sm title-font text-gray-500 tracking-widest text-teal-500">PRODUCT</h2>
                <h1 class="text-blue-gray-900 text-3xl title-font font-medium mb-5">{{ product.name }}</h1>
                <p class="leading-relaxed">{{ product.description }}</p>
                <p class="text-gray-400 mt-2">In stock: {{ product.qty }}</p>
            </div>
            <div class="flex justify-between">
                <span class="title-font font-medium text-2xl text-blue-gray-700">{{ product.price }} EGP</span>
                <div
                    class="flex flex-nowrap gap-x-5 items-center justify-center transition duration-200 ease-in-out">
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

<style scoped>

</style>
