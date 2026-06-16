<script setup>
import {
    LayoutDashboard,
    FileText,
    Sliders,
    Briefcase,
    Archive,
    Zap,
    HelpCircle,
    LogOut
} from '@lucide/vue';
import {Link} from '@inertiajs/vue3';

const currentUser = {
    name: 'Harish Kumar',
    plan: 'Basic',
};
</script>

<template>
    <aside
        class="hidden lg:flex lg:col-span-3 flex-col sticky top-28 bg-surface-container-lowest border border-outline-variant/30 p-5 gap-2 rounded-3xl h-[calc(100vh-140px)] shadow-[0_10px_30px_rgba(0,0,0,0.01)]"
    >
        <!-- User Profile Badge -->
        <div class="p-3 mb-4 bg-slate-50/55 border border-slate-100/50 rounded-2xl">
            <div class="flex items-center gap-3">
                <div
                    class="w-10 h-10 rounded-full bg-primary text-white font-bold flex items-center justify-center text-xs">
                    {{ currentUser.name.slice(0, 2) }}
                </div>
                <div class="truncate">
                    <p class="font-bold text-sm text-on-surface leading-snug">{{ currentUser.name }}</p>
                    <p class="text-xs text-on-surface-variant font-medium">{{ currentUser.plan }}</p>
                </div>
            </div>
        </div>

        <!-- Navigation Menu Items -->
        <nav class="flex-1 flex flex-col gap-1.5 font-sans">
            <Link
                href="/"
                as="span"
                class="flex items-center gap-3 px-4 py-3 bg-primary/8 text-primary rounded-xl font-bold cursor-pointer text-xs transition-colors"
            >
                <LayoutDashboard class="w-4.5 h-4.5"/>
                Overview
            </Link>
            <Link
                href="/"
                as="span"
                class="flex items-center gap-3 px-4 py-3 hover:bg-slate-50 text-on-surface-variant hover:text-primary rounded-xl font-semibold cursor-pointer text-xs transition-all"
            >
                <FileText class="w-4.5 h-4.5"/>
                My Templates
            </Link>
            <span
                @click="emit('run-optimizer')"
                class="flex items-center gap-3 px-4 py-3 hover:bg-slate-50 text-on-surface-variant hover:text-primary rounded-xl font-semibold cursor-pointer text-xs transition-all"
            >
        <Sliders class="w-4.5 h-4.5 text-primary"/>
        AI Optimizer
      </span>
            <span
                @click="emit('alert', 'Opening Job Application tracker...', 'info')"
                class="flex items-center gap-3 px-4 py-3 hover:bg-slate-50 text-on-surface-variant hover:text-primary rounded-xl font-semibold cursor-pointer text-xs transition-all"
            >
        <Briefcase class="w-4.5 h-4.5"/>
        Job Tracker
      </span>
            <span
                @click="emit('alert', 'Viewing archived documents list.', 'info')"
                class="flex items-center gap-3 px-4 py-3 hover:bg-slate-50 text-on-surface-variant hover:text-primary rounded-xl font-semibold cursor-pointer text-xs transition-all"
            >
        <Archive class="w-4.5 h-4.5"/>
        Archive
      </span>
        </nav>

        <!-- Bottom Actions Area -->
        <div class="pt-4 border-t border-slate-100 flex flex-col gap-2 font-sans">
            <button
                @click="emit('alert', 'Handshake initialized with checkout gateway!', 'success')"
                class="bg-indigo-50 hover:bg-indigo-100 text-primary py-3 rounded-2xl text-xs font-bold flex items-center justify-center gap-2 transition-all active:scale-95"
            >
                <Zap class="w-4 h-4 text-primary animate-pulse"/>
                Upgrade to AI+
            </button>
            <button
                @click="emit('alert', 'Redirecting to support desk page.', 'info')"
                class="flex items-center gap-3 px-4 py-2.5 text-on-surface-variant hover:text-primary rounded-xl transition-all cursor-pointer text-xs font-semibold"
            >
                <HelpCircle class="w-4.5 h-4.5"/>
                Help Center
            </button>
            <button
                @click="emit('logout')"
                class="flex items-center gap-3 px-4 py-2.5 text-red-600 hover:bg-red-50 rounded-xl transition-all cursor-pointer text-xs font-bold"
            >
                <LogOut class="w-4.5 h-4.5 text-red-600"/>
                Logout
            </button>
        </div>
    </aside>
</template>
