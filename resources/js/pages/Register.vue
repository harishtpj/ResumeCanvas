<script setup>
import RegisterForm from '../components/RegisterForm.vue';

const emit = defineEmits(['submit', 'navigate', 'alert']);
</script>

<template>
  <section class="pt-32 pb-24 px-4 w-full flex items-center justify-center">
    <div class="w-full max-w-md mx-auto relative">
      <RegisterForm 
        @submit="(payload) => emit('submit', payload)"
        @navigate="(target) => emit('navigate', target)"
        @alert="(txt, type) => emit('alert', txt, type)"
      />
    </div>
  </section>
</template>
