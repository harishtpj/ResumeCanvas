<script setup>
import { Head } from '@inertiajs/vue3';
import RegisterForm from '@/components/RegisterForm.vue';
</script>

<template>
    <Head title="Register" />
    <section class="pt-32 pb-24 px-4 w-full flex items-center justify-center">
        <div class="w-full max-w-md mx-auto relative">
            <RegisterForm />
        </div>
    </section>
</template>
