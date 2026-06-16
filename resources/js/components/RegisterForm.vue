<script setup>
import {ref} from 'vue';
import {Lock, Mail, Shield, User} from '@lucide/vue';
import {Link} from '@inertiajs/vue3';
import {login} from "@/routes/index.ts";

const name = ref('');
const email = ref('');
const password = ref('');
const confirm = ref('');
const agreeTerms = ref(false);

function handleSubmit() {
    if (!name.value || !email.value || !password.value) {
        emit('alert', 'Please fill out all the user registration fields.', 'warning');
        return;
    }
    if (password.value !== confirm.value) {
        emit('alert', 'Passwords do not match.', 'warning');
        return;
    }
    if (!agreeTerms.value) {
        emit('alert', 'Please accept the Terms of Service to continue.', 'warning');
        return;
    }
    emit('submit', {name: name.value, email: email.value, password: password.value});
}
</script>

<template>
    <div class="glass-card rounded-[32px] p-8 md:p-10 shadow-lg relative z-10 w-full max-w-md text-center">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-on-surface mb-2 font-sans tracking-tight">Join the future.</h1>
            <p class="text-on-surface-variant text-sm px-4">Elevate your career representation with AI-driven
                clarity.</p>
        </div>

        <form class="space-y-4" @submit.prevent="handleSubmit">
            <!-- Full Name -->
            <div class="space-y-1.5 text-left">
                <label class="text-xs font-bold text-on-surface-variant ml-1 uppercase tracking-wider" for="reg-name">Full
                    Name</label>
                <div class="relative group">
          <span
              class="absolute left-4 top-1/2 -translate-y-1/2 text-outline-variant group-focus-within:text-primary transition-colors">
            <User class="w-5 h-5"/>
          </span>
                    <input
                        id="reg-name"
                        v-model="name"
                        class="w-full pl-12 pr-4 py-3.5 bg-surface-container-low border border-transparent rounded-2xl focus:ring-2 focus:ring-primary/20 focus:border-primary/50 focus:bg-white transition-all text-sm outline-none text-on-surface font-sans"
                        placeholder="John Doe"
                        type="text"
                    />
                </div>
            </div>

            <!-- Email -->
            <div class="space-y-1.5 text-left">
                <label class="text-xs font-bold text-on-surface-variant ml-1 uppercase tracking-wider" for="reg-email">Email
                    Address</label>
                <div class="relative group">
          <span
              class="absolute left-4 top-1/2 -translate-y-1/2 text-outline-variant group-focus-within:text-primary transition-colors">
            <Mail class="w-5 h-5"/>
          </span>
                    <input
                        id="reg-email"
                        v-model="email"
                        class="w-full pl-12 pr-4 py-3.5 bg-surface-container-low border border-transparent rounded-2xl focus:ring-2 focus:ring-primary/20 focus:border-primary/50 focus:bg-white transition-all text-sm outline-none text-on-surface font-sans"
                        placeholder="john@example.com"
                        type="email"
                    />
                </div>
            </div>

            <!-- Password Grid of input boxes -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 font-sans">
                <div class="space-y-1.5 text-left">
                    <label class="text-xs font-bold text-on-surface-variant ml-2 uppercase tracking-wider"
                           for="reg-password">Password</label>
                    <div class="relative group">
            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-outline-variant">
              <Lock class="w-4 h-4"/>
            </span>
                        <input
                            id="reg-password"
                            v-model="password"
                            class="w-full pl-10 pr-3 py-3 bg-surface-container-low border border-transparent rounded-2xl focus:ring-2 focus:ring-primary/20 focus:border-primary/50 focus:bg-white transition-all text-sm outline-none text-on-surface font-sans"
                            placeholder="••••••••"
                            type="password"
                        />
                    </div>
                </div>

                <div class="space-y-1.5 text-left">
                    <label class="text-xs font-bold text-on-surface-variant ml-2 uppercase tracking-wider"
                           for="reg-confirm">Confirm</label>
                    <div class="relative group">
            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-outline-variant">
              <Shield class="w-4 h-4"/>
            </span>
                        <input
                            id="reg-confirm"
                            v-model="confirm"
                            class="w-full pl-10 pr-3 py-3 bg-surface-container-low border border-transparent rounded-2xl focus:ring-2 focus:ring-primary/20 focus:border-primary/50 focus:bg-white transition-all text-sm outline-none text-on-surface font-sans"
                            placeholder="••••••••"
                            type="password"
                        />
                    </div>
                </div>
            </div>

            <!-- Complete Action CTA -->
            <button
                class="w-full bg-primary hover:bg-primary/95 text-white font-bold text-sm py-4 rounded-2xl shadow-lg shadow-primary/15 transition-all duration-200 active:scale-[0.98] mt-2 font-sans"
                type="submit"
            >
                Create Account
            </button>
        </form>

        <div class="mt-8 pt-8 border-t border-outline-variant/20 text-center">
            <p class="text-sm text-on-surface-variant font-medium">
                Already have an account?
                <Link :href="login()" as="span"
                      class="text-primary font-bold hover:underline cursor-pointer ml-1 font-sans">Sign In</Link>
            </p>
        </div>
    </div>
</template>
