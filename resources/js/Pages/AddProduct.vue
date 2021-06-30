<template>
    <AppLayout gray flex center>
        <div class="h-full flex-grow flex flex-col justify-center px-2 w-full pb-4">
            <ProductCRUD :product="product" resetAfterSubmit=true header="Add a new product" button="Add product" submitRoute="merchant.product.add"/>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import ProductCRUD from "@/components/ProductCRUD";


export default {
    name: "AddProduct",
    components: {
        AppLayout,
        ProductCRUD

    },
    data() {
        return {
            product: {
                name: '',
                image: null,
                description: '',
                qty: 1,
                weight: 0.0,
                price: 0,
            }
        }
    }
}
</script>

<style scoped>

</style>
