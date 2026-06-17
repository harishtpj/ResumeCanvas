<script setup>
import {ref} from 'vue';
import {ArrowLeft, CheckCircle2, ChevronRight, CloudUpload, FileText, Palette} from '@lucide/vue';
import {dashboard} from "@/routes/index.ts";
import {Link, router, useForm} from "@inertiajs/vue3";
import portfolio from "@/routes/portfolio/index.ts";

const form = useForm({
    title: '',
    kind: 'modern', // 'modern' | 'developer' | 'corporate'
    file: null
});

const fileInput = ref(null);
const isDragging = ref(false);

const kinds = [
    {
        id: 'modern',
        name: 'Modern Accent',
        desc: 'High contrast display typography, generous white space & glassmorphic details. Ideal for designers & modern startups.',
        icon: Palette,
        badgeColor: 'bg-indigo-100 text-indigo-800'
    },
    {
        id: 'developer',
        name: 'Developer Terminal',
        desc: 'Clean layouts with monospace accents, dark mode contrasts & code-friendly project syntax. Perfect for engineers.',
        icon: FileText,
        badgeColor: 'bg-emerald-100 text-emerald-800'
    },
    {
        id: 'corporate',
        name: 'Corporate Executive',
        desc: 'Prestigious serif styles, ultra-clean grids & deep navy accents. Best for executives, consultants & finance leaders.',
        icon: CheckCircle2,
        badgeColor: 'bg-sky-100 text-sky-800'
    }
];

function triggerFileSelect() {
    fileInput.value?.click();
}

function handleFileChange(e) {
    const file = e.target.files?.[0];
    if (file) {
        form.file = file;
        router.flash('toast', {
            type: 'success',
            text: `File "${file.name}" loaded successfully.`
        });
    }
}

function handleDragOver(e) {
    e.preventDefault();
    isDragging.value = true;
}

function handleDragLeave() {
    isDragging.value = false;
}

function handleDrop(e) {
    e.preventDefault();
    isDragging.value = false;
    const file = e.dataTransfer?.files?.[0];
    if (file) {
        form.file = file;
        router.flash('toast', {
            type: 'success',
            text: `File "${file.name}" loaded successfully.`
        });
    }
}

function handleConfirm() {
    form.title = form.title.trim();
    form.submit(portfolio.store())
}
</script>

<template>
    <section class="pt-32 pb-24 px-4 w-full flex items-center justify-center min-h-screen">
        <div class="w-full max-w-3xl mx-auto flex flex-col gap-6 text-left">

            <!-- Back Header button -->
            <Link :href="dashboard()" as="button"
                  class="flex items-center gap-2 text-sm font-bold text-on-surface-variant hover:text-primary transition-colors cursor-pointer w-fit self-start mb-2 font-sans"
            >
                <ArrowLeft class="w-4 h-4"/>
                Back to My Dashboard
            </Link>

            <div
                class="glass-card rounded-[32px] p-6 md:p-10 shadow-xl border border-white/45 relative overflow-hidden">

                <!-- Header Info -->
                <div class="mb-8 border-b border-slate-100 pb-6">
                    <h1 class="text-3xl font-extrabold text-on-surface mb-2 font-sans tracking-tight">Create Living
                        Portfolio</h1>
                    <p class="text-on-surface-variant text-sm">Convert your professional credentials into a bespoke
                        interactive showcase.</p>
                </div>

                <div class="space-y-6">

                    <!-- Title Input -->
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-on-surface uppercase tracking-wider block ml-1"
                               for="port-title">Portfolio Title</label>
                        <input
                            id="port-title"
                            v-model="form.title"
                            class="w-full px-5 py-4 bg-surface-container-low border border-transparent rounded-2xl focus:ring-2 focus:ring-primary/25 focus:border-primary/50 focus:bg-white transition-all text-sm outline-none text-on-surface font-sans font-medium"
                            placeholder="e.g. Senior Product Designer, Cloud Architect"
                            required
                            type="text"
                        />
                    </div>

                    <!-- Kind Selection Grid (Modern, Developer, Corporate) -->
                    <div class="space-y-3">
                        <label class="text-xs font-bold text-on-surface uppercase tracking-wider block ml-1">Select
                            Portfolio Style Kind</label>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 font-sans">

                            <div
                                v-for="kind in kinds"
                                :key="kind.id"
                                :class="form.kind === kind.id
                  ? 'border-primary bg-primary/4 ring-1 ring-primary'
                  : 'border-outline-variant/50 hover:border-primary/40 hover:bg-slate-50/50'"
                                class="border rounded-2xl p-5 cursor-pointer flex flex-col gap-3 transition-all relative overflow-hidden"
                                @click="form.kind = kind.id"
                            >
                                <!-- Active dot -->
                                <div
                                    :class="form.kind === kind.id ? 'border-primary bg-primary' : 'border-outline-variant'"
                                    class="absolute top-4 right-4 w-4 h-4 rounded-full border flex items-center justify-center"
                                >
                                    <div v-if="form.kind === kind.id"
                                         class="w-1.5 h-1.5 rounded-full bg-white"></div>
                                </div>

                                <div :class="kind.badgeColor"
                                     class="w-9 h-9 rounded-xl flex items-center justify-center p-2">
                                    <component :is="kind.icon" class="w-5 h-5"/>
                                </div>

                                <div>
                                    <h4 class="font-bold text-sm text-on-surface font-sans mb-1">{{ kind.name }}</h4>
                                    <p class="text-[11px] text-on-surface-variant leading-relaxed">{{ kind.desc }}</p>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- File Upload dropzone area -->
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-on-surface uppercase tracking-wider block ml-1">Upload
                            Resume Document</label>

                        <div
                            :class="[
                isDragging ? 'border-primary bg-primary/5 scale-[1.01]' : 'border-outline-variant/60 hover:border-primary hover:bg-slate-50/55',
                form.file ? 'bg-indigo-50/25 border-indigo-200' : ''
              ]"
                            class="border-2 border-dashed rounded-2xl p-8 flex flex-col items-center justify-center text-center cursor-pointer transition-all duration-300"
                            @click="triggerFileSelect"
                            @dragleave="handleDragLeave"
                            @dragover="handleDragOver"
                            @drop="handleDrop"
                        >
                            <div class="mb-3 text-primary/70">
                                <CloudUpload class="w-10 h-10 mx-auto"/>
                            </div>

                            <div v-if="!form.file">
                                <h4 class="font-bold text-sm text-on-surface mb-1 font-sans">Click or drag and drop to
                                    upload</h4>
                                <p class="text-xs text-on-surface-variant font-medium">Supports PDF, DOCX styles up to
                                    10MB</p>
                            </div>
                            <div v-else class="flex flex-col items-center gap-1">
                                <h4 class="font-extrabold text-sm text-primary flex items-center gap-1 px-4 py-1 bg-white rounded-full border border-primary/20 shadow-sm font-sans">
                                    <CheckCircle2 class="w-4 h-4 text-primary"/>
                                    {{ form.file.name }}
                                </h4>
                                <p class="text-xs text-on-surface-variant mt-2">File loaded successfully. Click to
                                    replace file.</p>
                            </div>

                            <input
                                id="create-portfolio-file"
                                ref="fileInput"
                                accept=".pdf,.docx"
                                class="hidden"
                                required
                                type="file"
                                @change="handleFileChange"
                            />
                        </div>
                    </div>

                    <!-- Actions Footer panel -->
                    <div class="pt-4 border-t border-slate-100 flex justify-between items-center gap-4">
                        <Link :href="dashboard()" as="button"
                              class="px-6 py-3 border border-outline-variant text-on-surface-variant hover:text-on-surface hover:bg-slate-50 font-bold text-sm rounded-xl transition-all"
                              type="button"
                        >
                            Cancel
                        </Link>
                        <button
                            class="px-8 py-3 bg-primary hover:bg-primary/95 text-white font-bold text-sm rounded-xl shadow-lg shadow-primary/20 transition-all active:scale-[0.98] flex items-center gap-1.5"
                            type="submit"
                            @click="handleConfirm"
                        >
                            <span>Confirm & Generate Canvas</span>
                            <ChevronRight class="w-4 h-4"/>
                        </button>
                    </div>

                </div>

            </div>

        </div>
    </section>
</template>
