import "../bootstrap";
// import "../css/admin.css"; // Ensure you have an admin-specific CSS file
import "flowbite";
// import "../assets/js/script";
import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../../vendor/tightenco/ziggy/src/js";
import { createPinia } from "pinia";
import piniaPluginPersistedstate from "pinia-plugin-persistedstate";
const pinia = createPinia();
pinia.use(piniaPluginPersistedstate);
import ElementPlus from "element-plus";
import "element-plus/dist/index.css";

const appName = import.meta.env.VITE_APP_NAME || "Laravel-Admin";
createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `../Pages/${name}.vue`,
            import.meta.glob("../Pages/Admin/**/*.vue")
        ),

    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) });
        app.use(plugin);
        app.use(ZiggyVue);
        app.use(pinia);
        app.use(ElementPlus);
        app.config.globalProperties.$filters = {
            currencySymbol(value) {
                return value.toLocaleString() + "$";
            },
            makeImagePath(img) {
                return import.meta.env.VITE_APP_URL + "/" + img;
            },
        };
        app.mount(el);
        return app;
    },
    progress: {
        color: "#8ec557",
        showSpinner: true,
    },
});
