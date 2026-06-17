<script setup>
import LoginForm from '@/components/LoginForm.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Log In" />
    <section class="pt-32 pb-24 px-4 w-full flex items-center justify-center">
        <div class="w-full max-w-5xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8 items-center min-h-[500px]">
            <div
                class="hidden lg:block lg:col-span-6 relative rounded-3xl overflow-hidden shadow-xl border border-white/20 select-none">
                <img alt="Pristine Workspace Illustration" class="w-full h-auto object-cover transform scale-105"
                    referrerpolicy="no-referrer"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuA95p2_sdjszKECcBj7lNk9J40q6VMVdmf8mRrZUFY0wHlaZTqvvDIZk_BFsC1Y7hYYtg3Jd6ZDpJMQt-Sv39jQ5psUicrNvAN8qVl5chWI4LnxQUCCEjn9MjN0v2s3nxMhgWru8dOKcEydObx2BiXbd-nKzWGwKQl2QVelBV2un37ksHdF9vJK--C7z0y58qsnAI2aT3iCAo3oR_MJUHjeRvHkcb_IIXyKw-V3IJujf9nHBSQz69uajIUDysijZpybQxbD0GRtczhC" />
                <div class="absolute inset-0 bg-gradient-to-tr from-primary/15 via-transparent to-transparent"></div>
            </div>

            <div class="lg:col-span-6 w-full max-w-md mx-auto relative">
                <LoginForm />
            </div>
        </div>
    </section>
</template>
