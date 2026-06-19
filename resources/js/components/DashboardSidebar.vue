<script setup>
import { Archive, Briefcase, FileText, HelpCircle, LayoutDashboard, LogOut, Sliders, Zap } from '@lucide/vue';
import { Link, usePage } from '@inertiajs/vue3';
import { dashboard, logout } from '@/routes/index';
import { computed } from 'vue';
import portfolio from "@/routes/portfolio/index";

const page = usePage();
const user = computed(() => page.props.auth.user);
const currentView = computed(() => page.component);

const getLinkClasses = (viewName) => {
    const activeClasses = 'bg-primary/8 text-primary font-bold';
    const inactiveClasses = 'hover:bg-slate-50 text-on-surface-variant hover:text-primary font-semibold';

    return [
        'flex items-center gap-3 px-4 py-3 rounded-xl cursor-pointer text-xs transition-all',
        currentView.value == viewName ? activeClasses : inactiveClasses
    ];
};
</script>

<template>
    <aside
        class="hidden lg:flex lg:col-span-3 flex-col sticky top-28 bg-surface-container-lowest border border-outline-variant/30 p-5 gap-2 rounded-3xl h-[calc(100vh-140px)] shadow-[0_10px_30px_rgba(0,0,0,0.01)]">
        <div class="p-3 mb-4 bg-slate-50/55 border border-slate-100/50 rounded-2xl">
            <div class="flex items-center gap-3">
                <div
                    class="w-10 h-10 rounded-full bg-primary text-white font-bold flex items-center justify-center text-xs">
                    {{ user.initials }}
                </div>
                <div class="truncate">
                    <p class="font-bold text-sm text-on-surface leading-snug">{{ user.name }}</p>
                    <p class="text-xs text-on-surface-variant font-medium">{{ user.email }}</p>
                </div>
            </div>
        </div>

        <nav class="flex-1 flex flex-col gap-1.5 font-sans">
            <Link as="span" :class="getLinkClasses('Portfolio/Dashboard')" :href="dashboard()">
                <LayoutDashboard class="w-4.5 h-4.5" />
                Overview
            </Link>

            <Link as="span" :class="getLinkClasses('Portfolio/Index')" :href="portfolio.index()">
                <FileText class="w-4.5 h-4.5" />
                My Portfolios
            </Link>
        </nav>

        <div class="pt-4 border-t border-slate-100 flex flex-col gap-2 font-sans">
            <Link :href="logout()" as="button"
                class="flex items-center gap-3 px-4 py-2.5 text-red-600 hover:bg-red-50 rounded-xl transition-all cursor-pointer text-xs font-bold">
                <LogOut class="w-4.5 h-4.5 text-red-600" />
                Logout
            </Link>
        </div>
    </aside>
</template>
