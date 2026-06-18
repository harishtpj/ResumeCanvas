<script setup>
import { computed } from 'vue';
import { dashboard, index } from '@/routes/index';
import {
    ShieldAlert,
    Search,
    ServerCrash,
    Cpu,
    ArrowLeft,
    Home
} from '@lucide/vue';
import { Link, usePage } from '@inertiajs/vue3';

const page = usePage();
const loggedIn = computed(() => page.props.auth.loggedIn);
const props = defineProps({
    code: { type: [Number, String], default: '404' },
    customMessage: { type: String, default: '' }
});

const errorDetails = computed(() => {
    const status = String(props.code);
    switch (status) {
        case '403':
            return {
                title: 'Access Denied',
                subtitle: 'Permission Required',
                desc: 'You do not have the necessary permissions to access this area. If you believe this is a mistake, please contact your administrator.',
                icon: ShieldAlert,
                colorClass: 'text-amber-600 bg-amber-50 border-amber-200'
            };
        case '500':
            return {
                title: 'Server Error',
                subtitle: 'Connection Interrupted',
                desc: 'We are experiencing some technical difficulties. Our team has been notified and is working on a fix.',
                icon: ServerCrash,
                colorClass: 'text-rose-600 bg-rose-50 border-rose-200'
            };
        case '503':
            return {
                title: 'Service Unavailable',
                subtitle: 'Maintenance in Progress',
                desc: 'The service is temporarily unavailable while we perform scheduled updates. Please check back shortly.',
                icon: Cpu,
                colorClass: 'text-indigo-600 bg-indigo-50 border-indigo-200'
            };
        case '404':
        default:
            return {
                title: 'Page Not Found',
                subtitle: 'Navigation Error',
                desc: 'The page you are looking for cannot be found. Please check the URL or return to the main dashboard.',
                icon: Search,
                colorClass: 'text-primary bg-primary/5 border-primary/20'
            };
    }
});
</script>

<template>
    <section class="pt-32 pb-24 px-4 w-full flex items-center justify-center min-h-screen relative overflow-hidden">
        
        <!-- Large background status indicator (Brutalist style) -->
        <div class="absolute inset-0 flex items-center justify-center pointer-events-none select-none -z-10 opacity-[0.03] overflow-hidden">
            <span class="text-[25vw] font-black tracking-tight text-primary leading-none">{{ code }}</span>
        </div>

        <div class="w-full max-w-xl mx-auto text-center relative z-10 flex flex-col items-center">

            <!-- Styled Error Icon Badge -->
            <div class="mb-8 relative group animate-float">
                <div class="absolute inset-0 bg-primary/20 rounded-[32px] blur-xl opacity-35 group-hover:opacity-60 transition-opacity"></div>
                <div class="w-24 h-24 rounded-[32px] border flex items-center justify-center relative bg-white/80 backdrop-blur-md shadow-lg"
                     :class="errorDetails.colorClass">
                    <component :is="errorDetails.icon" class="w-12 h-12" />
                </div>
            </div>

            <!-- Detail Card block -->
            <div class="glass-card rounded-[32px] p-8 md:p-10 shadow-xl border border-white/40 mb-8 w-full">
                <h1 class="text-3xl font-extrabold text-on-surface tracking-tight font-sans mb-1">
                    {{ errorDetails.title }}
                </h1>
                <p class="text-xs font-bold text-primary uppercase tracking-wide mb-4 font-sans">
                    {{ errorDetails.subtitle }}
                </p>

                <p class="text-on-surface-variant text-sm leading-relaxed font-sans">
                    {{ customMessage || errorDetails.desc }}
                </p>
            </div>

            <!-- Action Nav Row -->
            <div class="flex flex-wrap items-center justify-center gap-3 font-sans">
                <Link :href="loggedIn ? dashboard() : index()" as="button"
                    class="flex items-center gap-1.5 px-6 py-3 bg-primary hover:bg-primary/95 text-white font-bold text-sm rounded-xl shadow-md shadow-primary/15 hover:shadow-lg transition-all active:scale-[0.98] select-none cursor-pointer">
                    <ArrowLeft class="w-4 h-4" />
                    <span>{{ loggedIn ? "Go to Dashboard" : "Back to Home"}}</span>
                </Link>
            </div>

        </div>
    </section>
</template>