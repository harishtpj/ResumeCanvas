<script setup>
import { computed, ref } from 'vue';
import {
  ArrowLeft,
  Check,
  Copy,
  Download,
  FileCode,
  LayoutDashboard,
  Monitor,
  Smartphone,
  Sparkle,
  SquareMousePointer,
  Trash2
} from '@lucide/vue';
import { Link, router, usePage } from "@inertiajs/vue3";
import pfController from "@/routes/portfolio/index";
import { dashboard } from "@/routes/index";

const page = usePage();
const props = defineProps({
  portfolio: {
    type: Object,
    required: true
  }
});

const currentTab = ref('preview'); // 'preview' | 'code'
const previewViewport = ref('desktop'); // 'desktop' | 'mobile'
const isCopied = ref(false);

const user = computed(() => page.props.auth.user);
const generateTemplateCode = computed(() => props.portfolio.content);

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
  const blob = new Blob([generateTemplateCode.value], { type: 'text/html' });
  const url = URL.createObjectURL(blob);
  const a = document.createElement('a');
  a.href = url;
  a.download = `${user.value.initials}_${props.portfolio.title.toLowerCase().replace(/\s+/g, '_')}_portfolio.html`;
  document.body.appendChild(a);
  a.click();
  document.body.removeChild(a);
  URL.revokeObjectURL(url);
  router.flash('toast', {
    type: 'success',
    text: 'Portfolio HTML template downloaded successfully!'
  });
}
</script>

<template>
  <section class="pt-28 pb-20 w-full min-h-screen">
    <div class="max-w-[1280px] mx-auto px-4 md:px-8 flex flex-col gap-6">

      <!-- Navigation Header Row -->
      <div
        class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 border-b border-slate-100 pb-5 text-left">
        <div class="flex items-center gap-3">
          <Link :href="dashboard()" as="button"
            class="w-10 h-10 rounded-full border border-outline-variant/40 hover:bg-slate-50 flex items-center justify-center text-on-surface transition-colors cursor-pointer"
            title="Back to Dashboard">
            <ArrowLeft class="w-5 h-5" />
          </Link>
          <div>
            <span
              class="inline-flex items-center gap-1 bg-primary/10 text-primary font-bold text-[10px] uppercase tracking-wider px-2 py-0.5 rounded">
              <Sparkle class="w-3 h-3" />
              Preview Template
            </span>
            <h1 class="text-2xl font-extrabold text-on-surface mt-0.5 font-sans">{{ portfolio.title }}</h1>
          </div>
        </div>

        <!-- Call to actions toolbar -->
        <div class="flex flex-wrap items-center gap-2 font-sans">

          <button
            class="flex items-center gap-1.5 px-4 py-2.5 bg-primary hover:bg-primary/95 text-white font-bold text-xs rounded-xl shadow-md shadow-primary/15 transition-all select-none"
            @click="handleDownloadCode">
            <Download class="w-4 h-4" />
            <span>Download HTML Code</span>
          </button>

          <Link :href="pfController.destroy(portfolio.id)" as="button"
            class="flex items-center gap-1.5 px-4 py-2.5 border border-red-200 hover:bg-red-50 text-red-600 font-bold text-xs rounded-xl transition-all select-none">
            <Trash2 class="w-4 h-4" />
            <span>Delete Canvas</span>
          </Link>

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
                <span class="font-medium text-slate-800">{{ portfolio.last_updated }}</span>
              </div>
            </div>

            <!-- Tab Switcher (Interactive Live Frame Preview vs HTML Code Source) -->
            <div class="flex bg-slate-100 p-1 rounded-xl">
              <button
                :class="currentTab === 'preview' ? 'bg-white shadow-sm text-primary' : 'text-on-surface-variant hover:text-on-surface'"
                class="flex-1 py-2 rounded-lg text-xs font-bold transition-all text-center"
                @click="currentTab = 'preview'">
                Live Preview
              </button>
              <button
                :class="currentTab === 'code' ? 'bg-white shadow-sm text-primary' : 'text-on-surface-variant hover:text-on-surface'"
                class="flex-1 py-2 rounded-lg text-xs font-bold transition-all text-center"
                @click="currentTab = 'code'">
                HTML Code Source
              </button>
            </div>
          </div>
        </div>

        <div class="lg:col-span-8 flex flex-col gap-4">

          <div v-show="currentTab === 'preview'" class="flex-1 flex flex-col gap-3 min-h-[500px]">
            <!-- Viewport toggle header -->
            <div class="bg-slate-100 p-2 rounded-2xl flex items-center justify-between font-sans">
              <div class="flex items-center gap-1.5 font-bold text-xs text-on-surface-variant pl-3">
                <SquareMousePointer class="w-4 h-4 text-primary" />
                <span>Responsive Viewport Simulation</span>
              </div>
              <div class="flex gap-1">
                <button
                  :class="previewViewport === 'desktop' ? 'bg-white text-primary shadow-sm' : 'text-on-surface-variant hover:text-on-surface'"
                  class="p-1.5 rounded-lg transition-colors" title="Widescreen Preview"
                  @click="previewViewport = 'desktop'">
                  <Monitor class="w-4.5 h-4.5" />
                </button>
                <button
                  :class="previewViewport === 'mobile' ? 'bg-white text-primary shadow-sm' : 'text-on-surface-variant hover:text-on-surface'"
                  class="p-1.5 rounded-lg transition-colors" title="Smartphone Preview"
                  @click="previewViewport = 'mobile'">
                  <Smartphone class="w-4.5 h-4.5" />
                </button>
              </div>
            </div>

            <div
              class="flex-1 flex justify-center items-center bg-slate-50 border border-outline-variant/30 rounded-3xl p-4 overflow-hidden relative min-h-[500px]">
              <div
                :class="previewViewport === 'mobile' ? 'max-w-[360px] h-[550px] border-[8px] border-slate-850 rounded-[32px] ring-2 ring-slate-800' : 'h-[600px]'"
                class="w-full h-full transition-all duration-300 relative shadow-md overflow-hidden rounded-xl bg-white">
                <iframe :srcdoc="generateTemplateCode" class="w-full h-full border-none"
                  sandbox="allow-scripts"></iframe>
              </div>
            </div>
          </div>

          <!-- View tab: CODE SOURCE -->
          <div v-show="currentTab === 'code'" class="flex-1 flex flex-col gap-3">
            <div class="bg-slate-900 text-slate-300 rounded-3xl overflow-hidden border border-slate-800 flex flex-col">
              <div class="bg-slate-950 px-5 py-3.5 border-b border-slate-850 flex justify-between items-center">
                <div class="flex items-center gap-2 text-xs font-semibold font-sans">
                  <FileCode class="w-4 h-4 text-primary" />
                  <span>{{ user.initials + '_' +
                    portfolio.title.toLowerCase().replace(/\s+/g, '_')
                  }}_portfolio.html</span>
                </div>
                <button
                  class="flex items-center gap-1.5 text-xs text-slate-400 hover:text-white px-3 py-1.5 bg-slate-850 hover:bg-slate-800 rounded-lg transition-all font-sans font-bold"
                  @click="handleCopyCode">
                  <Check v-if="isCopied" class="w-3.5 h-3.5 text-emerald-500" />
                  <Copy v-else class="w-3.5 h-3.5" />
                  <span>{{ isCopied ? 'Copied!' : 'Copy Code' }}</span>
                </button>
              </div>

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
