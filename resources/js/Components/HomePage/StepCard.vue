<template>
  <div class="text-center">
    <div class="relative mb-8">
      <div class="w-16 h-16 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full flex items-center justify-center mx-auto text-white text-xl font-bold">
        {{ step }}
      </div>
      <div 
        v-if="!isLast" 
        class="hidden md:block absolute top-8 left-1/2 w-full h-0.5 bg-gradient-to-r from-blue-600 to-purple-600 transform translate-x-8"
      ></div>
    </div>
    <h3 class="text-xl font-semibold text-slate-900 mb-3">{{ title }}</h3>
    <p class="text-slate-600 leading-relaxed">{{ description }}</p>
  </div>
</template>

<script setup>
defineProps({
  step: {
    type: Number,
    required: true
  },
  title: {
    type: String,
    required: true
  },
  description: {
    type: String,
    required: true
  },
  isLast: {
    type: Boolean,
    default: false
  }
})
</script>