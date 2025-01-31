import "./bootstrap";
import "./web";
import "../css/web.css";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";

import Vue3Marquee from 'vue3-marquee';


const appName = import.meta.env.VITE_APP_NAME || "Laravel";
createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) });
        app.use(plugin);
        app.use(ZiggyVue);
        app.use(Vue3Marquee);
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
        color: "#8750f7",
        showSpinner: true,
    },
});
