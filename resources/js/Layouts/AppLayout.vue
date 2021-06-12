<template>
  <div>
      <jet-banner />

    <div
      class="min-h-screen overflow-x-hidden max-w-screen"
      :class="[gray ? 'bg-gray-50' : '']"
    >
      <Navbar />
      <!-- Page Heading -->
      <!--            <header class="bg-white shadow" v-if="$slots.header">-->
      <!--                <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">-->
      <!--                    <slot name="header"></slot>-->
      <!--                </div>-->
      <!--            </header>-->

      <!-- Page Content -->
      <main class="mt-12 min-h-[calc(100vh-251px)]">
        <slot></slot>
      </main>
      <!-- Footer -->
      <Footer />
      <!-- Modal Portal -->
      <portal-target name="modal" multiple></portal-target>
    </div>
  </div>
</template>

<script>
import JetBanner from "@/Jetstream/Banner";
import Navbar from "../components/Navbar";
import Footer from "../components/Footer";

export default {
  props: {
    gray: Boolean,
  },
  components: {
    JetBanner,
    Navbar,
    Footer,
  },
};
</script>

<style>
/*@import url("https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap");*/
@import url("https://fonts.googleapis.com/css2?family=Oxygen:wght@300;400;700&display=swap");
@import url("https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;400;500;600;700&display=swap");

p, a {
  /* font-family: "Oxygen", sans-serif; */
  font-family: "Josefin Sans", sans-serif;
}
</style>
