<script setup>
import { Lock, Mail, Shield, User } from '@lucide/vue';
import { Form, Link } from '@inertiajs/vue3';
import { login } from "@/routes/index.ts";
import { store } from "@/actions/App/Http/Controllers/Auth/RegistrationController";

</script>

<template>
    <div class="glass-card rounded-[32px] p-8 md:p-10 shadow-lg relative z-10 w-full max-w-md text-center">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-on-surface mb-2 font-sans tracking-tight">Join the future.</h1>
            <p class="text-on-surface-variant text-sm px-4">Elevate your career representation with AI-driven
                clarity.</p>
        </div>

        <Form :action="store()" class="space-y-4" #default="{ errors, processing }">
            <!-- Full Name -->
            <div class="space-y-1.5 text-left">
                <label class="text-xs font-bold text-on-surface-variant ml-1 uppercase tracking-wider" for="name">Full
                    Name</label>
                <div class="relative group">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 transition-colors" :class="errors.name
                        ? 'text-red-500'
                        : 'text-outline-variant group-focus-within:text-primary'">
                        <User class="w-5 h-5" />
                    </span>
                    <input :class="[
                        'w-full pl-12 pr-4 py-3.5 bg-surface-container-low border rounded-2xl transition-all text-sm outline-none text-on-surface font-sans',
                        errors.name
                            ? 'border-red-400 ring-2 ring-red-500/20 bg-red-50/30'
                            : 'border-transparent focus:ring-2 focus:ring-primary/20 focus:border-primary/50 focus:bg-white'
                    ]" name="name" placeholder="John Doe" required type="text" />
                </div>
                <p v-if="errors.name" class="mt-1 ml-2 text-xs font-medium text-red-500">
                    {{ errors.name }}
                </p>
            </div>

            <!-- Email -->
            <div class="space-y-1.5 text-left">
                <label class="text-xs font-bold text-on-surface-variant ml-1 uppercase tracking-wider" for="email">Email
                    Address</label>
                <div class="relative group">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 transition-colors" :class="errors.email
                        ? 'text-red-500'
                        : 'text-outline-variant group-focus-within:text-primary'">
                        <Mail class="w-5 h-5" />
                    </span>
                    <input :class="[
                        'w-full pl-12 pr-4 py-3.5 bg-surface-container-low border rounded-2xl transition-all text-sm outline-none text-on-surface font-sans',
                        errors.email
                            ? 'border-red-400 ring-2 ring-red-500/20 bg-red-50/30'
                            : 'border-transparent focus:ring-2 focus:ring-primary/20 focus:border-primary/50 focus:bg-white'
                    ]" name="email" placeholder="john@example.com" required type="email" />
                </div>
                <p v-if="errors.email" class="mt-1 ml-2 text-xs font-medium text-red-500">
                    {{ errors.email }}
                </p>
            </div>

            <!-- Password Grid of input boxes -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 font-sans">
                <div class="space-y-1.5 text-left">
                    <label class="text-xs font-bold text-on-surface-variant ml-2 uppercase tracking-wider"
                        for="password">Password</label>
                    <div class="relative group">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 transition-colors" :class="errors.password
                            ? 'text-red-500'
                            : 'text-outline-variant'">
                            <Lock class="w-4 h-4" />
                        </span>
                        <input :class="[
                            'w-full pl-10 pr-3 py-3 bg-surface-container-low border rounded-2xl transition-all text-sm outline-none text-on-surface font-sans',
                            errors.password
                                ? 'border-red-400 ring-2 ring-red-500/20 bg-red-50/30'
                                : 'border-transparent focus:ring-2 focus:ring-primary/20 focus:border-primary/50 focus:bg-white'
                        ]" name="password" placeholder="••••••••" required type="password" />
                    </div>
                </div>

                <div class="space-y-1.5 text-left">
                    <label class="text-xs font-bold text-on-surface-variant ml-2 uppercase tracking-wider"
                        for="password_confirmation">Confirm</label>
                    <div class="relative group">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 transition-colors" :class="errors.password
                            ? 'text-red-500'
                            : 'text-outline-variant'">
                            <Shield class="w-4 h-4" />
                        </span>
                        <input :class="[
                            'w-full pl-10 pr-3 py-3 bg-surface-container-low border rounded-2xl transition-all text-sm outline-none text-on-surface font-sans',
                            errors.password
                                ? 'border-red-400 ring-2 ring-red-500/20 bg-red-50/30'
                                : 'border-transparent focus:ring-2 focus:ring-primary/20 focus:border-primary/50 focus:bg-white'
                        ]" name="password_confirmation" placeholder="••••••••" required type="password" />
                    </div>
                </div>
            </div>
            <p v-if="errors.password" class="mt-1 ml-2 text-xs font-medium text-red-500 text-left">
                {{ errors.password }}
            </p>

            <button
                class="w-full bg-primary hover:bg-primary/95 text-white font-bold text-sm py-4 rounded-2xl shadow-lg shadow-primary/15 transition-all duration-200 active:scale-[0.98] mt-2 font-sans disabled:opacity-70 disabled:cursor-not-allowed disabled:hover:bg-primary disabled:shadow-none disabled:active:scale-100"
                type="submit" :disabled="processing">
                {{ processing ? "Creating Account..." : "Create Account" }}
            </button>
        </Form>

        <div class="mt-8 pt-8 border-t border-outline-variant/20 text-center">
            <p class="text-sm text-on-surface-variant font-medium">
                Already have an account?
                <Link :href="login()" as="span"
                    class="text-primary font-bold hover:underline cursor-pointer ml-1 font-sans">Sign In
                </Link>
            </p>
        </div>
    </div>
</template>
