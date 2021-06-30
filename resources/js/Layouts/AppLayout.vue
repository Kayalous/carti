<template>
    <div>
        <jet-banner/>

        <div
            class="min-h-screen overflow-x-hidden max-w-screen flex w-full flex-col"
            :class="{'bg-gray-50' : gray}"
        >
            <Navbar/>
            <!-- Page Heading -->
            <!--            <header class="bg-white shadow" v-if="$slots.header">-->
            <!--                <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">-->
            <!--                    <slot name="header"></slot>-->
            <!--                </div>-->
            <!--            </header>-->

            <!-- Page Content -->
            <main class="pt-20 flex-grow" :class="{'flex flex-col' : flex, 'justify-center items-center' : center}">
                <slot></slot>
            </main>
            <!-- Footer -->
            <Footer/>
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
        flex: Boolean,
        center: Boolean
    },

    updated() {
        if (this.$page.props.flash.error)
            this.showAlert('error', this.$page.props.flash.error)
        if (this.$page.props.flash.success)
            this.showAlert('success', this.$page.props.flash.success)
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

::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

::-webkit-scrollbar-track {
    background-color: #D4D4D8;
}

::-webkit-scrollbar-track-piece {
    background-color: #fafafa;
}

::-webkit-scrollbar-thumb {
    height: 50px;
    background-color: #D4D4D8;
    border-radius: 3px;
}

::-webkit-scrollbar-corner {
    background-color: #fafafa;
}

::-webkit-resizer {
    background-color: #D4D4D8;
}

.underlined {
    position: relative !important;
}

.underlined:after {
    z-index: -1;
    content: "";
    position: absolute;
    bottom: 0;
    right: -2.5%;
    width: 105%;
    height: 33%;
    border-radius: 10px;
    background: #99f6e4;
    transform: skewX(-10deg) rotate(-2deg);
}

.underlined.alt:after {
    transform: skewX(10deg) rotate(1deg);
}



</style>
