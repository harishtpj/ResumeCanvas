<script setup>
import {ref} from 'vue';
import {ArrowRight, Eye, EyeOff, Lock, Mail} from '@lucide/vue';
import {Link} from '@inertiajs/vue3';
import {register} from "@/routes/index.ts";

const email = ref('');
const password = ref('');
const showPassword = ref(false);

function handleSubmit() {
    if (!email.value || !password.value) {
        emit('alert', 'Please write a valid email and password.', 'warning');
        return;
    }
    emit('submit', {email: email.value, password: password.value});
}
</script>

<template>
    <div class="glass-card atmospheric-shadow rounded-[32px] p-8 md:p-10 relative z-10 w-full max-w-md">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-on-surface mb-2 font-sans tracking-tight">Welcome back</h1>
            <p class="text-on-surface-variant text-sm">Continue your career journey with ResumeCanvas</p>
        </div>

        <form class="space-y-5" @submit.prevent="handleSubmit">
            <!-- Email Field -->
            <div class="space-y-1.5 text-left">
                <label class="text-xs font-bold text-on-surface-variant ml-1 uppercase tracking-wider"
                       for="login-email">Email Address</label>
                <div class="relative group">
          <span
              class="absolute left-4 top-1/2 -translate-y-1/2 text-outline-variant group-focus-within:text-primary transition-colors">
            <Mail class="w-5 h-5"/>
          </span>
                    <input
                        id="login-email"
                        v-model="email"
                        class="w-full pl-12 pr-4 py-4 bg-surface-container-low border border-transparent rounded-2xl focus:ring-2 focus:ring-primary/20 focus:border-primary/50 focus:bg-white transition-all text-sm outline-none text-on-surface font-sans"
                        placeholder="alex@example.com"
                        type="email"
                    />
                </div>
            </div>

            <!-- Password Field -->
            <div class="space-y-1.5 text-left">
                <div class="flex justify-between items-center px-1">
                    <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider"
                           for="login-password">Password</label>
                    <span
                        class="text-xs text-primary font-semibold hover:underline cursor-pointer"
                        @click="emit('alert', 'Password reset email sent to verification hub.', 'info')"
                    >Forgot?</span>
                </div>
                <div class="relative group">
          <span
              class="absolute left-4 top-1/2 -translate-y-1/2 text-outline-variant group-focus-within:text-primary transition-colors font-sans">
            <Lock class="w-5 h-5"/>
          </span>
                    <input
                        id="login-password"
                        v-model="password"
                        :type="showPassword ? 'text' : 'password'"
                        class="w-full pl-12 pr-12 py-4 bg-surface-container-low border border-transparent rounded-2xl focus:ring-2 focus:ring-primary/20 focus:border-primary/50 focus:bg-white transition-all text-sm outline-none text-on-surface font-sans"
                        placeholder="••••••••"
                    />
                    <button
                        class="absolute right-4 top-1/2 -translate-y-1/2 text-outline-variant hover:text-on-surface transition-colors focus:outline-none"
                        type="button"
                        @click="showPassword = !showPassword"
                    >
                        <EyeOff v-if="showPassword" class="w-5 h-5"/>
                        <Eye v-else class="w-5 h-5"/>
                    </button>
                </div>
            </div>

            <!-- Submit and actions -->
            <div class="pt-2 space-y-4">
                <button
                    class="w-full py-4 bg-primary hover:bg-primary/95 text-white rounded-2xl font-bold text-sm shadow-lg shadow-primary/10 active:scale-[0.98] transition-all flex items-center justify-center gap-2"
                    type="submit"
                >
                    <span>Sign In</span>
                    <ArrowRight class="w-4 h-4"/>
                </button>
            </div>
        </form>

        <div class="mt-8 text-center border-t border-outline-variant/20 pt-6">
            <p class="text-sm text-on-surface-variant font-medium">
                Don't have an account?
                <Link :href="register()" as="span" class="text-primary font-bold hover:underline cursor-pointer ml-1">
                    Register
                </Link>
            </p>
        </div>
    </div>
</template>
