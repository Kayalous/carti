require('./bootstrap');

// Import modules...
import Vue from 'vue';
import {App as InertiaApp, plugin as InertiaPlugin} from '@inertiajs/inertia-vue';
import { InertiaProgress } from '@inertiajs/progress'
import PortalVue from 'portal-vue';
import VueSweetalert2 from 'vue-sweetalert2';
import axios from 'axios'
import VueAxios from 'vue-axios'


import 'sweetalert2/dist/sweetalert2.min.css';



Vue.mixin({
    methods: {
        route,
        showAlert(type, message) {
            this.$swal({
                toast: true,
                position: 'top',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', this.$swal.stopTimer)
                    toast.addEventListener('mouseleave', this.$swal.resumeTimer)
                },
                icon: type,
                title: message || (type === 'success' ? 'Whatever you did was a huge success.' : 'Something went wrong.'),
                showCloseButton: true
            });
        },
    }
});


Vue.use(InertiaPlugin);
Vue.use(PortalVue);
Vue.use(require('vue-moment'));
Vue.use(VueSweetalert2);
Vue.use(VueAxios, axios)

InertiaProgress.init({
    // The delay after which the progress bar will
    // appear during navigation, in milliseconds.
    delay: 100,

    // The color of the progress bar.
    color: '#14B8A6',

    // Whether to include the default NProgress styles.
    includeCSS: true,

    // Whether the NProgress spinner will be shown.
    showSpinner: true,
})

const app = document.getElementById('app');

new Vue({
    render: (h) =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: (name) => require(`./Pages/${name}`).default,
            },
        }),
}).$mount(app);
