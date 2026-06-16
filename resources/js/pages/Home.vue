<script setup>
import { 
  Sparkle, 
  FileText, 
  PenTool, 
  Maximize2, 
  Shield, 
  ArrowRight 
} from '@lucide/vue';
import ResumeUploader from '../components/ResumeUploader.vue';

</script>

<template>
  <section class="pt-32 pb-24 px-4 w-full flex flex-col items-center">
    <div class="w-full max-w-[1280px] mx-auto flex flex-col items-center select-none text-center">
      
      <div class="max-w-3xl mx-auto flex flex-col items-center gap-6 mb-12">
        <span class="inline-flex items-center gap-2 bg-primary/8 text-primary px-4 py-1.5 rounded-full text-xs font-semibold uppercase tracking-wider">
          <Sparkle class="w-3.5 h-3.5 animate-spin" style="animation-duration: 8s" />
          AI-Powered Career Evolution
        </span>
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-on-surface tracking-tight font-sans leading-[1.1] max-w-2xl">
          Transform your Resume into a <span class="text-primary bg-gradient-to-r from-primary to-primary-container bg-clip-text text-transparent">Living Portfolio</span>
        </h1>
        <p class="text-base md:text-lg text-on-surface-variant max-w-xl mx-auto leading-relaxed">
          Ditch the static PDF. Our AI engine deconstructs your career history and reassembles it into a high-performance, interactive digital showcase.
        </p>
      </div>

      <!-- Futuristic Glassmorphic Mockup Showcase Banner -->
      <div class="w-full max-w-4xl mx-auto mb-16 rounded-3xl overflow-hidden glass-card p-2 md:p-3 shadow-lg border border-white/30 group transition-all duration-700 hover:shadow-2xl">
        <div class="rounded-2xl overflow-hidden relative shadow-inner bg-slate-50">
          <img 
            src="https://lh3.googleusercontent.com/aida-public/AB6AXuCnhf1sDN3du4I1lZ4rpcL4AKaZXxmKLVFn7zCT9bhhoJ2hpTEpEUfN8jO11Q5--NVCU6AmXwqFmvHatlVEWRTOT3M0ZASLIrgM2Dx3l4hn08o41ZqGDcfpuXeE_MrL4t_uIGlolAhi1FJnBU1QC9QkCfyr_sNs0drWBN1Kn_nXbL_RQhOKp2rYP_psQFMPaMCmcArOxHgxr7fiDNha7NTXvoHpQxIUWvSZ0ZPUkXXGFNRJH0-CDKCS5rbL0WTge5Zk8NKd1gOobB11" 
            alt="Living Portfolio Mockup Screen Display" 
            class="w-full h-auto object-cover transform duration-1000 group-hover:scale-[1.02]"
            referrerpolicy="no-referrer"
          />
          <div class="absolute inset-0 bg-gradient-to-t from-primary/10 via-transparent to-transparent pointer-events-none"></div>
        </div>
      </div>

      <!-- Drag and Drop Resume Uploader Component -->
      <ResumeUploader @uploaded="(name) => emit('uploaded', name)" />

      <!-- Professional Precision in Steps Section -->
      <div class="w-full max-w-[1280px] mx-auto py-8 border-t border-slate-100 text-left">
        <div class="text-center md:text-left mb-12 max-w-xl">
          <h2 class="text-2xl md:text-3xl font-extrabold text-on-surface mb-2 font-sans">Professional precision in three steps</h2>
          <p class="text-on-surface-variant text-sm">Designed for modern hiring workflows that reward interactive clarity.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <!-- Step 1 -->
          <div class="glass-card p-8 rounded-2xl flex flex-col items-start hover:border-primary/25 transition-all group h-full">
            <div class="w-10 h-10 rounded-xl bg-primary-container/20 text-primary font-bold flex items-center justify-center mb-6 group-hover:bg-primary group-hover:text-white transition-colors">
              1
            </div>
            <FileText class="w-6 h-6 text-primary mb-4" />
            <h3 class="font-bold text-lg text-on-surface mb-2 font-sans">Upload PDF</h3>
            <p class="text-on-surface-variant text-sm leading-relaxed">
              Simply drag your existing document into our engine. We handle the heavy lifting of parsing data structures.
            </p>
          </div>

          <!-- Step 2 -->
          <div class="glass-card p-8 rounded-2xl flex flex-col items-start hover:border-primary/25 transition-all group h-full">
            <div class="w-10 h-10 rounded-xl bg-primary-container/20 text-primary font-bold flex items-center justify-center mb-6 group-hover:bg-primary group-hover:text-white transition-colors">
              2
            </div>
            <PenTool class="w-6 h-6 text-primary mb-4" />
            <h3 class="font-bold text-lg text-on-surface mb-2 font-sans">AI Tailors Design</h3>
            <p class="text-on-surface-variant text-sm leading-relaxed">
              Our network analyzes your industry and crafts a glassmorphic layout that highlights your unique impact.
            </p>
          </div>

          <!-- Step 3 -->
          <div class="glass-card p-8 rounded-2xl flex flex-col items-start hover:border-primary/25 transition-all group h-full">
            <div class="w-10 h-10 rounded-xl bg-primary-container/20 text-primary font-bold flex items-center justify-center mb-6 group-hover:bg-primary group-hover:text-white transition-colors">
              3
            </div>
            <Sparkle class="w-6 h-6 text-primary mb-4" />
            <h3 class="font-bold text-lg text-on-surface mb-2 font-sans">Go Live</h3>
            <p class="text-on-surface-variant text-sm leading-relaxed font-sans">
              Publish your personal link or embed it. SEO-optimized and mobile-ready for any high-stakes recruiter visits.
            </p>
          </div>
        </div>
      </div>

      <!-- Feature Bento Grid presentation -->
      <div class="w-full max-w-[1280px] mx-auto py-16 gap-6 flex flex-col">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6 h-auto md:h-[640px] text-left">
          <!-- Large feature screenshot card -->
          <div class="md:col-span-8 glass-card rounded-3xl overflow-hidden relative group flex flex-col min-h-[400px] md:min-h-0">
            <div class="h-1/2 md:h-full w-full overflow-hidden">
              <img 
                src="https://lh3.googleusercontent.com/aida-public/AB6AXuDhMgPH6LqXEKZ-fcDwv9mYYgyW2ch88jeBCU6Tij-MPuTvZNsyayU4WWmxgrWKpOuQg5cessSTbTunQ_lDwcukvwFpGol7pyxPY68GFhsyQxmV_1FoHZK0XYNumHsHpI8OR4vNFBqnk1rCZif4Jq6EeyIJzQpfquYElc-9YZjYXaKVEP17hbozGRT0TPSeWpth6oTZXE_FjSlaOOdmzeWHXLhsfn-DeeHOOjwrZYrcGUUDNtWi_sewsko538XVmU0QfjHoVdLCSDOY" 
                alt="Living Dashboard Mockup Analytical Preview" 
                class="w-full h-full object-cover opacity-90 group-hover:scale-105 duration-1000"
                referrerpolicy="no-referrer"
              />
            </div>
            <div class="absolute inset-0 bg-gradient-to-t from-white via-white/75 md:via-white/40 to-transparent p-6 md:p-10 flex flex-col justify-end">
              <span class="text-primary font-bold text-xs tracking-wider mb-2 uppercase font-sans">Intelligent Preview</span>
              <h3 class="font-bold text-2xl md:text-3xl text-on-surface mb-3 tracking-tight font-sans">The Analytics of Impact</h3>
              <p class="text-on-surface-variant text-sm max-w-md font-sans">
                Track exactly when and where recruiters interact with your portfolio elements. Data-driven career growth starts here.
              </p>
            </div>
          </div>

          <!-- Side column card grid -->
          <div class="md:col-span-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-1 gap-6">
            <!-- Box 1 -->
            <div class="glass-card rounded-3xl p-6 md:p-8 flex flex-col justify-center border-l-4 border-primary">
              <div class="w-10 h-10 rounded-xl bg-primary/5 text-primary flex items-center justify-center mb-4">
                <Maximize2 class="w-5 h-5" />
              </div>
              <h3 class="font-bold text-lg text-on-surface mb-2 font-sans font-sans">Universal Response</h3>
              <p class="text-on-surface-variant text-xs leading-relaxed font-sans">
                Your portfolio scales dynamically from widescreen 4K displays to tablets and phone layout configurations seamlessly.
              </p>
            </div>
            <!-- Box 2 -->
            <div class="glass-card rounded-3xl p-6 md:p-8 flex flex-col justify-center border-l-4 border-secondary bg-emerald-50/10">
              <div class="w-10 h-10 rounded-xl bg-secondary/5 text-secondary flex items-center justify-center mb-4 font-sans">
                <Shield class="w-5 h-5 text-secondary" />
              </div>
              <h3 class="font-bold text-lg text-on-surface mb-2 font-sans">Secure Hosting</h3>
              <p class="text-on-surface-variant text-xs leading-relaxed font-sans">
                Enterprise grade privacy first. Password protect custom panels, files or the full layout during sensitive transitions.
              </p>
            </div>
          </div>
        </div>

        <!-- Bottom wide detail drawer -->
        <div class="glass-card rounded-3xl p-6 md:p-8 flex flex-col md:flex-row items-center gap-6 md:gap-8 group hover:border-primary/25 transition-all text-left">
          <div class="flex-shrink-0 w-16 h-16 md:w-20 md:h-20 rounded-2xl bg-indigo-50 border border-outline-variant/30 flex items-center justify-center group-hover:scale-105 transition-transform duration-300">
            <PenTool class="w-8 h-8 text-primary" />
          </div>
          <div class="flex-1">
            <h3 class="font-bold text-lg text-on-surface mb-1 font-sans">Bespoke Templates</h3>
            <p class="text-on-surface-variant text-sm font-sans">
              Choose from a curated collection of layouts designed by design recruitment agencies at industry leaders. Every pixel is optimized for layout parsing.
            </p>
          </div>
          <button 
            @click="emit('alert', 'Accessing recruiters catalog. Ready.', 'info')" 
            class="text-primary font-bold text-sm flex items-center gap-2 hover:translate-x-1 duration-200"
          >
            Explore Templates
            <ArrowRight class="w-4 h-4" />
          </button>
        </div>
      </div>

      <!-- Bottom CTA Banner Section -->
      <div class="w-full max-w-4xl mx-auto mt-8 relative rounded-3xl overflow-hidden glass-card p-10 md:p-16 border border-white/40 text-center">
        <div class="absolute inset-0 bg-primary/5 -z-10 bg-gradient-to-br from-primary/5 to-secondary/5"></div>
        <div class="relative z-10 flex flex-col items-center gap-6">
          <h2 class="text-3xl md:text-4xl font-extrabold text-on-surface tracking-tight font-sans">Ready to go beyond paper?</h2>
          <p class="text-on-surface-variant text-base max-w-lg font-sans">
            Join 10,000+ top shelf professionals who upgraded their career narrative with interactive showcases.
          </p>
          <button 
            @click="emit('navigate', 'register')" 
            class="bg-primary hover:bg-primary/95 text-white font-bold text-base px-10 py-4 rounded-full shadow-lg shadow-primary/20 transition-all active:scale-[0.98]"
          >
            Start Your Canvas Now
          </button>
        </div>
      </div>

    </div>
  </section>
</template>
