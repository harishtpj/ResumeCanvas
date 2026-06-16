<script setup>
import { ref } from 'vue';
import { Mail, Lock, Eye, EyeOff, ArrowRight } from '@lucide/vue';

const emit = defineEmits(['submit', 'google-submit', 'navigate', 'alert']);

const email = ref('');
const password = ref('');
const showPassword = ref(false);

function handleSubmit() {
  if (!email.value || !password.value) {
    emit('alert', 'Please write a valid email and password.', 'warning');
    return;
  }
  emit('submit', { email: email.value, password: password.value });
}
</script>

<template>
  <div class="glass-card atmospheric-shadow rounded-[32px] p-8 md:p-10 relative z-10 w-full max-w-md">
    <div class="text-center mb-8">
      <h1 class="text-3xl font-extrabold text-on-surface mb-2 font-sans tracking-tight">Welcome back</h1>
      <p class="text-on-surface-variant text-sm">Continue your career journey with ResumeCanvas AI</p>
    </div>

    <form @submit.prevent="handleSubmit" class="space-y-5">
      <!-- Email Field -->
      <div class="space-y-1.5 text-left">
        <label class="text-xs font-bold text-on-surface-variant ml-1 uppercase tracking-wider" for="login-email">Email Address</label>
        <div class="relative group">
          <span class="absolute left-4 top-1/2 -translate-y-1/2 text-outline-variant group-focus-within:text-primary transition-colors">
            <Mail class="w-5 h-5" />
          </span>
          <input 
            type="email" 
            id="login-email" 
            v-model="email"
            placeholder="alex@example.com" 
            class="w-full pl-12 pr-4 py-4 bg-surface-container-low border border-transparent rounded-2xl focus:ring-2 focus:ring-primary/20 focus:border-primary/50 focus:bg-white transition-all text-sm outline-none text-on-surface font-sans"
          />
        </div>
      </div>

      <!-- Password Field -->
      <div class="space-y-1.5 text-left">
        <div class="flex justify-between items-center px-1">
          <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider" for="login-password">Password</label>
          <span 
            @click="emit('alert', 'Password reset email sent to verification hub.', 'info')" 
            class="text-xs text-primary font-semibold hover:underline cursor-pointer"
          >Forgot?</span>
        </div>
        <div class="relative group">
          <span class="absolute left-4 top-1/2 -translate-y-1/2 text-outline-variant group-focus-within:text-primary transition-colors font-sans">
            <Lock class="w-5 h-5" />
          </span>
          <input 
            :type="showPassword ? 'text' : 'password'" 
            id="login-password" 
            v-model="password"
            placeholder="••••••••" 
            class="w-full pl-12 pr-12 py-4 bg-surface-container-low border border-transparent rounded-2xl focus:ring-2 focus:ring-primary/20 focus:border-primary/50 focus:bg-white transition-all text-sm outline-none text-on-surface font-sans"
          />
          <button 
            type="button" 
            @click="showPassword = !showPassword" 
            class="absolute right-4 top-1/2 -translate-y-1/2 text-outline-variant hover:text-on-surface transition-colors focus:outline-none"
          >
            <EyeOff v-if="showPassword" class="w-5 h-5" />
            <Eye v-else class="w-5 h-5" />
          </button>
        </div>
      </div>

      <!-- Submit and actions -->
      <div class="pt-2 space-y-4">
        <button 
          type="submit" 
          class="w-full py-4 bg-primary hover:bg-primary/95 text-white rounded-2xl font-bold text-sm shadow-lg shadow-primary/10 active:scale-[0.98] transition-all flex items-center justify-center gap-2"
        >
          <span>Sign In</span>
          <ArrowRight class="w-4 h-4" />
        </button>
        
        <div class="relative py-2 select-none">
          <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-outline-variant/30"></div>
          </div>
          <div class="relative flex justify-center text-xs uppercase">
            <span class="bg-white/0 px-2 text-outline-variant font-medium text-[10px] tracking-wider uppercase">Or continue with</span>
          </div>
        </div>

        <button 
          type="button"
          @click="emit('google-submit')"
          class="w-full py-3.5 bg-surface-container-lowest border border-outline-variant/30 hover:border-primary/50 text-on-surface rounded-2xl font-bold text-sm hover:bg-slate-50 transition-all flex items-center justify-center gap-3"
        >
          <img 
            src="https://lh3.googleusercontent.com/aida-public/AB6AXuAa8Fvx8uACf5X6yFdpYR8wMHak94KhfB6Zu2pZ7xpASPdwiB6oggRf1ngVZTYTJGICD3JTY5wOqxu308hUEVtY9KUkldfAREozZpS8B9LLebTmGx9nWnGufN778pOiW2rbBcHmj748npqnBopRiPMSlloskkNvuYUhAaDTG_QhdtUTfeKm-tb9e425r0Q2Cs7sqw8EWVmDHeM_HPpGl2WOjj6fx8TeDZeAPJDYx6LOCr3YZ_rndpUEA0TfTva7J9hv4rPeWqAFEhMl" 
            alt="Google logo" 
            class="w-5 h-5 object-contain"
          />
          Google Account
        </button>
      </div>
    </form>

    <!-- Secondary CTAs Link -->
    <div class="mt-8 text-center border-t border-outline-variant/20 pt-6">
      <p class="text-sm text-on-surface-variant font-medium">
        Don't have an account?
        <span @click="emit('navigate', 'register')" class="text-primary font-bold hover:underline cursor-pointer ml-1">Register</span>
      </p>
    </div>
  </div>
</template>
