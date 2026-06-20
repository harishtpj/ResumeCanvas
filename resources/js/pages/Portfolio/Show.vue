<script setup>
import { computed, ref, onMounted } from 'vue';
import { html as beautifyHtml } from 'js-beautify';
import Prism from 'prismjs';
import 'prismjs/themes/prism-tomorrow.css';
import 'prismjs/plugins/line-numbers/prism-line-numbers.js';
import 'prismjs/plugins/line-numbers/prism-line-numbers.css';
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
  Trash2,
  Clock3,
  RotateCw,
  Share2,
  Link2,
  Unlink,
  SquareArrowOutUpRight,
  ChevronDown,
  ChevronLeft
} from '@lucide/vue';
import { Head, Link, router, usePage } from "@inertiajs/vue3";
import pfController from "@/routes/portfolio/index";
import { dashboard, view } from "@/routes/index";

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
const showSharing = ref(false);

const user = computed(() => page.props.auth.user);
const generateTemplateCode = computed(() => props.portfolio.content);

const formattedCode = computed(() => {
  return beautifyHtml(props.portfolio.content || "", {
    indent_size: 2,
    wrap_line_length: 0,
    preserve_newlines: true
  });
});

onMounted(() => Prism.highlightAll());
const highlightCode = () => nextTick(() => Prism.highlightAll());

function handleCopyCode() {
  navigator.clipboard.writeText(formattedCode.value);
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
  const blob = new Blob([formattedCode.value], { type: 'text/html' });
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

function maketoggleSharingReq() {
  router.patch(pfController.share(props.portfolio.id), {}, { async: true });
}

function toggleSharing() {
  if (!props.portfolio.shared)
    maketoggleSharingReq()
  showSharing.value = !showSharing.value;
}

function getSharedURL() {
  return window.location.origin + view(props.portfolio.id).url;
}

function copyShareLink() {
  navigator.clipboard.writeText(getSharedURL());
  router.flash('toast', {
    type: 'success',
    text: 'Public share link copied to clipboard!'
  });
}
</script>

<template>

  <Head :title="portfolio.title" />
  <section class="pb-20 w-full min-h-screen">
    <div class="max-w-[1280px] mx-auto px-4 md:px-8 flex flex-col gap-6">

      <div
        class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 border-b border-slate-100 pb-5 text-left">
        <div class="flex items-center gap-3">
          <Link :href="pfController.index()" as="button"
            class="w-10 h-10 rounded-full border border-outline-variant/40 hover:bg-slate-50 flex items-center justify-center text-on-surface transition-colors cursor-pointer"
            title="Go back">
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

        <div class="flex flex-wrap items-center gap-2 font-sans">
          <button
            class="flex items-center gap-1.5 px-4 py-2.5 bg-primary hover:bg-primary/95 text-white font-bold text-xs rounded-xl shadow-md shadow-primary/15 transition-all select-none"
            @click="handleDownloadCode">
            <Download class="w-4 h-4" />
            <span>Download HTML Code</span>
          </button>
          <Link :href="pfController.update(portfolio.id)" as="button"
            class="flex items-center gap-1.5 px-4 py-2.5 border border-blue-200 hover:bg-blue-50 text-blue-600 font-bold text-xs rounded-xl transition-all select-none">
            <RotateCw class="w-4 h-4" />
            <span>Regenerate Portfolio</span>
          </Link>
          <Link :href="pfController.destroy(portfolio.id)" as="button"
            class="flex items-center gap-1.5 px-4 py-2.5 border border-red-200 hover:bg-red-50 text-red-600 font-bold text-xs rounded-xl transition-all select-none">
            <Trash2 class="w-4 h-4" />
            <span>Delete Canvas</span>
          </Link>
        </div>
      </div>

      <div class="flex flex-col gap-8 text-left">

        <div class="glass-card rounded-3xl p-5 border border-outline-variant/30">
          <div class="flex flex-col lg:flex-row lg:items-center gap-5">

            <div class="flex items-center gap-3">
              <div class="w-10 h-10 rounded-2xl bg-secondary/10 text-secondary flex items-center justify-center">
                <Clock3 class="w-5 h-5" />
              </div>
              <div>
                <p class="text-[11px] uppercase tracking-wider font-bold text-on-surface-variant">Last Updated</p>
                <p class="font-medium text-sm text-on-surface">{{ portfolio.last_updated }}</p>
              </div>
            </div>

            <div class="flex-1"></div>

            <div class="flex items-center gap-2">

              <div class="relative">
                <button @click="toggleSharing"
                  class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs font-bold transition-all border border-slate-200 hover:bg-slate-50 text-on-surface-variant">
                  <Share2 class="w-4 h-4" />
                  {{ !portfolio.shared ? "Enable Sharing" : "Sharing Options" }}
                  <ChevronDown v-if="portfolio.shared" class="w-4 h-4 transition-transform duration-300 ease-in-out"
                    :class="{ 'rotate-180': showSharing }" />
                </button>

                <div v-if="portfolio.shared && showSharing"
                  class="absolute top-full right-0 mt-2 w-48 bg-white rounded-2xl shadow-xl border border-slate-100 p-2 z-10 animate-in fade-in zoom-in duration-200">
                  <button @click="copyShareLink"
                    class="w-full flex items-center gap-3 px-3 py-2 text-xs font-medium hover:bg-slate-50 rounded-lg text-on-surface">
                    <Link2 class="w-4 h-4" /> Copy Link
                  </button>
                  <a :href="getSharedURL()" target="_blank"
                    class="w-full flex items-center gap-3 px-3 py-2 text-xs font-medium hover:bg-slate-50 rounded-lg text-on-surface">
                    <SquareArrowOutUpRight class="w-4 h-4" /> View Public Site
                  </a>
                  <button @click="maketoggleSharingReq"
                    class="w-full flex items-center gap-3 px-3 py-2 text-xs font-medium hover:bg-slate-50 rounded-lg text-on-surface">
                    <Unlink class="w-4 h-4" /> Disable Sharing
                  </button>
                </div>
              </div>

              <div class="flex bg-slate-100 p-1 rounded-xl">
                <button
                  :class="currentTab === 'preview' ? 'bg-white shadow-sm text-primary' : 'text-on-surface-variant hover:text-on-surface'"
                  class="px-5 py-2 rounded-lg text-xs font-bold transition-all" @click="currentTab = 'preview'">Live
                  Preview</button>
                <button
                  :class="currentTab === 'code' ? 'bg-white shadow-sm text-primary' : 'text-on-surface-variant hover:text-on-surface'"
                  class="px-5 py-2 rounded-lg text-xs font-bold transition-all" @click="currentTab = 'code'">HTML
                  Source</button>
              </div>

            </div>
          </div>
        </div>

        <div class="flex-1">

          <div v-show="currentTab === 'preview'" class="flex flex-col gap-3 h-[600px]">
            <div class="bg-slate-100 p-2 rounded-2xl flex items-center justify-between font-sans">
              <div class="flex items-center gap-1.5 font-bold text-xs text-on-surface-variant pl-3">
                <SquareMousePointer class="w-4 h-4 text-primary" />
                <span>Responsive Viewport Simulation</span>
              </div>
              <div class="flex gap-1">
                <button
                  :class="previewViewport === 'desktop' ? 'bg-white text-primary shadow-sm' : 'text-on-surface-variant hover:text-on-surface'"
                  class="p-1.5 rounded-lg transition-colors" @click="previewViewport = 'desktop'">
                  <Monitor class="w-4.5 h-4.5" />
                </button>
                <button
                  :class="previewViewport === 'mobile' ? 'bg-white text-primary shadow-sm' : 'text-on-surface-variant hover:text-on-surface'"
                  class="p-1.5 rounded-lg transition-colors" @click="previewViewport = 'mobile'">
                  <Smartphone class="w-4.5 h-4.5" />
                </button>
              </div>
            </div>

            <div
              class="flex-1 w-full bg-slate-50 border border-outline-variant/30 rounded-3xl p-4 overflow-hidden relative">
              <div
                :class="previewViewport === 'mobile' ? 'max-w-[360px] h-full border-[8px] border-slate-850 rounded-[32px] ring-2 ring-slate-800' : 'w-full h-full'"
                class="transition-all duration-300 relative shadow-md rounded-xl bg-white mx-auto overflow-hidden">
                <iframe :srcdoc="generateTemplateCode" class="w-full h-full border-none block"
                  sandbox="allow-scripts"></iframe>
              </div>
            </div>
          </div>

          <div v-show="currentTab === 'code'" class="flex flex-col gap-3">
            <div class="bg-slate-900 text-slate-300 rounded-3xl overflow-hidden border border-slate-800 flex flex-col">
              <div class="bg-slate-950 px-5 py-3.5 border-b border-slate-850 flex justify-between items-center">
                <div class="flex items-center gap-2 text-xs font-semibold font-sans">
                  <FileCode class="w-4 h-4 text-primary" />
                  <span>{{ user.initials + '_' + portfolio.title.toLowerCase().replace(/\s+/g, '_')
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
              <div v-show="currentTab === 'code'" class="flex-1 flex flex-col gap-3">
                <div
                  class="bg-slate-900 text-slate-300 rounded-3xl overflow-hidden border border-slate-800 flex flex-col">
                  <div class="p-6 overflow-auto max-h-[520px]">
                    <pre class="line-numbers language-html"><code>{{ formattedCode }}</code></pre>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>
</template>