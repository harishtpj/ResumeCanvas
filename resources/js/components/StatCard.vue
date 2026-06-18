<script setup>
import { TrendingUp, TrendingDown } from '@lucide/vue';

defineProps({
  title: {
    type: String,
    required: true
  },
  value: {
    type: [String, Number],
    required: true
  },
  trend: {
    type: String,
    default: ''
  },
  trendType: {
    type: String,
    default: 'neutral'
  },
  progressBar: {
    type: Number,
    default: undefined
  }
});
</script>

<template>
  <div
    class="bg-surface-container-lowest p-6 rounded-3xl border border-outline-variant/30 flex flex-col gap-3 shadow-[0_4px_24px_rgba(0,0,0,0.01)] relative overflow-hidden group">
    <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center">
      <slot name="icon"></slot>
    </div>

    <div>
      <p class="text-on-surface-variant text-xs font-semibold uppercase tracking-wider mb-0.5">{{ title }}</p>
      <p class="text-3xl font-extrabold text-on-surface leading-tight font-sans">
        {{ value }}
      </p>
    </div>

    <div v-if="progressBar !== undefined" class="w-full bg-slate-100 h-2 rounded-full overflow-hidden mt-1">
      <div class="bg-secondary h-full transition-all duration-700 rounded-full" :style="{ width: progressBar + '%' }">
      </div>
    </div>

    <div v-if="trend" class="mt-2 text-xs font-bold flex items-center gap-1" :class="{
      'text-emerald-600': trendType === 'up',
      'text-red-600': trendType === 'down',
      'text-on-surface-variant': trendType === 'neutral' || !trendType
    }">
      <TrendingUp v-if="trendType === 'up'" class="w-4 h-4 text-emerald-600" />
      <TrendingDown v-if="trendType === 'down'" class="w-4 h-4 text-red-600" />
      <span>{{ trend }}</span>
    </div>
  </div>
</template>
