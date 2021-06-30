<template>
    <AppLayout gray flex center>
        <div class="h-full flex-grow flex flex-col justify-center px-2 w-full pb-4">
            <ProductCRUD :product="product" :header="`Edit ${product.name}.`" button="Save Changes" deletable=true submitRoute="merchant.product.update"/>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import ProductCRUD from "@/components/ProductCRUD";


export default {
    props: ['product'],
    components: {
        AppLayout,
        ProductCRUD

    },
}
</script>

<style scoped>

</style>
