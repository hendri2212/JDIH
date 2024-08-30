/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./select2.min');
import $ from 'jquery';
window.$ = window.jQuery = $;
import jQuery from 'jquery'
import { createApp } from "vue";
import router from './router'

// import Dashboard from './views/Dashboard'

import CKEditor from '@ckeditor/ckeditor5-vue';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

import Layout from './views/Layout'
createApp({
    components:{
        Layout
    },
    mounted(){
        setTimeout(() => {
            let Script = document.createElement("script");
            Script.setAttribute("src", `${window.location.origin}/js/main.js`);
            document.head.appendChild(Script);
        }, 300); // Delay of 100ms
    }
})
.use(router)
.use(CKEditor)
.use(VueSweetalert2)
.mount('#app')