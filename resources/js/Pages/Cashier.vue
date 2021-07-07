<template>
    <AppLayout gray flex>
        <div class="h-full flex-grow flex flex-col justify-center px-2 w-full pb-4">
            <div
                class="sm:max-w-xl w-full flex-grow mx-auto shadow rounded-md overflow-hidden lg:max-w-5xl bg-white flex flex-col pt-5">
                <div v-if="items" class="flex flex-grow flex-col w-full ">
                    <div class="w-full p-2 sm:p-5 flex-grow">
                        <h1 class="text-4xl text-center mb-10"><span class="text-teal-500 font-bold">{{
                                customer.name
                            }}</span>'s items.</h1>
                        <div class="grid grid-cols-6 mt-6 mb-3">
                            <p class="text-xs sm:text-base text-base col-span-3">Item</p>
                            <p class="text-xs sm:text-base text-base ">Quantity</p>
                            <p class="text-xs sm:text-base text-base  whitespace-nowrap">Unit price</p>
                            <p class="text-xs sm:text-base text-base ">Total</p>
                        </div>
                        <div v-for="item in items" :key="item.id"
                             class="grid grid-cols-6 border-t py-2 sm:px-2 transition duration-200 ease-in-out rounded-md sm:hover:bg-gray-50">
                            <div class="flex items-center col-span-3">
                                <img :src="item.image"
                                     class="rounded-full w-12 h-12 object-contain border border-gray-200">
                                <div class="flex flex-col ml-3">
                                    <inertia-link :href="`/products/${item.id}`"
                                                  class="text-xs sm:text-base text-gray-700 dark:text-white">
                                        {{ item.name }}
                                    </inertia-link>

                                    <p class="text-xs font-light text-gray-400">#{{ item.barcode }}</p>
                                </div>
                            </div>
                            <p class="text-xs sm:text-base text-gray-700">{{ item.qty }}</p>
                            <p class="text-xs sm:text-base text-gray-700">{{ item.price.toFixed(2) }} EGP</p>
                            <p class="text-xs sm:text-base text-gray-700">{{ (item.qty * item.price).toFixed(2) }}
                                EGP</p>
                        </div>
                    </div>
                    <div class="bg-gray-50 w-full p-5 flex flex-col items-end justify-end">

                        <div class="grid grid-cols-6 w-full text-lg">
                            <div class="col-span-4 sm:col-span-5 flex items-center pl-12">

                                <p class="ml-3">Grand Total</p>
                            </div>
                            <p class="text-green-500 whitespace-nowrap">{{ total.toFixed(2) }} EGP</p>
                        </div>
                        <jet-button class="mx-auto mt-10" type="button" @click.native.prevent="checkoutCustomer">
                            Confirm Checkout
                        </jet-button>
                    </div>
                </div>
                <div v-else class="flex flex-col flex-grow w-full items-center justify-center px-2 pb-5">
                    <img class="w-64 h-64 object-contain" :src="`/images/cashierQR-${$page.props.user.id}.png`"
                         alt="Cashier QR Code">
                    <h2 class=" max-w-lg mx-auto mt-6 text-3xl font-extrabold tracking-tighter text-center text-cool-gray-700 sm:text-4xl sm:leading-none">
                        {{
                            customer_id ? 'Fetching customer data...' : 'Waiting for customers.'
                        }}

                    </h2>

                    <div class="max-w-lg w-full mx-auto flex items-center justify-center my-5" v-if="customer_id">
                        <div class="sk-cube-grid">
                            <div class="sk-cube sk-cube1"></div>
                            <div class="sk-cube sk-cube2"></div>
                            <div class="sk-cube sk-cube3"></div>
                            <div class="sk-cube sk-cube4"></div>
                            <div class="sk-cube sk-cube5"></div>
                            <div class="sk-cube sk-cube6"></div>
                            <div class="sk-cube sk-cube7"></div>
                            <div class="sk-cube sk-cube8"></div>
                            <div class="sk-cube sk-cube9"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import JetButton from '@/Jetstream/Button'

export default {
    name: "Cashier",
    components: {
        AppLayout,
        JetButton
    },
    data() {
        return {
            items: null,
            total: null,
            customer: null,
            customer_id: null
        }
    },
    mounted() {
        let pusher = new Pusher('abf9f95fc1f7398a615d', {
            cluster: 'eu',
            authEndpoint: "/broadcasting/auth",
        });

        let channel = pusher.subscribe(`checkout-channel.${this.$page.props.user.id}`)

        channel.bind('newCheckout', (data) => {
            this.customer_id = data.user_id;

            this.fetchCustomerData()

        })
    },
    methods: {
        fetchCustomerData() {
            let vm = this;
            //CSRF token
            let token = document.head.querySelector('meta[name="csrf-token"]');

            this.axios({
                method: "POST",
                url: route('cashier.summary'),
                data: {
                    'customer_id': vm.customer_id,
                }
            })
                .then((response) => {

                    vm.customer = response.data.customer
                    vm.items = response.data.items
                    vm.total = response.data.total

                }).catch((res) => {
                console.log(res)
            })

        },
        checkoutCustomer() {

            let form = this.$inertia.form({
                _method: 'POST',
                customer_id: this.customer_id
            });

            form.post(route('cashier.checkout'), {
                onSuccess: (msg) => {
                    if (msg.props.flash.success)
                        this.showAlert('success', msg.props.flash.success);
                    else if (msg.props.flash.info)
                        this.showAlert('info', msg.props.flash.info);

                    this.resetCustomer();
                },
                onError: (msg) => {
                    this.showAlert('error', 'Something went wrong. Try again.')
                },
                preserveScroll: true
            });
        },
        resetCustomer() {
            this.items = null
            this.total = null
            this.customer = null
            this.customer_id = null
        }
    }
}
</script>

<style scoped>
.sk-cube-grid {
    width: 40px;
    height: 40px;
}

.sk-cube-grid .sk-cube {
    width: 33%;
    height: 33%;
    background-color: #333;
    float: left;
    -webkit-animation: sk-cubeGridScaleDelay 1.3s infinite ease-in-out;
    animation: sk-cubeGridScaleDelay 1.3s infinite ease-in-out;
}

.sk-cube-grid .sk-cube1 {
    -webkit-animation-delay: 0.2s;
    animation-delay: 0.2s;
}

.sk-cube-grid .sk-cube2 {
    -webkit-animation-delay: 0.3s;
    animation-delay: 0.3s;
}

.sk-cube-grid .sk-cube3 {
    -webkit-animation-delay: 0.4s;
    animation-delay: 0.4s;
}

.sk-cube-grid .sk-cube4 {
    -webkit-animation-delay: 0.1s;
    animation-delay: 0.1s;
}

.sk-cube-grid .sk-cube5 {
    -webkit-animation-delay: 0.2s;
    animation-delay: 0.2s;
}

.sk-cube-grid .sk-cube6 {
    -webkit-animation-delay: 0.3s;
    animation-delay: 0.3s;
}

.sk-cube-grid .sk-cube7 {
    -webkit-animation-delay: 0s;
    animation-delay: 0s;
}

.sk-cube-grid .sk-cube8 {
    -webkit-animation-delay: 0.1s;
    animation-delay: 0.1s;
}

.sk-cube-grid .sk-cube9 {
    -webkit-animation-delay: 0.2s;
    animation-delay: 0.2s;
}

@-webkit-keyframes sk-cubeGridScaleDelay {
    0%, 70%, 100% {
        -webkit-transform: scale3D(1, 1, 1);
        transform: scale3D(1, 1, 1);
    }
    35% {
        -webkit-transform: scale3D(0, 0, 1);
        transform: scale3D(0, 0, 1);
    }
}

@keyframes sk-cubeGridScaleDelay {
    0%, 70%, 100% {
        -webkit-transform: scale3D(1, 1, 1);
        transform: scale3D(1, 1, 1);
    }
    35% {
        -webkit-transform: scale3D(0, 0, 1);
        transform: scale3D(0, 0, 1);
    }
}
</style>
