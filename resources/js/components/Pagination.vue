<template>
    <div v-if="links.length > 3">
        <div class="flex flex-wrap -mb-1">
            <template v-for="link in links" >
                <inertia-link :href="'#'" v-if="link.url === null"  class="flex items-center px-4 py-2 mx-1 text-gray-500 bg-gray-100 rounded-md border-2 border-gray-100 cursor-not-allowed" v-html="link.label" />
                <inertia-link v-else class="flex items-center px-4 py-2 mx-1 text-gray-500 bg-white rounded-md border-2 border-gray-100  transition-colors duration-200 transform hover:bg-teal-500 hover:text-white"
                              :class="{ 'cursor-not-allowed bg-teal-500 !text-white': link.active }" :href="(link.url + `&orderBy=${sort.price}&min=${range[0]}&max=${range[1]}&q=${q}`) || '#'" v-html="link.label" />
            </template>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        links: Array,
        range: Array,
        sort: Object,
        q: String
    },
}
</script>
