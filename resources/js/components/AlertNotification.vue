<script setup>
defineProps({
  alerts: {
    type: Array,
    default: () => []
  }
});
</script>

<template>
  <div class="fixed top-24 right-4 md:right-8 z-[200] flex flex-col gap-2 max-w-sm w-full pointer-events-none">
    <transition-group name="fade">
      <div 
        v-for="alert in alerts" 
        :key="alert.id" 
        class="p-4 rounded-xl shadow-lg border text-sm font-medium pointer-events-auto flex items-center gap-3 backdrop-blur-md"
        :class="{
          'bg-emerald-50/90 text-emerald-900 border-emerald-200': alert.type === 'success',
          'bg-amber-50/90 text-amber-900 border-amber-200': alert.type === 'warning',
          'bg-slate-50/90 text-slate-900 border-slate-200': alert.type === 'info',
        }"
      >
        <div class="w-2 h-2 rounded-full" :class="{
          'bg-emerald-500': alert.type === 'success',
          'bg-amber-500': alert.type === 'warning',
          'bg-slate-500': alert.type === 'info',
        }"></div>
        <span class="flex-1">{{ alert.text }}</span>
      </div>
    </transition-group>
  </div>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: all 0.25s ease-out;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
  transform: translateY(-8px);
}
</style>
