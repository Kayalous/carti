<template>
    <AppLayout flex gray>
        <div class="container mx-auto flex flex-col items-center justify-center flex-grow py-10 relative z-10">

            <h1
                class="mx-auto mb-6 text-3xl font-extrabold tracking-tighter text-center text-cool-gray-700 sm:text-4xl lg:text-6xl sm:leading-none"
            >
                <span class="inline-block underlined">Manage</span> your
                <br class="hidden md:block"/>
                products with ease

            </h1>
            <p
                class="text-base text-center text-gray-700 md:text-lg max-w-2xl"
            >
                Blue bottle crucifix four dollar toast vegan taxidermy bottle
                crucifix four dollar toast vegan taxidermy bottle crucifix.

            </p>

            <inertia-link
                href="/merchant/product/new"
                class="inline-flex items-center justify-center h-12 px-6 mt-5 font-medium tracking-wide text-white transition duration-200 bg-teal-500 rounded shadow-md  hover:bg-teal-600 focus:shadow-outline focus:outline-none"
            >
                New Product +
            </inertia-link>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 mt-10 px-2">
                <MerchantProductCard v-for="product in products" :product="product" :key="product.id"/>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import MerchantProductCard from "@/components/MerchantProductCard";

export default {
    name: "MerchantInventory",
    props: ['products'],
    components: {
        AppLayout,
        MerchantProductCard
    }
}
</script>

<style scoped>

</style>
