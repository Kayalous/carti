<template>
  <AppLayout>
    <Hero />
    <how-it-works />
    <Features />
    <CTA />
  </AppLayout>
</template>


<script>
import AppLayout from "@/Layouts/AppLayout";
import Hero from "@/components/Hero";
import HowItWorks from "@/components/HowItWorks";
import Features from "@/components/Features";
import CTA from "@/components/CTA";

export default {
  components: {
    AppLayout,
    Hero,
    HowItWorks,
    Features,
    CTA,
  },
};
</script>
    HowItWorks
