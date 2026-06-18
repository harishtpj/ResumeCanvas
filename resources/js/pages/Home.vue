<script setup>
import {
  Sparkle,
  FileText,
  PenTool,
  Maximize2,
  Shield,
  ArrowRight
} from '@lucide/vue';
import { Link } from '@inertiajs/vue3';
import { register } from '@/routes/index';

</script>

<template>
  <section class="pt-32 pb-24 px-4 w-full flex flex-col items-center">
    <div class="w-full max-w-[1280px] mx-auto flex flex-col items-center select-none text-center">

      <div class="max-w-3xl mx-auto flex flex-col items-center gap-6 mb-12">
        <span
          class="inline-flex items-center gap-2 bg-primary/8 text-primary px-4 py-1.5 rounded-full text-xs font-semibold uppercase tracking-wider">
          <Sparkle class="w-3.5 h-3.5 animate-spin" style="animation-duration: 8s" />
          AI-Powered Career Evolution
        </span>
        <h1
          class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-on-surface tracking-tight font-sans leading-[1.1] max-w-2xl">
          Transform your Resume into a <span
            class="text-primary bg-gradient-to-r from-primary to-primary-container bg-clip-text text-transparent">Living
            Portfolio</span>
        </h1>
        <p class="text-base md:text-lg text-on-surface-variant max-w-xl mx-auto leading-relaxed">
          Ditch the static PDF. Our AI engine deconstructs your career history and reassembles it into a
          high-performance, interactive digital showcase.
        </p>
      </div>

      <!-- Futuristic Glassmorphic Mockup Showcase Banner -->
      <div
        class="w-full max-w-4xl mx-auto mb-16 rounded-3xl overflow-hidden glass-card p-2 md:p-3 shadow-lg border border-white/30 group transition-all duration-700 hover:shadow-2xl">
        <div class="rounded-2xl overflow-hidden relative shadow-inner bg-slate-50">
          <img
            src="https://lh3.googleusercontent.com/aida-public/AB6AXuCnhf1sDN3du4I1lZ4rpcL4AKaZXxmKLVFn7zCT9bhhoJ2hpTEpEUfN8jO11Q5--NVCU6AmXwqFmvHatlVEWRTOT3M0ZASLIrgM2Dx3l4hn08o41ZqGDcfpuXeE_MrL4t_uIGlolAhi1FJnBU1QC9QkCfyr_sNs0drWBN1Kn_nXbL_RQhOKp2rYP_psQFMPaMCmcArOxHgxr7fiDNha7NTXvoHpQxIUWvSZ0ZPUkXXGFNRJH0-CDKCS5rbL0WTge5Zk8NKd1gOobB11"
            alt="Living Portfolio Mockup Screen Display"
            class="w-full h-auto object-cover transform duration-1000 group-hover:scale-[1.02]"
            referrerpolicy="no-referrer" />
          <div
            class="absolute inset-0 bg-gradient-to-t from-primary/10 via-transparent to-transparent pointer-events-none">
          </div>
        </div>
      </div>

      <div class="w-full max-w-[1280px] mx-auto py-8 border-t border-slate-100 text-left">
        <div class="text-center md:text-left mb-12 max-w-xl">
          <h2 class="text-2xl md:text-3xl font-extrabold text-on-surface mb-2 font-sans">Professional precision in three
            steps</h2>
          <p class="text-on-surface-variant text-sm">Designed for modern hiring workflows that reward interactive
            clarity.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <!-- Step 1 -->
          <div
            class="glass-card p-8 rounded-2xl flex flex-col items-start hover:border-primary/25 transition-all group h-full">
            <div
              class="w-10 h-10 rounded-xl bg-primary-container/20 text-primary font-bold flex items-center justify-center mb-6 group-hover:bg-primary group-hover:text-white transition-colors">
              1
            </div>
            <FileText class="w-6 h-6 text-primary mb-4" />
            <h3 class="font-bold text-lg text-on-surface mb-2 font-sans">Upload PDF</h3>
            <p class="text-on-surface-variant text-sm leading-relaxed">
              Simply drag your existing document into our application. We handle the heavy lifting of parsing your
              resume.
            </p>
          </div>

          <!-- Step 2 -->
          <div
            class="glass-card p-8 rounded-2xl flex flex-col items-start hover:border-primary/25 transition-all group h-full">
            <div
              class="w-10 h-10 rounded-xl bg-primary-container/20 text-primary font-bold flex items-center justify-center mb-6 group-hover:bg-primary group-hover:text-white transition-colors">
              2
            </div>
            <PenTool class="w-6 h-6 text-primary mb-4" />
            <h3 class="font-bold text-lg text-on-surface mb-2 font-sans">AI Tailors Design</h3>
            <p class="text-on-surface-variant text-sm leading-relaxed">
              Our Agent analyzes your resume and crafts a suited layout that highlights your unique impact.
            </p>
          </div>

          <!-- Step 3 -->
          <div
            class="glass-card p-8 rounded-2xl flex flex-col items-start hover:border-primary/25 transition-all group h-full">
            <div
              class="w-10 h-10 rounded-xl bg-primary-container/20 text-primary font-bold flex items-center justify-center mb-6 group-hover:bg-primary group-hover:text-white transition-colors">
              3
            </div>
            <Sparkle class="w-6 h-6 text-primary mb-4" />
            <h3 class="font-bold text-lg text-on-surface mb-2 font-sans">Go Live</h3>
            <p class="text-on-surface-variant text-sm leading-relaxed font-sans">
              Preview and Download the generated portfolio. Neatly designed with built-in interactivity for easy usage.
            </p>
          </div>
        </div>
      </div>

      <!-- Bottom CTA Banner Section -->
      <div
        class="w-full max-w-4xl mx-auto mt-8 relative rounded-3xl overflow-hidden glass-card p-10 md:p-16 border border-white/40 text-center">
        <div class="absolute inset-0 bg-primary/5 -z-10 bg-gradient-to-br from-primary/5 to-secondary/5"></div>
        <div class="relative z-10 flex flex-col items-center gap-6">
          <h2 class="text-3xl md:text-4xl font-extrabold text-on-surface tracking-tight font-sans">Ready to go beyond
            paper?</h2>
          <p class="text-on-surface-variant text-base max-w-lg font-sans">
            Join now to get your customized portfolio and upgrade your career narrative with interactive showcase.
          </p>
          <Link :href="register()" as="button"
            class="bg-primary hover:bg-primary/95 text-white font-bold text-base px-10 py-4 rounded-full shadow-lg shadow-primary/20 transition-all active:scale-[0.98]">
            Start Your Canvas Now
          </Link>
        </div>
      </div>

    </div>
  </section>
</template>
