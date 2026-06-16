import { createInertiaApp } from "@inertiajs/vue3";
import Layout from "./Layout.vue";

createInertiaApp({
    layout: () => Layout
});
