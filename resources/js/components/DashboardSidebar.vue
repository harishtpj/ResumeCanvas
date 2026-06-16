<script setup>
import { Archive, Briefcase, FileText, HelpCircle, LayoutDashboard, LogOut, Sliders, Zap } from '@lucide/vue';
import { Link, usePage } from '@inertiajs/vue3';
import { logout } from '@/routes/index';
import { computed } from 'vue';

const page = usePage();
const user = computed(() => {
    const data = page.props.auth.user;
    const [f, l] = data.name.split(" ", 2);
    return {
        ...data,
        firstName: f,
        lastName: l,
        initials: (f.charAt(0) + (l !== undefined ? l.charAt(0) : f.charAt(1))).toUpperCase()
    };
})
</script>

<template>
    <aside
        class="hidden lg:flex lg:col-span-3 flex-col sticky top-28 bg-surface-container-lowest border border-outline-variant/30 p-5 gap-2 rounded-3xl h-[calc(100vh-140px)] shadow-[0_10px_30px_rgba(0,0,0,0.01)]">
        <!-- User Profile Badge -->
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

        <!-- Navigation Menu Items -->
        <nav class="flex-1 flex flex-col gap-1.5 font-sans">
            <Link as="span"
                class="flex items-center gap-3 px-4 py-3 bg-primary/8 text-primary rounded-xl font-bold cursor-pointer text-xs transition-colors"
                href="/">
                <LayoutDashboard class="w-4.5 h-4.5" />
                Overview
            </Link>
            <Link as="span"
                class="flex items-center gap-3 px-4 py-3 hover:bg-slate-50 text-on-surface-variant hover:text-primary rounded-xl font-semibold cursor-pointer text-xs transition-all"
                href="/">
                <FileText class="w-4.5 h-4.5" />
                My Templates
            </Link>
            <span
                class="flex items-center gap-3 px-4 py-3 hover:bg-slate-50 text-on-surface-variant hover:text-primary rounded-xl font-semibold cursor-pointer text-xs transition-all"
                @click="emit('run-optimizer')">
                <Sliders class="w-4.5 h-4.5 text-primary" />
                AI Optimizer
            </span>
            <span
                class="flex items-center gap-3 px-4 py-3 hover:bg-slate-50 text-on-surface-variant hover:text-primary rounded-xl font-semibold cursor-pointer text-xs transition-all"
                @click="emit('alert', 'Opening Job Application tracker...', 'info')">
                <Briefcase class="w-4.5 h-4.5" />
                Job Tracker
            </span>
            <span
                class="flex items-center gap-3 px-4 py-3 hover:bg-slate-50 text-on-surface-variant hover:text-primary rounded-xl font-semibold cursor-pointer text-xs transition-all"
                @click="emit('alert', 'Viewing archived documents list.', 'info')">
                <Archive class="w-4.5 h-4.5" />
                Archive
            </span>
        </nav>

        <!-- Bottom Actions Area -->
        <div class="pt-4 border-t border-slate-100 flex flex-col gap-2 font-sans">
            <button
                class="bg-indigo-50 hover:bg-indigo-100 text-primary py-3 rounded-2xl text-xs font-bold flex items-center justify-center gap-2 transition-all active:scale-95"
                @click="emit('alert', 'Handshake initialized with checkout gateway!', 'success')">
                <Zap class="w-4 h-4 text-primary animate-pulse" />
                Upgrade to AI+
            </button>
            <button
                class="flex items-center gap-3 px-4 py-2.5 text-on-surface-variant hover:text-primary rounded-xl transition-all cursor-pointer text-xs font-semibold"
                @click="emit('alert', 'Redirecting to support desk page.', 'info')">
                <HelpCircle class="w-4.5 h-4.5" />
                Help Center
            </button>
            <Link :href="logout()" as="button"
                class="flex items-center gap-3 px-4 py-2.5 text-red-600 hover:bg-red-50 rounded-xl transition-all cursor-pointer text-xs font-bold"
                method="delete">
                <LogOut class="w-4.5 h-4.5 text-red-600" />
                Logout
            </Link>
        </div>
    </aside>
</template>
