<template>
    <AppLayout flex gray>


        <div class="container mx-auto flex-grow relative z-10 py-10">
            <div class="flex flex-col items-center justify-between flex-grow">
                <h1
                    class="mx-auto mb-6 text-3xl font-extrabold tracking-tighter text-center text-cool-gray-700 sm:text-4xl lg:text-6xl sm:leading-none"
                >
                    A <span class="inline-block underlined">vast</span> collection
                    <br class="hidden md:block"/>
                    of products to choose from

                </h1>
                <p
                    class="text-base text-center text-gray-700 md:text-lg max-w-lg"
                >
                    Blue bottle crucifix four dollar toast vegan taxidermy bottle
                    crucifix four dollar toast vegan taxidermy bottle crucifix.

                </p>

                <div
                    class="max-w-4xl w-full p-2 flex items-center justify-center mt-5">
                    <div class="border border-gray-200 shadow-md rounded-md bg-white w-full p-5">


                        <div class="relative w-full">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="w-5 h-5 text-gray-400" viewBox="0 0 24 24" fill="none">
                                <path
                                    d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </svg>
                        </span>

                            <jet-input v-model="q" type="text" class="w-full pl-10"
                                       placeholder="Search"/>
                        </div>

                        <jet-label class="mt-3" value="Price Range: "/>
                        <vue-slider class="w-full" tooltip-dir="bottom" v-model="range" lazy
                                    :min="Math.floor(minPrice)"
                                    :max="Math.ceil(maxPrice) + 1" :tooltip-merge="true"
                                    :enable-cross="false"/>

                        <jet-label class="mt-3 mb-2" value="Sort by: "/>
                        <div class="flex">
                            <jet-dropdown align="left" width="48">
                                <template #trigger>
                                    <button type="button"
                                            class=" border border-gray-300 bg-white dark:bg-gray-800 shadow-sm flex items-center justify-center rounded-md  px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-50 hover:bg-gray-50 dark:hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-gray-500">
                                        Price
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="ml-2 icon icon-tabler icon-tabler-arrows-down-up" width="15"
                                             height="15" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                             fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <line x1="17" y1="3" x2="17" y2="21"/>
                                            <path d="M10 18l-3 3l-3 -3"/>
                                            <line x1="7" y1="21" x2="7" y2="3"/>
                                            <path d="M20 6l-3 -3l-3 3"/>
                                        </svg>
                                    </button>
                                </template>
                                <template #content>
                                    <ul class="">
                                        <li @click="sort.price = 'desc'"
                                            class="cursor-pointer flex flex-col justify-center block px-4 py-2 text-md text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-100 dark:hover:text-white dark:hover:bg-gray-600"
                                            :class="[sort.price === 'desc' ? 'bg-gray-50' : '']"
                                        >
                                            <p class="flex items-center">Descending
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     class="ml-1 w-3 h-3" viewBox="0 0 24 24" stroke-width="2"
                                                     stroke="currentColor"
                                                     fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <line x1="12" y1="5" x2="12" y2="19"/>
                                                    <line x1="18" y1="13" x2="12" y2="19"/>
                                                    <line x1="6" y1="13" x2="12" y2="19"/>
                                                </svg>
                                            </p>
                                            <p class="text-gray-500 text-xs">High to low</p>
                                        </li>
                                        <li @click="sort.price = 'asc'"
                                            :class="[sort.price === 'asc' ? 'bg-gray-50' : '']"
                                            class="cursor-pointer flex flex-col justify-center block px-4 py-2 text-md text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-100 dark:hover:text-white dark:hover:bg-gray-600">
                                            <p class="flex items-center">Ascending
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     class="ml-1 w-3 h-3 transform rotate-180" viewBox="0 0 24 24"
                                                     stroke-width="2" stroke="currentColor"
                                                     fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <line x1="12" y1="5" x2="12" y2="19"/>
                                                    <line x1="18" y1="13" x2="12" y2="19"/>
                                                    <line x1="6" y1="13" x2="12" y2="19"/>
                                                </svg>
                                            </p>
                                            <p class="text-gray-500 text-xs">Low to high</p>
                                        </li>
                                    </ul>
                                </template>
                            </jet-dropdown>
                        </div>
                    </div>
                </div>


                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 mt-10 px-2">
                    <ProductCard v-for="product in products.data" :product="product" :key="product.id"/>
                </div>

                <Pagination class="mt-10 mx-auto" :links="products.links" :range="range" :sort="sort" :q="q"/>

            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import ProductCard from "@/components/ProductCard";
import Pagination from "@/components/Pagination";
import JetInput from '@/Jetstream/Input'
import JetLabel from '@/Jetstream/Label'
import JetDropdown from '@/Jetstream/Dropdown'
import VueSlider from 'vue-slider-component'
import 'vue-slider-component/theme/antd.css'

export default {
    props: ['dbProducts', 'filters', 'minPrice', 'maxPrice'],
    name: "AllProducts",
    components: {
        AppLayout,
        ProductCard,
        Pagination,
        JetInput,
        JetLabel,
        JetDropdown,
        VueSlider

    },
    data() {
        return {
            range: [Math.floor(this.filters.min), Math.ceil(this.filters.max)],
            sort: {
                price: this.filters.orderBy
            },
            q: this.filters.q,
            products: this.dbProducts,
            initialLoad: true,
            debouncedDataFetch: null
        }
    },
    mounted() {

        this.initialLoad = false;

        let vm = this;
        this.debouncedDataFetch = _.debounce(() => {
            this.getNewData()
        }, 200)
    },
    methods: {
        getNewData() {
            let vm = this;
            //CSRF token
            let token = document.head.querySelector('meta[name="csrf-token"]');
            //Page param
            let params = (new URL(document.location)).searchParams;
            let page = params.get("page");

            this.axios({
                method: "GET",
                url: route('products.all'),
                params: {
                    'q': vm.q,
                    'orderBy': vm.sort.price,
                    'min': (vm.range[0] - 1),
                    'max': (vm.range[1] + 1),
                    'page': 1,
                    'require_json': true
                },
                headers: {
                    'X-CSRF-TOKEN': token.content
                }
            })
                .then((response) => {
                    vm.products = response.data.items
                }).catch((res) => {

            })

        },
    },
    watch: {
        'sort.price': function () {
            if (!this.initialLoad)
                this.debouncedDataFetch()
        },
        range: function () {
            if (!this.initialLoad)
                this.debouncedDataFetch()
        },
        q: function () {
            if (!this.initialLoad)
                this.debouncedDataFetch()
        },

    },
}
</script>

<style>
.vue-slider-process {
    background-color: #14B8A6 !important;
}

.vue-slider-dot-handle {
    border: 2px solid #14B8A6 !important;
}
</style>
