<script setup>
import {onMounted, onUnmounted, ref} from 'vue'
import {router} from '@inertiajs/vue3'
import {CheckCircle2, AlertTriangle, XCircle, Info} from "@lucide/vue";

const alerts = ref([])

function addAlert(toast) {
    const id = Date.now()

    alerts.value.push({
        id,
        type: toast.type ?? 'info',
        text: toast.text ?? toast.message,
    })

    setTimeout(() => {
        alerts.value = alerts.value.filter(a => a.id !== id)
    }, 4000)
}

let removeListener

onMounted(() => {
    removeListener = router.on('flash', (event) => {
        const toast = event.detail.flash.toast

        if (toast) {
            addAlert(toast)
        }
    })
})

onUnmounted(() => {
    removeListener?.()
})
</script>

<template>
    <div class="fixed top-24 right-4 md:right-8 z-[200] flex flex-col gap-2 max-w-sm w-full pointer-events-none">
        <transition-group name="fade">
            <div
                v-for="alert in alerts"
                :key="alert.id"
                :class="{
                    'bg-emerald-50/90 text-emerald-900 border-emerald-200': alert.type === 'success',
                    'bg-amber-50/90 text-amber-900 border-amber-200': alert.type === 'warning',
                    'bg-slate-50/90 text-slate-900 border-slate-200': alert.type === 'info',
                    'bg-red-50/90 text-red-900 border-red-200': alert.type === 'error',
                }"
                class="p-4 rounded-xl shadow-lg border text-sm font-medium pointer-events-auto flex items-center gap-3 backdrop-blur-md"
            >
                <CheckCircle2
                    v-if="alert.type === 'success'"
                    class="w-5 h-5 text-emerald-500 flex-shrink-0"
                />

                <AlertTriangle
                    v-else-if="alert.type === 'warning'"
                    class="w-5 h-5 text-amber-500 flex-shrink-0"
                />

                <XCircle
                    v-else-if="alert.type === 'error'"
                    class="w-5 h-5 text-red-500 flex-shrink-0"
                />

                <Info
                    v-else
                    class="w-5 h-5 text-slate-500 flex-shrink-0"
                />

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
