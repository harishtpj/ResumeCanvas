<script setup>
import NavBar from '@/components/NavBar.vue';
import AlertNotification from '@/components/AlertNotification.vue';
import Footer from '@/components/Footer.vue';
</script>

<template>
    <div
        class="min-h-screen bg-surface selection:bg-primary-container selection:text-white flex flex-col relative w-full text-on-surface pb-12">

        <AlertNotification/>
        <NavBar/>

        <div
            class="absolute top-[5%] left-[5%] w-[45vw] h-[45vw] rounded-full blur-[140px] pointer-events-none -z-10 bg-primary/4">
        </div>
        <div
            class="absolute bottom-[10%] right-[5%] w-[35vw] h-[35vw] rounded-full blur-[120px] pointer-events-none -z-10 bg-secondary/6">
        </div>
        <div
            class="absolute top-[40%] right-[10%] w-[30vh] h-[30vh] rounded-full blur-[110px] pointer-events-none -z-10 bg-tertiary/4">
        </div>

        <main class="flex-1 w-full flex flex-col">
            <slot/>
        </main>


        <Footer/>
    </div>
</template>
