<template>
    <AppLayout gray flex center>
        <div class="max-w-lg w-full px-2 flex flex-col items-center justify-center ">
            <div class="bg-white shadow w-full h-full py-16 flex flex-col items-center justify-center rounded-md">


                <svg
                    class="checkmark"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 52 52"
                >
                    <circle
                        class="checkmark__circle"
                        cx="26"
                        cy="26"
                        r="25"
                        fill="none"
                    />
                    <path
                        class="checkmark__check text-teal-500"
                        stroke="currentColor"
                        fill="none"
                        d="M14.1 27.2l7.1 7.2 16.7-16.8"
                    />
                </svg>
                <div>
                    <h3
                        class="max-w-lg mx-auto mt-6 text-3xl font-extrabold tracking-tighter text-center text-cool-gray-700 sm:text-4xl sm:leading-none"
                    >
                        Payment successful!
                    </h3>
                    <p
                        class="w-full text-lg mt-4 text-center text-gray-600 leading-tight dark:text-dark-theme-300"
                    >
                        Thank you for your purchase!
                        <br/>
                        A receipt will be emailed to you shortly.
                    </p>
                </div>
                <div class="flex flex-nowrap mt-5">
                    <a
                        href="/"
                        class="inline-flex items-center justify-center h-12 px-6 font-medium tracking-wide text-white transition duration-200 bg-teal-500 rounded shadow hover:bg-teal-600 focus:shadow-outline focus:outline-none"
                    >
                        Go home
                    </a>

                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";

export default {
    name: "PaymentSuccess",
    components: {AppLayout}
}
</script>

<style scoped>
.checkmark {
    width: 56px;
    height: 56px;
    border-radius: 50%;
    display: block;
    stroke-width: 2;
    stroke: #fff;
    stroke-miterlimit: 10;
    box-shadow: inset 0px 0px 0px #7ac142;
    animation: fill 0.4s ease-in-out 0.4s forwards,
    scale 0.3s ease-in-out 0.9s both;
}

.checkmark__circle {
    stroke-dasharray: 166;
    stroke-dashoffset: 166;
    stroke-width: 2;
    stroke-miterlimit: 10;
    stroke: #91F2E1;
    fill: none;
    animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
}

.checkmark__check {
    transform-origin: 50% 50%;
    stroke-dasharray: 48;
    stroke-dashoffset: 48;
    animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
}

@keyframes stroke {
    100% {
        stroke-dashoffset: 0;
    }
}

@keyframes scale {
    0%,
    100% {
        transform: none;
    }
    50% {
        transform: scale3d(1.1, 1.1, 1);
    }
}

@keyframes fill {
    100% {
        box-shadow: inset 0px 0px 0px 30px #91F2E1;
    }
}
</style>
