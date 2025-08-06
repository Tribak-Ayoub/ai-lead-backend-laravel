<template>
  <div class="bg-slate-50 rounded-xl p-8 hover:bg-slate-100 transition-colors group">
    <div class="w-12 h-12 bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
      <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="icon"></path>
      </svg>
    </div>
    <h3 class="text-xl font-semibold text-slate-900 mb-3">{{ title }}</h3>
    <p class="text-slate-600 leading-relaxed">{{ description }}</p>
  </div>
</template>

<script setup>
defineProps({
  title: {
    type: String,
    required: true
  },
  description: {
    type: String,
    required: true
  },
  icon: {
    type: String,
    required: true
  }
})
</script>