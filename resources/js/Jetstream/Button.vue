<template>
    <button :type="type" class="inline-flex border border-transparent items-center px-4 py-2 bg-teal-500 rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:bg-teal-600 focus:outline-none focus:border-teal-300 focus:shadow-outline-teal active:bg-gray-50 transition ease-in-out duration-150">
        <slot></slot>
    </button>
</template>

<script>
    export default {
        props: {
            type: {
                type: String,
                default: 'submit',
            },
        }
    }
</script>
