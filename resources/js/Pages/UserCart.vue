<template>
    <AppLayout gray flex>
            <Cart :total="total" :items="items" />
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import Cart from "@/components/Cart";


export default {
    props: [
        'items',
        'total'
    ],
    components: {
        AppLayout,
        Cart
    },
    mounted() {
        console.log(this.items)
    }
};
</script>

<style scoped>

</style>
