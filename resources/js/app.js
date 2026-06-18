import { createInertiaApp } from "@inertiajs/vue3";
import AppLayout from "@/layouts/AppLayout.vue";
import DashboardLayout from "@/layouts/DashboardLayout.vue";

createInertiaApp({
    title: (title) => (title ? `${title} | ` : "") + "ResumeCanvas",
    layout: (name) => name.startsWith('Portfolio/') ? [AppLayout, DashboardLayout] : AppLayout,
});
