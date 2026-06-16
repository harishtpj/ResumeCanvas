<script setup>
import { ref } from 'vue';
import { CloudUpload, Activity } from '@lucide/vue';

const emit = defineEmits(['uploaded']);

const isDragging = ref(false);
const isUploading = ref(false);
const uploadProgress = ref(0);
const uploadStatusText = ref('Drop your resume here');
const uploadSubText = ref('PDF, DOCX up to 10MB');

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
    simulateResumeScan(file.name);
  }
}

function handleFileSelect(e) {
  const input = e.target;
  const file = input.files?.[0];
  if (file) {
    simulateResumeScan(file.name);
  }
}

function triggerFilePicker() {
  const input = document.getElementById('resume-file-picker');
  input?.click();
}

function simulateResumeScan(fileName) {
  if (isUploading.value) return;
  
  isUploading.value = true;
  uploadStatusText.value = 'Preparing upload...';
  uploadSubText.value = fileName;
  uploadProgress.value = 0;
  
  // Staged progress ticker
  const interval = setInterval(() => {
    uploadProgress.value += 12;
    if (uploadProgress.value >= 12 && uploadProgress.value < 40) {
      uploadStatusText.value = 'Deconstructing resume layout...';
    } else if (uploadProgress.value >= 40 && uploadProgress.value < 75) {
      uploadStatusText.value = 'AI parsing profile, work experience & skills...';
    } else if (uploadProgress.value >= 75 && uploadProgress.value < 100) {
      uploadStatusText.value = 'Assembling glassmorphic digital template...';
    } else if (uploadProgress.value >= 100) {
      clearInterval(interval);
      uploadProgress.value = 100;
      uploadStatusText.value = 'Success! Live Portfolio is ready.';
      
      setTimeout(() => {
        emit('uploaded', fileName);
        isUploading.value = false;
        uploadProgress.value = 0;
        uploadStatusText.value = 'Drop your resume here';
        uploadSubText.value = 'PDF, DOCX up to 10MB';
      }, 1200);
    }
  }, 350);
}
</script>

<template>
  <div class="w-full max-w-2xl mx-auto mb-20 px-2">
    <div 
      @dragover="handleDragOver"
      @dragleave="handleDragLeave"
      @drop="handleDrop"
      @click="triggerFilePicker"
      class="glass-card border-2 border-dashed rounded-3xl p-10 flex flex-col items-center justify-center transition-all duration-300 cursor-pointer h-64 relative overflow-hidden text-center"
      :class="[
        isDragging ? 'border-primary bg-primary/5 scale-[1.01]' : 'border-outline-variant/60 hover:border-primary hover:bg-slate-50/50',
        isUploading ? 'pointer-events-none' : ''
      ]"
    >
      <!-- Live blue scan bar animation during parsing -->
      <div v-if="isUploading" class="animate-scan" :style="{ opacity: 0.25 }"></div>

      <div class="mb-4 duration-300 transform" :class="isUploading ? 'scale-110 animate-pulse text-primary' : 'text-primary/70'">
        <CloudUpload v-if="!isUploading" class="w-14 h-14" />
        <Activity v-else class="w-14 h-14 animate-bounce" />
      </div>

      <h3 class="font-bold text-xl text-on-surface mb-2 font-sans">{{ uploadStatusText }}</h3>
      <p class="text-on-surface-variant text-sm">{{ uploadSubText }}</p>

      <!-- Progress Bar -->
      <div v-if="isUploading" class="w-[80%] max-w-xs bg-slate-100 h-2 rounded-full overflow-hidden mt-4">
        <div class="bg-primary h-full transition-all duration-300 rounded-full" :style="{ width: uploadProgress + '%' }"></div>
      </div>

      <input 
        type="file" 
        id="resume-file-picker" 
        accept=".pdf,.docx" 
        class="hidden" 
        @change="handleFileSelect"
      />
    </div>
  </div>
</template>
