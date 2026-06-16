<script setup>
import { ref } from 'vue';
import { User, Mail, Lock, Shield } from '@lucide/vue';

const emit = defineEmits(['submit', 'navigate', 'alert']);

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
  emit('submit', { name: name.value, email: email.value, password: password.value });
}
</script>

<template>
  <div class="glass-card rounded-[32px] p-8 md:p-10 shadow-lg relative z-10 w-full max-w-md text-center">
    <div class="text-center mb-8">
      <h1 class="text-3xl font-extrabold text-on-surface mb-2 font-sans tracking-tight">Join the future.</h1>
      <p class="text-on-surface-variant text-sm px-4">Elevate your career representation with AI-driven clarity.</p>
    </div>

    <form @submit.prevent="handleSubmit" class="space-y-4">
      <!-- Full Name -->
      <div class="space-y-1.5 text-left">
        <label class="text-xs font-bold text-on-surface-variant ml-1 uppercase tracking-wider" for="reg-name">Full Name</label>
        <div class="relative group">
          <span class="absolute left-4 top-1/2 -translate-y-1/2 text-outline-variant group-focus-within:text-primary transition-colors">
            <User class="w-5 h-5" />
          </span>
          <input 
            type="text" 
            id="reg-name" 
            v-model="name"
            placeholder="John Doe" 
            class="w-full pl-12 pr-4 py-3.5 bg-surface-container-low border border-transparent rounded-2xl focus:ring-2 focus:ring-primary/20 focus:border-primary/50 focus:bg-white transition-all text-sm outline-none text-on-surface font-sans"
          />
        </div>
      </div>

      <!-- Email -->
      <div class="space-y-1.5 text-left">
        <label class="text-xs font-bold text-on-surface-variant ml-1 uppercase tracking-wider" for="reg-email">Email Address</label>
        <div class="relative group">
          <span class="absolute left-4 top-1/2 -translate-y-1/2 text-outline-variant group-focus-within:text-primary transition-colors">
            <Mail class="w-5 h-5" />
          </span>
          <input 
            type="email" 
            id="reg-email" 
            v-model="email"
            placeholder="john@example.com" 
            class="w-full pl-12 pr-4 py-3.5 bg-surface-container-low border border-transparent rounded-2xl focus:ring-2 focus:ring-primary/20 focus:border-primary/50 focus:bg-white transition-all text-sm outline-none text-on-surface font-sans"
          />
        </div>
      </div>

      <!-- Password Grid of input boxes -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 font-sans">
        <div class="space-y-1.5 text-left">
          <label class="text-xs font-bold text-on-surface-variant ml-2 uppercase tracking-wider" for="reg-password">Password</label>
          <div class="relative group">
            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-outline-variant">
              <Lock class="w-4 h-4" />
            </span>
            <input 
              type="password" 
              id="reg-password" 
              v-model="password"
              placeholder="••••••••" 
              class="w-full pl-10 pr-3 py-3 bg-surface-container-low border border-transparent rounded-2xl focus:ring-2 focus:ring-primary/20 focus:border-primary/50 focus:bg-white transition-all text-sm outline-none text-on-surface font-sans"
            />
          </div>
        </div>

        <div class="space-y-1.5 text-left">
          <label class="text-xs font-bold text-on-surface-variant ml-2 uppercase tracking-wider" for="reg-confirm">Confirm</label>
          <div class="relative group">
            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-outline-variant">
              <Shield class="w-4 h-4" />
            </span>
            <input 
              type="password" 
              id="reg-confirm" 
              v-model="confirm"
              placeholder="••••••••" 
              class="w-full pl-10 pr-3 py-3 bg-surface-container-low border border-transparent rounded-2xl focus:ring-2 focus:ring-primary/20 focus:border-primary/50 focus:bg-white transition-all text-sm outline-none text-on-surface font-sans"
            />
          </div>
        </div>
      </div>

      <!-- Agreement Terms Checks -->
      <div class="flex items-start gap-3 px-2 py-2 text-left">
        <input 
          type="checkbox" 
          id="reg-terms" 
          v-model="agreeTerms"
          class="mt-1 w-4.5 h-4.5 rounded border-outline-variant text-primary focus:ring-primary/25 cursor-pointer"
        />
        <label for="reg-terms" class="text-xs text-on-surface-variant leading-relaxed cursor-pointer select-none">
          I agree to the 
          <span @click.stop="emit('alert', 'Displaying Terms of Service details.', 'info')" class="text-primary font-semibold hover:underline">Terms of Service</span> 
          and 
          <span @click.stop="emit('alert', 'Displaying Privacy Policy details.', 'info')" class="text-primary font-semibold hover:underline font-sans">Privacy Policy</span>.
        </label>
      </div>

      <!-- Complete Action CTA -->
      <button 
        type="submit"
        class="w-full bg-primary hover:bg-primary/95 text-white font-bold text-sm py-4 rounded-2xl shadow-lg shadow-primary/15 transition-all duration-200 active:scale-[0.98] mt-2 font-sans"
      >
        Create Account
      </button>
    </form>

    <div class="mt-8 pt-8 border-t border-outline-variant/20 text-center">
      <p class="text-sm text-on-surface-variant font-medium">
        Already have an account?
        <span @click="emit('navigate', 'login')" class="text-primary font-bold hover:underline cursor-pointer ml-1 font-sans">Sign In</span>
      </p>
    </div>
  </div>
</template>
