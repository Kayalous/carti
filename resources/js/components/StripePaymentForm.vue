<template>
    <div></div>
</template>

<script>


export default {

    props: ['session'],

    async mounted() {
        let stripe = Stripe(this.$page.props.stripeKey);

        stripe.redirectToCheckout({sessionId: this.session.id});

    }
};
</script>
