<script setup>
import {Lock, Mail, Shield, User} from '@lucide/vue';
import {Form, Link} from '@inertiajs/vue3';
import {login} from "@/routes/index.ts";
import {store} from "@/actions/App/Http/Controllers/Auth/RegistrationController";
</script>

<template>
    <div class="glass-card rounded-[32px] p-8 md:p-10 shadow-lg relative z-10 w-full max-w-md text-center">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-on-surface mb-2 font-sans tracking-tight">Join the future.</h1>
            <p class="text-on-surface-variant text-sm px-4">Elevate your career representation with AI-driven
                clarity.</p>
        </div>

        <Form :action="store()" class="space-y-4">
            <!-- Full Name -->
            <div class="space-y-1.5 text-left">
                <label class="text-xs font-bold text-on-surface-variant ml-1 uppercase tracking-wider" for="name">Full
                    Name</label>
                <div class="relative group">
          <span
              class="absolute left-4 top-1/2 -translate-y-1/2 text-outline-variant group-focus-within:text-primary transition-colors">
            <User class="w-5 h-5"/>
          </span>
                    <input
                        class="w-full pl-12 pr-4 py-3.5 bg-surface-container-low border border-transparent rounded-2xl focus:ring-2 focus:ring-primary/20 focus:border-primary/50 focus:bg-white transition-all text-sm outline-none text-on-surface font-sans"
                        name="name"
                        placeholder="John Doe"
                        required
                        type="text"
                    />
                </div>
            </div>

            <!-- Email -->
            <div class="space-y-1.5 text-left">
                <label class="text-xs font-bold text-on-surface-variant ml-1 uppercase tracking-wider" for="email">Email
                    Address</label>
                <div class="relative group">
          <span
              class="absolute left-4 top-1/2 -translate-y-1/2 text-outline-variant group-focus-within:text-primary transition-colors">
            <Mail class="w-5 h-5"/>
          </span>
                    <input
                        class="w-full pl-12 pr-4 py-3.5 bg-surface-container-low border border-transparent rounded-2xl focus:ring-2 focus:ring-primary/20 focus:border-primary/50 focus:bg-white transition-all text-sm outline-none text-on-surface font-sans"
                        name="email"
                        placeholder="john@example.com"
                        required
                        type="email"
                    />
                </div>
            </div>

            <!-- Password Grid of input boxes -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 font-sans">
                <div class="space-y-1.5 text-left">
                    <label class="text-xs font-bold text-on-surface-variant ml-2 uppercase tracking-wider"
                           for="password">Password</label>
                    <div class="relative group">
            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-outline-variant">
              <Lock class="w-4 h-4"/>
            </span>
                        <input
                            class="w-full pl-10 pr-3 py-3 bg-surface-container-low border border-transparent rounded-2xl focus:ring-2 focus:ring-primary/20 focus:border-primary/50 focus:bg-white transition-all text-sm outline-none text-on-surface font-sans"
                            name="password"
                            placeholder="••••••••"
                            required
                            type="password"
                        />
                    </div>
                </div>

                <div class="space-y-1.5 text-left">
                    <label class="text-xs font-bold text-on-surface-variant ml-2 uppercase tracking-wider"
                           for="password_confirmation">Confirm</label>
                    <div class="relative group">
            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-outline-variant">
              <Shield class="w-4 h-4"/>
            </span>
                        <input
                            class="w-full pl-10 pr-3 py-3 bg-surface-container-low border border-transparent rounded-2xl focus:ring-2 focus:ring-primary/20 focus:border-primary/50 focus:bg-white transition-all text-sm outline-none text-on-surface font-sans"
                            name="password_confirmation"
                            placeholder="••••••••"
                            required
                            type="password"
                        />
                    </div>
                </div>
            </div>

            <button
                class="w-full bg-primary hover:bg-primary/95 text-white font-bold text-sm py-4 rounded-2xl shadow-lg shadow-primary/15 transition-all duration-200 active:scale-[0.98] mt-2 font-sans"
                type="submit"
            >
                Create Account
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
