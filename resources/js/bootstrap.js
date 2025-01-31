import axios from "axios";
window.axios = axios;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

// const { default: jQuery } = import("jquery");
// window.jquery = window.jQuery = window.$ = jQuery;


import jQuery from 'jquery';
window.$ = window.jQuery = jQuery;

