<template>
  <div v-if="included" class="flex items-center justify-center">
    <svg v-if="!value" class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
    </svg>
    <span v-else class="text-sm font-medium text-slate-900">{{ value }}</span>
  </div>
  <div v-else class="flex items-center justify-center">
    <svg class="w-5 h-5 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
    </svg>
  </div>
</template>

<script setup>
defineProps({
  included: {
    type: Boolean,
    required: true
  },
  value: {
    type: String,
    default: null
  }
})
</script>