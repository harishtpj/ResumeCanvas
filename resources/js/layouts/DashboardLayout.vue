<script setup>
import DashboardSidebar from '../components/DashboardSidebar.vue';
</script>

<template>
    <section class="pt-28 pb-20 w-full min-h-screen">
        <div class="max-w-[1280px] mx-auto px-4 md:px-8 grid grid-cols-1 lg:grid-cols-12 gap-8">

            <DashboardSidebar />
            <div class="col-span-1 lg:col-span-9 flex flex-col gap-8 text-left">
                <slot />
            </div>
        </div>
    </section>
</template>
