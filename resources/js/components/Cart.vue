<template>
    <div class="h-full flex-grow flex flex-col justify-center px-2 w-full pb-4">

        <div
            class="sm:max-w-xl w-full flex-grow mx-auto shadow rounded-md overflow-hidden lg:max-w-5xl bg-white flex flex-col py-5">
            <div v-if="items.length > 0" class="flex flex-grow flex-col w-full">
                <div class="w-full p-5 flex-grow">
                    <h1 class="text-xl">Shopping Cart</h1>
                    <div class="grid grid-cols-6 mt-6  mb-3">
                        <p class="text-xs sm:text-base text-base col-span-3">Item</p>
                        <p class="text-xs sm:text-base text-base ">Quantity</p>
                        <p class="text-xs sm:text-base text-base  whitespace-nowrap">Unit price</p>
                        <p class="text-xs sm:text-base text-base ">Total</p>
                    </div>
                    <div v-for="item in items" :key="item.id" class="grid grid-cols-6 border-t py-3">
                        <div class="flex items-center col-span-3">
                            <img :src="item.image"
                                 class="rounded-full w-12">
                            <div class="flex flex-col ml-3">
                                <p class="text-xs sm:text-base text-gray-700">{{ item.name }}</p>
                                <p class="text-xs font-light text-gray-400">#{{ item.id }}</p>
                            </div>
                        </div>
                        <p class="text-xs sm:text-base text-gray-700">{{ item.qty }}</p>
                        <p class="text-xs sm:text-base text-gray-700">{{ item.price.toFixed(2) }} EGP</p>
                        <p class="text-xs sm:text-base text-gray-700">{{ (item.qty * item.price).toFixed(2) }} EGP</p>
                    </div>
                </div>
                <div class="bg-gray-50 w-full p-5 flex flex-col items-end justify-end">

                    <div class="grid grid-cols-6 w-full text-lg">
                        <div class="col-span-5 flex items-center pl-12">

                            <p class="ml-3">Grand Total</p>
                        </div>
                        <p class="text-green-500 whitespace-nowrap">{{ total.toFixed(2) }} EGP</p>
                    </div>
                    <a
                        href="/user/cart/checkout"
                        class="inline-flex mt-5 mx-auto items-center justify-center h-12 px-6 font-medium tracking-wide text-white transition duration-200 bg-teal-500 rounded shadow-md  hover:bg-teal-600 focus:shadow-outline focus:outline-none"
                    >
                        Proceed to checkout
                    </a>
                </div>
            </div>
            <div v-else class="flex flex-col flex-grow w-full items-center justify-center px-2">
                <img class="w-64 h-64 object-contain" src="/images/floating.svg" alt="No items in cart">
                <h2 class=" max-w-lg mx-auto mt-6 text-3xl font-extrabold tracking-tighter text-center text-cool-gray-700 sm:text-4xl sm:leading-none">Nothing's here.</h2>
                <p
                    class="w-full max-w-xl text-lg sm:text-xl mt-4 text-center text-gray-600 leading-tight dark:text-dark-theme-300"
                >
                    There aren't any products in your cart, if you think this is an error try refreshing the page, if the issue persists contact a sales representative.
                </p>
                <div class="flex flex-nowrap mt-5">
                    <a
                        href="/user/cart"
                        class="inline-flex items-center justify-center h-12 px-6 font-medium tracking-wide text-white transition duration-200 bg-teal-500 rounded shadow hover:bg-teal-600 focus:shadow-outline focus:outline-none"
                    >
                        Refresh
                    </a>
                    <a
                        href="/"
                        class="inline-flex ml-5 items-center justify-center h-12 px-6 font-medium tracking-wide text-gray-600 transition duration-200 rounded hover:text-purple-700 focus:shadow-outline focus:outline-none">
                        Home
                    </a>
                </div>


            </div>
        </div>
    </div>

</template>

<script>
export default {
    name: "Cart",
    props: ['items', 'total']
}
</script>

<style scoped>

</style>
