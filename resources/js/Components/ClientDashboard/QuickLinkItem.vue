<template>
  <button 
    @click="$emit('click')"
    class="w-full flex items-center p-3 rounded-lg hover:bg-slate-50 transition-colors group"
  >
    <div :class="[
      'w-10 h-10 rounded-lg flex items-center justify-center mr-3 group-hover:scale-110 transition-transform',
      colorClasses[color]
    ]">
      <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="icon"></path>
      </svg>
    </div>
    <div class="flex-1 text-left">
      <div class="font-medium text-slate-900 group-hover:text-slate-700">{{ title }}</div>
      <div class="text-sm text-slate-600">{{ description }}</div>
    </div>
    <svg class="w-5 h-5 text-slate-400 group-hover:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
    </svg>
  </button>
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
  },
  color: {
    type: String,
    required: true
  }
})

defineEmits(['click'])

const colorClasses = {
  blue: 'bg-gradient-to-r from-blue-500 to-blue-600',
  green: 'bg-gradient-to-r from-green-500 to-green-600',
  purple: 'bg-gradient-to-r from-purple-500 to-purple-600',
  orange: 'bg-gradient-to-r from-orange-500 to-orange-600'
}
</script>