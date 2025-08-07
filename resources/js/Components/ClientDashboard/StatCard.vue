<template>
  <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-200 hover:shadow-md transition-shadow">
    <div class="flex items-center justify-between mb-4">
      <div :class="[
        'w-12 h-12 rounded-lg flex items-center justify-center',
        colorClasses[color]
      ]">
        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="icon"></path>
        </svg>
      </div>
      <div :class="[
        'flex items-center text-sm font-medium',
        trend === 'up' ? 'text-green-600' : 'text-red-600'
      ]">
        <svg 
          :class="[
            'w-4 h-4 mr-1',
            trend === 'up' ? 'rotate-0' : 'rotate-180'
          ]"
          fill="none" 
          stroke="currentColor" 
          viewBox="0 0 24 24"
        >
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 17l9.2-9.2M17 17V7H7"></path>
        </svg>
        {{ change }}
      </div>
    </div>
    <div class="text-2xl font-bold text-slate-900 mb-1">{{ value }}</div>
    <div class="text-sm text-slate-600">{{ title }}</div>
  </div>
</template>

<script setup>
import { defineProps } from 'vue'

defineProps({
  title: {
    type: String,
    required: true
  },
  value: {
    type: String,
    required: true
  },
  change: {
    type: String,
    required: true
  },
  trend: {
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

const colorClasses = {
  blue: 'bg-gradient-to-r from-blue-500 to-blue-600',
  green: 'bg-gradient-to-r from-green-500 to-green-600',
  purple: 'bg-gradient-to-r from-purple-500 to-purple-600',
  orange: 'bg-gradient-to-r from-orange-500 to-orange-600'
}
</script>