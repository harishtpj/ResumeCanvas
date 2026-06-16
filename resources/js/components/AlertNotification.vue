<script setup>
import {ref, onMounted, onUnmounted} from 'vue'
import {router} from '@inertiajs/vue3'

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
                }"
                class="p-4 rounded-xl shadow-lg border text-sm font-medium pointer-events-auto flex items-center gap-3 backdrop-blur-md"
            >
                <div
                    :class="{
                        'bg-emerald-500': alert.type === 'success',
                        'bg-amber-500': alert.type === 'warning',
                        'bg-slate-500': alert.type === 'info',
                    }"
                    class="w-2 h-2 rounded-full"
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
