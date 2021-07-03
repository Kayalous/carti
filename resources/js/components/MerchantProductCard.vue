<template>
    <div
        class="w-full overflow-hidden bg-white group rounded-lg shadow-md border border-gray-200 dark:bg-gray-800 flex flex-col items-center justify-between">
        <div class="px-4 py-2 w-full">
            <h3 class="text-xs font-medium text-teal-600 uppercase dark:text-teal-400">Product</h3>
            <inertia-link :href="`/merchant/product/update/${product.id}`"
                          class="text-3xl font-bold text-gray-800 uppercase dark:text-white font-sans">{{
                    product.name
                }}
            </inertia-link>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ product.description }}
            </p>
            <p class="mt-1 text-xs text-teal-400">
                In stock: {{ product.qty }}
            </p>
        </div>

        <div class="w-full">

            <inertia-link :href="`/merchant/product/update/${product.id}`">
                <img class="object-contain w-full h-48 mt-2 py-4"
                     :src="product.image"
                     :alt="product.name"/>
            </inertia-link>
            <div class="flex items-center justify-between px-4 py-2 bg-gray-900">
                <h1 class="text-lg font-bold text-white">{{ product.price.toFixed(2) }} EGP</h1>
                <div
                    class="flex flex-nowrap gap-x-5 items-center justify-center opacity-100 md:opacity-0 group-hover:opacity-100 focus-within:opacity-100 transition duration-200 ease-in-out">
                    <inertia-link
                        :href="`/merchant/product/update/${product.id}`"
                        class="inline-flex font-sans transition duration-200 ease-in-out border border-transparent items-center px-4 py-2 bg-yellow-500 rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:bg-yellow-600 focus:outline-none focus:border-yellow-300 focus:shadow-outline-yellow active:bg-gray-50 transition ease-in-out duration-150">
                        Edit
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit w-5 h-5 ml-2" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                            <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                            <line x1="16" y1="5" x2="19" y2="8" />
                        </svg>
                    </inertia-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['product'],
    name: "MerchantProductCard"
}
</script>

<style scoped>

</style>
