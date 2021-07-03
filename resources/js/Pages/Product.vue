<template>
    <AppLayout gray flex center>
        <section class="text-gray-600 body-font overflow-hidden flex flex-grow w-full">
            <div class="container mx-auto flex flex-grow md:py-10 p-2 md:px-0">
        <ProductPreview :product="product"/>
            </div>
        </section>
    </AppLayout>
</template>

<script>
import ProductPreview from "@/components/ProductPreview";
import AppLayout from "@/Layouts/AppLayout";

export default {
    props: ['product'],
    name: "Product",
    components: {
        AppLayout,
        ProductPreview
    }
}
</script>

<style scoped>

</style>
