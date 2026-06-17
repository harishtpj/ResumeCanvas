import { createInertiaApp } from "@inertiajs/vue3";
import Layout from "./Layout.vue";

createInertiaApp({
    title: (title) => (title ? `${title} | ` : "") + "ResumeCanvas",
    layout: () => Layout
});
