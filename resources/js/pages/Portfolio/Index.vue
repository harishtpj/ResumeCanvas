<script setup>
import { computed, ref } from 'vue';
import { ArrowLeft, FolderPlus } from '@lucide/vue';
import { Head, InfiniteScroll, Link } from "@inertiajs/vue3";
import { dashboard } from "@/routes/index";
import PortfolioCard from "@/components/PortfolioCard.vue";
import portfolio from "@/routes/portfolio/index";

defineProps({
  portfolios: {
    type: Object,
    required: true
  }
});
</script>

<template>

  <Head title="Portfolios" />
  <section class="pb-20 w-full min-h-screen">
    <div class="max-w-[1280px] mx-auto px-4 md:px-8 flex flex-col gap-6">

      <div
        class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 border-b border-slate-100 pb-5 text-left">
        <div class="flex items-center gap-3">
          <Link :href="dashboard()" as="button"
            class="w-10 h-10 rounded-full border border-outline-variant/40 hover:bg-slate-50 flex items-center justify-center text-on-surface transition-colors cursor-pointer"
            title="Back to Dashboard">
            <ArrowLeft class="w-5 h-5" />
          </Link>
          <div>
            <h1 class="text-2xl font-extrabold text-on-surface mt-0.5 font-sans">Your Portfolios</h1>
          </div>
        </div>
      </div>

      <InfiniteScroll data="portfolios">
        <div v-if="portfolios.data && portfolios.total > 0" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          <PortfolioCard v-for="item in portfolios.data" :key="item.id" :item="item" />
        </div>

        <div v-else class="flex flex-col items-center justify-center py-24 text-center">
          <div class="bg-slate-100 p-4 rounded-full mb-6">
            <FolderPlus class="w-10 h-10 text-slate-400" />
          </div>
          <h3 class="text-xl font-bold text-on-surface">No portfolios yet</h3>
          <p class="text-slate-500 mt-2 max-w-sm">
            It looks like you haven't created any portfolios. Click below to get started.
          </p>
          <Link :href="portfolio.create()" class="mt-8 px-6 py-2 bg-primary text-white rounded-lg hover:opacity-90 transition">
            Create New Portfolio
          </Link>
        </div>
      </InfiniteScroll>

    </div>
  </section>
</template>
