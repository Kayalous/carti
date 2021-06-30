<template>
    <AppLayout>
        <StripePaymentForm :session="session"/>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import StripePaymentForm from "@/components/StripePaymentForm";

export default {
    name: "Checkout",
    props: ['session'],
    components: {
        AppLayout,
        StripePaymentForm
    },
}
</script>

<style scoped>

</style>

