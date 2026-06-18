<script setup>
import { Activity, Clock, Files, Plus, Star, ChevronRight } from '@lucide/vue';
import StatCard from '@/components/StatCard.vue';
import PortfolioCard from '@/components/PortfolioCard.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import portfolio from "@/routes/portfolio/index";

const props = defineProps({
    totalPortfolios: {
        type: Number,
        required: true
    },
    portfolios: {
        type: Array,
        required: true
    },
});

const page = usePage();
const user = computed(() => page.props.auth.user);
const lastPortfolio = computed(() => props.portfolios[0]);
</script>

<template>

    <Head title="Dashboard" />

    <header>
        <h2 class="text-3xl font-bold tracking-tight text-on-surface font-sans mb-1">
            Welcome, {{ user.firstName }}
        </h2>
    </header>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

        <StatCard title="Portfolios" :value="totalPortfolios">
            <template #icon>
                <Files class="w-5 h-5 text-primary" />
            </template>
        </StatCard>

        <StatCard title="Last Updated" :value="lastPortfolio?.last_updated ?? 'No portfolios found'">
            <template #icon>
                <Clock class="w-5 h-5 text-secondary" />
            </template>
        </StatCard>

        <div
            class="bg-primary text-white p-6 rounded-3xl flex flex-col justify-between shadow-lg shadow-primary/10 relative overflow-hidden group">
            <div
                class="absolute -right-6 -bottom-6 w-24 h-24 bg-white/5 rounded-full blur-2xl group-hover:scale-125 transition-transform duration-700 font-sans">
            </div>
            <div v-if="lastPortfolio">
                <p class="font-bold text-lg leading-tight font-sans">{{ lastPortfolio.title }}</p>
                <p class="text-xs text-white/80 mt-1 font-sans">Your latest portfolio</p>
            </div>
            <div v-else>
                <p class="font-bold text-lg leading-tight font-sans">Create Portfolio</p>
                <p class="text-xs text-white/80 mt-1 font-sans">Take first steps towards your career by
                    generating one.
                </p>
            </div>
            <Link :href="lastPortfolio ? portfolio.show(lastPortfolio.id) : portfolio.create()" as="button"
                class="bg-white hover:bg-slate-50 active:scale-95 text-primary text-xs font-extrabold px-5 py-2.5 rounded-full transition-all mt-4 w-fit inline-flex items-center gap-1.5 select-none">
                {{ lastPortfolio ? "View Portfolio" : "Create one" }}
                <ChevronRight class="w-3.5 h-3.5" />
            </Link>
        </div>

    </div>

    <div>
        <div class="flex justify-between items-center mb-6">
            <h3 class="font-bold text-xl text-on-surface font-sans">My Active Portfolios</h3>
            <Link :href="portfolio.index()" as="span"
                class="text-xs text-primary font-bold hover:underline cursor-pointer">
                View All ({{ totalPortfolios }})</Link>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            <Link :href="portfolio.create()" as="button"
                class="group flex flex-col items-center justify-center gap-4 bg-slate-50 border-2 border-dashed border-outline-variant/60 hover:border-primary/50 hover:bg-primary/5 transition-all p-6 rounded-3xl min-h-[130px]">
                <div
                    class="w-12 h-12 rounded-full bg-white shadow-sm flex items-center justify-center text-primary group-hover:scale-110 transition-transform duration-300">
                    <Plus class="w-6 h-6" />
                </div>
                <span
                    class="font-bold text-sm text-on-surface-variant group-hover:text-primary transition-colors">Create
                    New
                    Portfolio</span>
            </Link>

            <PortfolioCard v-for="item in portfolios" :key="item.id" :item="item" />
        </div>
    </div>
</template>
