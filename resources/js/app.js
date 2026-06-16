import { createInertiaApp } from "@inertiajs/vue3";
import '../css/app.css';
import Layout from "./Layout.vue";

createInertiaApp({
    layout: () => Layout
});
