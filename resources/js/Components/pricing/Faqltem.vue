<template>
  <div class="border border-slate-200 rounded-lg">
    <button 
      @click="toggleOpen"
      class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-slate-50 transition-colors"
    >
      <span class="font-semibold text-slate-900">{{ question }}</span>
      <svg 
        :class="[
          'w-5 h-5 text-slate-500 transition-transform duration-200',
          isOpen ? 'rotate-180' : ''
        ]"
        fill="none" 
        stroke="currentColor" 
        viewBox="0 0 24 24"
      >
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
      </svg>
    </button>
    <div 
      v-if="isOpen"
      class="px-6 pb-4 text-slate-600 leading-relaxed border-t border-slate-200"
    >
      {{ answer }}
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'

defineProps({
  question: {
    type: String,
    required: true
  },
  answer: {
    type: String,
    required: true
  }
})

const isOpen = ref(false)

const toggleOpen = () => {
  isOpen.value = !isOpen.value
}
</script>