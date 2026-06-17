<script setup>
import {computed, ref} from 'vue';
import {
    ArrowLeft,
    Check,
    Chrome,
    Copy,
    Download,
    FileCode,
    Monitor,
    Smartphone,
    Sparkle,
    Trash2
} from '@lucide/vue';
import {router} from "@inertiajs/vue3";

const props = defineProps({
    portfolio: {
        type: Object,
        required: true
    }
});

const emit = defineEmits(['back', 'delete', 'download', 'alert']);

const currentTab = ref('preview'); // 'preview' | 'code'
const previewViewport = ref('desktop'); // 'desktop' | 'mobile'
const isCopied = ref(false);

const generateTemplateCode = computed(() => {
    const isDev = props.portfolio.title.toLowerCase().includes('manager') || props.portfolio.title.toLowerCase().includes('engineer') || props.portfolio.tags.includes('AI-Imported');

    if (props.portfolio.title.toLowerCase().includes('designer') || props.portfolio.tags.includes('Design')) {
        // Modern Glassmorphism Accent style
        return `<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>${props.portfolio.title} | Personal Canvas</title>
  <script src="https://cdn.tailwindcss.com"><\/script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap');
    body {
      font-family: 'Outfit', sans-serif;
      background: linear-gradient(135deg, #f8f9ff 0%, #eff6ff 100%);
      color: #0f172a;
    }
    .glass-card {
      background: rgba(255, 255, 255, 0.7);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      border: 1px solid rgba(255, 255, 255, 0.5);
    }
    .profile-glow {
      box-shadow: 0 10px 40px rgba(59, 130, 246, 0.15);
    }
  </style>
</head>
<body class="min-h-screen py-12 px-4 md:px-8">
  <div class="max-w-3xl mx-auto space-y-8">

    <!-- Header Hero Profile -->
    <header class="glass-card rounded-[32px] p-8 md:p-10 text-center flex flex-col items-center gap-4 profile-glow">
      <div class="w-20 h-20 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 text-3xl font-extrabold shadow-sm">
        ${props.portfolio.title.slice(0, 2).toUpperCase()}
      </div>
      <div>
        <h1 class="text-3xl font-extrabold tracking-tight">${props.portfolio.title}</h1>
        <p class="text-blue-600 font-semibold text-sm mt-1">Live AI Score: ${props.portfolio.score}% Match Rate</p>
      </div>
      <div class="flex flex-wrap gap-2 justify-center mt-2">
        ${props.portfolio.tags.map(t => `<span class="bg-blue-50 text-blue-800 text-xs px-3 py-1 rounded-full font-medium border border-blue-100">${t}</span>`).join('')}
      </div>
    </header>

    <!-- Bio & Impact -->
    <section class="glass-card rounded-[24px] p-6 md:p-8 space-y-4">
      <h2 class="text-lg font-extrabold text-slate-800 border-l-4 border-blue-600 pl-3">Professional Blueprint</h2>
      <p class="text-slate-600 text-sm leading-relaxed">
        Passionate professional recognized for steering digital evolution and layout consistency. Specialized in translating high-level business objectives into high-performing interactive experiences.
      </p>
    </section>

    <!-- Experience Timeline -->
    <section class="glass-card rounded-[24px] p-6 md:p-8 space-y-6">
      <h2 class="text-lg font-extrabold text-slate-800 border-l-4 border-blue-600 pl-3">Impact Timeline</h2>
      <div class="border-l-2 border-blue-100 pl-6 ml-3 space-y-6 relative">
        <div class="relative">
          <div class="absolute -left-[31px] top-1.5 w-4 h-4 bg-blue-600 rounded-full border-4 border-white shadow-sm"></div>
          <p class="text-xs font-bold text-blue-600">2024 - PRESENT</p>
          <h3 class="font-extrabold text-sm text-slate-800 mt-0.5">Lead Architect & Senior Operator</h3>
          <p class="text-slate-500 text-xs">Dynamic high-stakes enterprise projects</p>
        </div>
        <div class="relative">
          <div class="absolute -left-[31px] top-1.5 w-4 h-4 bg-slate-400 rounded-full border-4 border-white shadow-sm"></div>
          <p class="text-xs font-bold text-slate-400">2021 - 2024</p>
          <h3 class="font-extrabold text-sm text-slate-800 mt-0.5">UX Designer & Systems Consultant</h3>
          <p class="text-slate-500 text-xs">Pioneered glassmorphic design system rollouts</p>
        </div>
      </div>
    </section>

    <!-- Project Gallery mock -->
    <section class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div class="glass-card rounded-[24px] p-6 flex flex-col gap-3">
        <span class="text-xs font-bold text-blue-600 uppercase">Core Case Study</span>
        <h3 class="font-extrabold text-base text-slate-800">Dynamic Conversion Engine</h3>
        <p class="text-slate-500 text-xs leading-relaxed">Boosted customer retention metrics by over 42% utilizing lightweight client-side components.</p>
      </div>
      <div class="glass-card rounded-[24px] p-6 flex flex-col gap-3">
        <span class="text-xs font-bold text-emerald-600 uppercase">Interactive System</span>
        <h3 class="font-extrabold text-base text-slate-800">Recruiter Canvas UI</h3>
        <p class="text-slate-500 text-xs leading-relaxed">Engineered bespoke analytics dashboards mapping precise conversion pipelines and layout loads.</p>
      </div>
    </section>

    <!-- Footer contact -->
    <footer class="text-center text-xs text-slate-400 font-medium pt-8">
      Generated automatically by ResumeCanvas AI Studio
    </footer>

  </div>
</body>
</html>`;
    } else {
        // Monospace & Terminal Clean Accent Style
        return `<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>${props.portfolio.title} | Tech Portfolio</title>
  <script src="https://cdn.tailwindcss.com"><\/script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;600;700&display=swap');
    body {
      font-family: 'Fira Code', monospace;
      background-color: #0f172a;
      color: #e2e8f0;
    }
    .terminal-border {
      border: 1px solid #334155;
    }
  </style>
</head>
<body class="p-6 md:p-12 min-h-screen flex items-center justify-center">
  <div class="max-w-3xl w-full bg-slate-900 border border-slate-700/60 rounded-xl overflow-hidden shadow-2xl">

    <!-- Top toolbar header -->
    <div class="bg-slate-850 px-4 py-2 border-b border-slate-700/60 flex items-center justify-between">
      <div class="flex items-center gap-1.5">
        <span class="w-3 h-3 rounded-full bg-red-500"></span>
        <span class="w-3 h-3 rounded-full bg-amber-500"></span>
        <span class="w-3 h-3 rounded-full bg-emerald-500"></span>
      </div>
      <span class="text-[10px] text-slate-500 font-semibold uppercase">guest@resume-canvas-terminal: ~</span>
      <div></div>
    </div>

    <div class="p-6 md:p-8 space-y-6">

      <!-- Shell output -->
      <div>
        <p class="text-blue-400 text-xs">&gt; finger user --profile</p>
        <h1 class="text-2xl font-bold text-white mt-1">${props.portfolio.title}</h1>
        <p class="text-xs text-emerald-400 mt-0.5">// AI Compatibility Score: ${props.portfolio.score}/100 Match Rate</p>
        <div class="flex flex-wrap gap-2 mt-3">
          ${props.portfolio.tags.map(t => `<span class="bg-slate-850 text-slate-300 text-[10px] px-2 py-0.5 border border-slate-700 rounded">${t}</span>`).join('')}
        </div>
      </div>

      <!-- Execution log -->
      <div>
        <p class="text-blue-400 text-xs">&gt; query --active-role-summary</p>
        <p class="text-xs text-slate-400 mt-1 leading-relaxed">
          Robust engineer specializing in distributed applications, real-time sync systems, and optimized pipeline automation. Committed to writing clean, maintainable code architectures that yield reliable business intelligence.
        </p>
      </div>

      <!-- Project list -->
      <div>
        <p class="text-blue-400 text-xs">&gt; cat projects.json</p>
        <div class="mt-2 space-y-3 pl-3 border-l-2 border-slate-700 text-xs">
          <div>
            <p class="text-amber-400 font-semibold">[0] High-Throughput Stream API</p>
            <p class="text-slate-400">Scaled event streams parsing 1M+ credentials daily with strict type checking structures.</p>
          </div>
          <div>
            <p class="text-amber-400 font-semibold">[1] Automated Parser Orchestrator</p>
            <p class="text-slate-400">Integrated microservices parser models syncing static files to interactive responsive layout nodes.</p>
          </div>
        </div>
      </div>

      <!-- Footer check -->
      <div class="text-slate-600 text-[10px] text-center pt-4 border-t border-slate-800">
        // Press any key to contact. Secure digital handshake compiled successfully.
      </div>

    </div>
  </div>
</body>
</html>`;
    }
});

function handleCopyCode() {
    navigator.clipboard.writeText(generateTemplateCode.value);
    isCopied.value = true;
    router.flash('toast', {
        type: 'success',
        text: 'Template source code copied to clipboard!'
    })
    setTimeout(() => {
        isCopied.value = false;
    }, 2000);
}

function handleDownloadCode() {
    const blob = new Blob([generateTemplateCode.value], {type: 'text/html'});
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = `${props.portfolio.title.toLowerCase().replace(/\s+/g, '-')}-portfolio.html`;
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);
    emit('alert', 'Portfolio HTML template downloaded successfully!', 'success');
}
</script>

<template>
    <section class="pt-28 pb-20 w-full min-h-screen">
        <div class="max-w-[1280px] mx-auto px-4 md:px-8 flex flex-col gap-6">

            <!-- Navigation Header Row -->
            <div
                class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 border-b border-slate-100 pb-5 text-left">
                <div class="flex items-center gap-3">
                    <button
                        class="w-10 h-10 rounded-full border border-outline-variant/40 hover:bg-slate-50 flex items-center justify-center text-on-surface transition-colors cursor-pointer"
                        title="Back to Dashboard"
                        @click="emit('back')"
                    >
                        <ArrowLeft class="w-5 h-5"/>
                    </button>
                    <div>
            <span
                class="inline-flex items-center gap-1 bg-primary/10 text-primary font-bold text-[10px] uppercase tracking-wider px-2 py-0.5 rounded">
              <Sparkle class="w-3 h-3"/>
              Preview Template
            </span>
                        <h1 class="text-2xl font-extrabold text-on-surface mt-0.5 font-sans">{{ portfolio.title }}</h1>
                    </div>
                </div>

                <!-- Call to actions toolbar -->
                <div class="flex flex-wrap items-center gap-2 font-sans">

                    <button
                        class="flex items-center gap-1.5 px-4 py-2.5 bg-primary hover:bg-primary/95 text-white font-bold text-xs rounded-xl shadow-md shadow-primary/15 transition-all select-none"
                        @click="handleDownloadCode"
                    >
                        <Download class="w-4 h-4"/>
                        <span>Download HTML Code</span>
                    </button>

                    <button
                        class="flex items-center gap-1.5 px-4 py-2.5 border border-red-200 hover:bg-red-50 text-red-600 font-bold text-xs rounded-xl transition-all select-none"
                        @click="emit('delete', portfolio.id)"
                    >
                        <Trash2 class="w-4 h-4"/>
                        <span>Delete Canvas</span>
                    </button>

                </div>
            </div>

            <!-- Main Layout Panels (Split Preview vs Code viewer tabs) -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 text-left">

                <!-- Left configuration & quick summary panel -->
                <div class="lg:col-span-4 flex flex-col gap-6">
                    <div class="glass-card rounded-3xl p-6 border border-outline-variant/30 flex flex-col gap-5">
                        <h3 class="font-extrabold text-base text-on-surface font-sans">Template Configuration</h3>

                        <div class="space-y-4 text-xs font-sans">
                            <div class="flex justify-between items-center py-2 border-b border-slate-100">
                                <span class="text-on-surface-variant font-medium">Status</span>
                                <span class="font-bold text-primary">{{ portfolio.status }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-slate-100">
                                <span class="text-on-surface-variant font-medium">Last Synchronized</span>
                                <span class="font-medium text-slate-800">{{ portfolio.lastUpdated }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-slate-100">
                                <span class="text-on-surface-variant font-medium">Core AI Score</span>
                                <span class="font-extrabold text-emerald-600">{{ portfolio.score }}% Optimized</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-slate-100">
                                <span class="text-on-surface-variant font-medium">Interactive Visits</span>
                                <span class="font-semibold text-slate-800">{{ portfolio.views }} recruiter hits</span>
                            </div>
                        </div>

                        <!-- Tab Switcher (Interactive Live Frame Preview vs HTML Code Source) -->
                        <div class="flex bg-slate-100 p-1 rounded-xl">
                            <button
                                :class="currentTab === 'preview' ? 'bg-white shadow-sm text-primary' : 'text-on-surface-variant hover:text-on-surface'"
                                class="flex-1 py-2 rounded-lg text-xs font-bold transition-all text-center"
                                @click="currentTab = 'preview'"
                            >
                                Live Preview
                            </button>
                            <button
                                :class="currentTab === 'code' ? 'bg-white shadow-sm text-primary' : 'text-on-surface-variant hover:text-on-surface'"
                                class="flex-1 py-2 rounded-lg text-xs font-bold transition-all text-center"
                                @click="currentTab = 'code'"
                            >
                                HTML Code Source
                            </button>
                        </div>

                        <!-- Quick copy block helper for Laravel users -->
                        <div class="bg-indigo-50/50 p-4 rounded-2xl border border-indigo-100 flex flex-col gap-2">
                            <span class="text-[10px] text-primary uppercase font-bold tracking-wider">Laravel Integration Tip</span>
                            <p class="text-[11px] text-on-surface-variant leading-relaxed">
                                You can drop this generated HTML code directly into your Laravel Blade file (e.g. <code
                                class="bg-indigo-100/60 text-primary px-1 rounded">portfolio.blade.php</code>) inside
                                your centralized layout file dynamically.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Right Side Frame or Code View panel -->
                <div class="lg:col-span-8 flex flex-col gap-4">

                    <!-- View tab: PREVIEW -->
                    <div v-show="currentTab === 'preview'" class="flex-1 flex flex-col gap-3 min-h-[500px]">
                        <!-- Viewport toggle header -->
                        <div class="bg-slate-100 p-2 rounded-2xl flex items-center justify-between font-sans">
                            <div class="flex items-center gap-1.5 font-bold text-xs text-on-surface-variant pl-3">
                                <Chrome class="w-4 h-4 text-primary"/>
                                <span>Responsive Viewport Simulation</span>
                            </div>
                            <div class="flex gap-1">
                                <button
                                    :class="previewViewport === 'desktop' ? 'bg-white text-primary shadow-sm' : 'text-on-surface-variant hover:text-on-surface'"
                                    class="p-1.5 rounded-lg transition-colors"
                                    title="Widescreen Preview"
                                    @click="previewViewport = 'desktop'"
                                >
                                    <Monitor class="w-4.5 h-4.5"/>
                                </button>
                                <button
                                    :class="previewViewport === 'mobile' ? 'bg-white text-primary shadow-sm' : 'text-on-surface-variant hover:text-on-surface'"
                                    class="p-1.5 rounded-lg transition-colors"
                                    title="Smartphone Preview"
                                    @click="previewViewport = 'mobile'"
                                >
                                    <Smartphone class="w-4.5 h-4.5"/>
                                </button>
                            </div>
                        </div>

                        <!-- Virtual iframe wrapper with flexible viewport sizes -->
                        <div
                            class="flex-1 flex justify-center items-center bg-slate-50 border border-outline-variant/30 rounded-3xl p-4 overflow-hidden relative min-h-[500px]">
                            <div
                                :class="previewViewport === 'mobile' ? 'max-w-[360px] h-[550px] border-[8px] border-slate-850 rounded-[32px] ring-2 ring-slate-800' : 'h-[600px]'"
                                class="w-full h-full transition-all duration-300 relative shadow-md overflow-hidden rounded-xl bg-white"
                            >
                                <!-- Centralized Virtual Database IFrame -->
                                <iframe
                                    :srcdoc="generateTemplateCode"
                                    class="w-full h-full border-none"
                                    sandbox="allow-scripts"
                                ></iframe>
                            </div>
                        </div>
                    </div>

                    <!-- View tab: CODE SOURCE -->
                    <div v-show="currentTab === 'code'" class="flex-1 flex flex-col gap-3">
                        <div
                            class="bg-slate-900 text-slate-300 rounded-3xl overflow-hidden border border-slate-800 flex flex-col">
                            <div
                                class="bg-slate-950 px-5 py-3.5 border-b border-slate-850 flex justify-between items-center">
                                <div class="flex items-center gap-2 text-xs font-semibold font-sans">
                                    <FileCode class="w-4 h-4 text-primary"/>
                                    <span>{{
                                            portfolio.title.toLowerCase().replace(/\s+/g, '-')
                                        }}-portfolio.blade.php</span>
                                </div>
                                <button
                                    class="flex items-center gap-1.5 text-xs text-slate-400 hover:text-white px-3 py-1.5 bg-slate-850 hover:bg-slate-800 rounded-lg transition-all font-sans font-bold"
                                    @click="handleCopyCode"
                                >
                                    <Check v-if="isCopied" class="w-3.5 h-3.5 text-emerald-500"/>
                                    <Copy v-else class="w-3.5 h-3.5"/>
                                    <span>{{ isCopied ? 'Copied!' : 'Copy Code' }}</span>
                                </button>
                            </div>

                            <!-- Inline Code Codeblock scroll view area -->
                            <pre
                                class="p-6 overflow-auto max-h-[520px] text-xs font-mono leading-relaxed text-left select-all bg-slate-900/90 text-indigo-200"><code>{{
                                    generateTemplateCode
                                }}</code></pre>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </section>
</template>

