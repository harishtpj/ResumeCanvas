<script setup>
import { ref } from 'vue';
import { ArrowRight, Eye, EyeOff, Lock, Mail } from '@lucide/vue';
import { Link, Form } from '@inertiajs/vue3';
import { register } from "@/routes/index.ts";
import { store } from "@/actions/App/Http/Controllers/Auth/SessionController";

const showPassword = ref(false);
</script>

<template>
    <div class="glass-card atmospheric-shadow rounded-[32px] p-8 md:p-10 relative z-10 w-full max-w-md">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-on-surface mb-2 font-sans tracking-tight">Welcome back</h1>
            <p class="text-on-surface-variant text-sm">Continue your career journey with ResumeCanvas</p>
        </div>

        <Form :action="store()" class="space-y-5" #default="{ errors, processing }">
            <!-- Email Field -->
            <div class="space-y-1.5 text-left">
                <label class="text-xs font-bold text-on-surface-variant ml-1 uppercase tracking-wider" for="email">Email
                    Address</label>
                <div class="relative group">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 transition-colors" :class="errors.email || errors.auth
                        ? 'text-red-500'
                        : 'text-outline-variant group-focus-within:text-primary'">
                        <Mail class="w-5 h-5" />
                    </span>
                    <input name="email" :class="[
                        'w-full pl-12 pr-4 py-4 bg-surface-container-low border rounded-2xl transition-all text-sm outline-none text-on-surface font-sans',
                        errors.email || errors.auth
                            ? 'border-red-400 ring-2 ring-red-500/20 bg-red-50/30'
                            : 'border-transparent focus:ring-2 focus:ring-primary/20 focus:border-primary/50 focus:bg-white'
                    ]" placeholder="john@example.com" type="email" required />
                </div>
                <p v-if="errors.email" class="mt-1 ml-2 text-xs font-medium text-red-500">
                    {{ errors.email }}
                </p>
            </div>

            <!-- Password Field -->
            <div class="space-y-1.5 text-left">
                <div class="flex justify-between items-center px-1">
                    <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider"
                        for="password">Password</label>
                </div>
                <div class="relative group">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 transition-colors" :class="errors.password || errors.auth
                        ? 'text-red-500'
                        : 'text-outline-variant group-focus-within:text-primary'">
                        <Lock class="w-5 h-5" />
                    </span>
                    <input name="password" :type="showPassword ? 'text' : 'password'" :class="[
                        'w-full pl-12 pr-12 py-4 bg-surface-container-low border rounded-2xl transition-all text-sm outline-none text-on-surface font-sans',
                        errors.password || errors.auth
                            ? 'border-red-400 ring-2 ring-red-500/20 bg-red-50/30'
                            : 'border-transparent focus:ring-2 focus:ring-primary/20 focus:border-primary/50 focus:bg-white'
                    ]" placeholder="••••••••" />
                    <button
                        class="absolute right-4 top-1/2 -translate-y-1/2 text-outline-variant hover:text-on-surface transition-colors focus:outline-none"
                        type="button" @click="showPassword = !showPassword">
                        <EyeOff v-if="showPassword" class="w-5 h-5" />
                        <Eye v-else class="w-5 h-5" />
                    </button>
                </div>
                <p v-if="errors.password" class="mt-1 ml-2 text-xs font-medium text-red-500">
                    {{ errors.password }}
                </p>
            </div>

            <div v-if="errors.auth"
                class="rounded-2xl border border-red-200 bg-red-50/80 px-4 py-3 text-sm text-red-700 text-left">
                {{ errors.auth }}
            </div>

            <div class="pt-2 space-y-4">
                <button class="w-full py-4 bg-primary hover:bg-primary/95 text-white rounded-2xl font-bold text-sm shadow-lg shadow-primary/10 active:scale-[0.98] transition-all flex items-center justify-center gap-2 disabled:opacity-70 Fdisabled:cursor-not-allowed disabled:hover:bg-primary disabled:shadow-none disabled:active:scale-100" type="submit" :disabled="processing">
                    <span>{{ processing ? "Signing In..." : "Sign In" }}</span>
                    <ArrowRight class="w-4 h-4" />
                </button>
            </div>
        </Form>

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
