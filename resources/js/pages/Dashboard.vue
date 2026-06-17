<script setup>
import {
  Activity,
  Star,
  Plus,
  ChevronRight
} from '@lucide/vue';
import DashboardSidebar from '../components/DashboardSidebar.vue';
import StatCard from '../components/StatCard.vue';
import PortfolioCard from '../components/PortfolioCard.vue';
import { usePage, Head } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();
const user = computed(() => page.props.auth.user)

</script>

<template>
  <Head title="Dashboard"/>
  <section class="pt-28 pb-20 w-full min-h-screen">
    <div class="max-w-[1280px] mx-auto px-4 md:px-8 grid grid-cols-1 lg:grid-cols-12 gap-8">

      <!-- Dashboard Sidebar Component -->
      <DashboardSidebar />

      <!-- Main Dashboard Content Area -->
      <div class="col-span-1 lg:col-span-9 flex flex-col gap-8 text-left">

        <header>
          <h2 class="text-3xl font-bold tracking-tight text-on-surface font-sans mb-1">
            Welcome back, {{ user.firstName }}
          </h2>
          <p class="text-on-surface-variant text-sm font-sans">
            Your portfolio views and match rates are looking strong. You have 2 active portfolios.
          </p>
        </header>

        <!-- Quick statistical bento boxes -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

          <!-- Views counts box -->
          <StatCard title="Portfolio Views" value="2" trend="+12% views increase this week" trend-type="up">
            <template #icon>
              <Activity class="w-5 h-5 text-primary" />
            </template>
          </StatCard>

          <!-- AI Profile Score Box -->
          <StatCard title="AI Profile Score" value="29/100" :progress-bar="29">
            <template #icon>
              <Star class="w-5 h-5 text-secondary" />
            </template>
          </StatCard>

          <!-- Optimize CTA Card widget -->
          <div
            class="bg-primary text-white p-6 rounded-3xl flex flex-col justify-between shadow-lg shadow-primary/10 relative overflow-hidden group">
            <div
              class="absolute -right-6 -bottom-6 w-24 h-24 bg-white/5 rounded-full blur-2xl group-hover:scale-125 transition-transform duration-700 font-sans">
            </div>
            <div>
              <p class="font-bold text-lg leading-tight font-sans">Ready for a new role?</p>
              <p class="text-xs text-white/80 mt-1 font-sans">Optimize layout match rate for your targets in real-time.
              </p>
            </div>
            <button
              class="bg-white hover:bg-slate-50 active:scale-95 text-primary text-xs font-extrabold px-5 py-2.5 rounded-full transition-all mt-4 w-fit inline-flex items-center gap-1.5 select-none">
              <!--              <span v-if="!isOptimizingScore">Optimize Now</span>-->
              <!--              <span v-else class="animate-pulse">Analyzing...</span>-->
              <!--              <ChevronRight v-if="!isOptimizingScore" class="w-3.5 h-3.5" />-->
            </button>
          </div>

        </div>

        <!-- Portfolios Matrix Grid -->
        <div>
          <div class="flex justify-between items-center mb-6">
            <h3 class="font-bold text-xl text-on-surface font-sans">My Active Portfolios</h3>
            <span @click="emit('alert', 'All dynamic portfolio view filters loaded.', 'info')"
              class="text-xs text-primary font-bold hover:underline cursor-pointer">View All (3)</span>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            <!-- Create dynamic template prompt card -->
            <button @click="emit('create-portfolio')"
              class="group flex flex-col items-center justify-center gap-4 bg-slate-50 border-2 border-dashed border-outline-variant/60 hover:border-primary/50 hover:bg-primary/5 transition-all p-6 rounded-3xl min-h-[260px]">
              <div
                class="w-12 h-12 rounded-full bg-white shadow-sm flex items-center justify-center text-primary group-hover:scale-110 transition-transform duration-300">
                <Plus class="w-6 h-6" />
              </div>
              <span class="font-bold text-sm text-on-surface-variant group-hover:text-primary transition-colors">Create
                New
                Portfolio</span>
            </button>

            <!-- PortfolioCard Component rendering -->
            <PortfolioCard v-for="item in portfolios" :key="item.id" :item="item"
              @optimize="(id) => emit('optimize-portfolio', id)" @share="(title) => emit('share-portfolio', title)"
              @delete="(id) => emit('delete-portfolio', id)" />

          </div>
        </div>

        <!-- Recommended Match Optimizer Wide banner -->
        <div class="bg-indigo-50 border border-indigo-100 rounded-[2rem] p-6 md:p-10 relative overflow-hidden group">
          <div class="absolute -right-12 -top-12 w-64 h-64 bg-primary/5 rounded-full blur-[80px]"></div>
          <div class="relative z-10 max-w-2xl text-left">
            <div
              class="inline-flex items-center gap-1.5 bg-primary/10 text-primary px-3 py-1 rounded-full text-[11px] font-bold mb-4 select-none">
              <Activity class="w-3.5 h-3.5 text-primary" />
              AI recommendation report
            </div>
            <h3 class="font-extrabold text-2xl text-on-surface tracking-tight mb-2 font-sans">
              Boost your landing interview match rates by +40%
            </h3>
            <p class="text-on-surface-variant text-xs md:text-sm leading-relaxed mb-6 font-sans">
              Our neural network parsed your active portfolios profile and detected missing critical performance
              keywords.
              Trigger our secure localized synthesizer optimizer to match dynamic job descriptions in seconds.
            </p>
            <div class="flex flex-wrap gap-3 font-sans">
              <button @click="emit('run-optimizer')" :disabled="isOptimizingScore"
                class="bg-primary hover:bg-primary/95 text-white text-xs font-bold px-6 py-3 rounded-full shadow-md shadow-primary/15 transition-all active:scale-[0.97]">
                <span v-if="!isOptimizingScore">Launch AI Optimizer</span>
                <span v-else class="animate-pulse">Optimizing Profile...</span>
              </button>
              <button @click="emit('alert', 'Recommendation report hidden. Will show later.', 'info')"
                class="bg-white/70 hover:bg-white border border-outline-variant/30 text-on-surface-variant text-xs font-bold px-6 py-3 rounded-full transition-all">
                Dismiss for now
              </button>
            </div>
          </div>
        </div>

      </div>

    </div>
  </section>
</template>
