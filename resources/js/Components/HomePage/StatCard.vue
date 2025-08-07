<template>
  <div class="group">
    <div class="text-4xl font-bold text-slate-900 mb-2 group-hover:text-blue-600 transition-colors">
      {{ value }}
    </div>
    <div class="text-slate-600">{{ label }}</div>
  </div>
</template>

<script setup>
defineProps({
  value: {
    type: String,
    required: true
  },
  label: {
    type: String,
    required: true
  }
})
</script>