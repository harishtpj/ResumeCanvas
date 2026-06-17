<script setup>
import {Trash2, RefreshCw} from '@lucide/vue';
import portfolio from "@/routes/portfolio/index.ts";
import {Link} from "@inertiajs/vue3";

defineProps({
    item: {
        type: Object,
        required: true
    }
});
</script>

<template>
    <Link :href="portfolio.show(item.id)" as="div"
        class="bg-surface-container-lowest border border-outline-variant/30 rounded-3xl overflow-hidden shadow-[0_4px_24px_rgba(0,0,0,0.01)] hover:shadow-[0_12px_36px_rgba(62,85,190,0.07)] transition-all duration-300 flex flex-col group relative cursor-pointer"
    >
        <!-- Tag Display Overlay -->
        <!--    <div class="relative h-40 overflow-hidden bg-slate-100 border-b border-slate-100">-->
        <!--      <img-->
        <!--        :src="item.image"-->
        <!--        alt="Portfolio display view screenshot"-->
        <!--        class="w-full h-full object-cover transform duration-500 group-hover:scale-[1.03]"-->
        <!--        referrerpolicy="no-referrer"-->
        <!--      />-->
        <!--      <div-->
        <!--        class="absolute top-3 right-3 font-bold text-[10px] px-3 py-1 rounded-full uppercase z-10"-->
        <!--        :class="item.status === 'Live' ? 'bg-emerald-500/90 text-white' : 'bg-slate-700/90 text-white'"-->
        <!--      >-->
        <!--        {{ item.status }}-->
        <!--      </div>-->
        <!--    </div>-->

        <!-- Details Footer Info -->
        <div class="p-5 flex flex-col flex-1 text-left">
            <h4 class="font-bold text-base text-on-surface font-sans mb-1">{{ item.title }}</h4>
            <p class="text-[11px] text-on-surface-variant font-medium mb-4">{{ item.last_updated }}</p>

            <!--      <div class="flex flex-wrap gap-1.5 mb-6">-->
            <!--        <span-->
            <!--          v-for="tag in item.tags"-->
            <!--          :key="tag"-->
            <!--          class="px-2 py-0.5 bg-slate-100 text-on-surface-variant rounded-full text-[10px] font-medium"-->
            <!--        >-->
            <!--          {{ tag }}-->
            <!--        </span>-->
            <!--      </div>-->

            <!-- Actions Toolbar -->
            <div class="mt-auto pt-3 border-t border-slate-100 flex items-center justify-between">
                <!--        <div class="flex items-center gap-1 text-[11px] font-semibold text-on-surface-variant font-sans">-->
                <!--          <Activity class="w-3.5 h-3.5 text-primary" />-->
                <!--          AI Score: <span class="text-primary font-bold">{{ item.score }}%</span>-->
                <!--        </div>-->

                <!-- Action Icons -->
                <div class="flex items-center gap-1.5">
                    <Link :href="portfolio.update(item.id)" as="button"
                          class="p-1.5 hover:bg-slate-100 text-on-surface-variant hover:text-primary rounded-lg transition-colors cursor-pointer"
                          title="Regenerate Portfolio"
                    >
                        <RefreshCw class="w-4 h-4"/>
                    </Link>
                    <Link :href="portfolio.destroy(item.id)" as="button"
                          class="p-1.5 hover:bg-red-50 text-on-surface-variant hover:text-red-600 rounded-lg transition-colors cursor-pointer"
                          title="Delete"
                    >
                        <Trash2 class="w-4 h-4"/>
                    </Link>
                </div>
            </div>
        </div>
    </Link>
</template>
