<template>
  <div class="relative w-full max-w-4xl mx-auto mb-10 px-4 pt-4">
    <!-- Background bar -->
    <div
      class="absolute left-0 right-0 h-1 bg-gray-200 z-0 rounded-full"
      style="top: 2.5rem; transform: translateY(-50%)"
    ></div>

    <!-- Progress filled bar -->
    <div
      class="absolute left-0 h-1 bg-gradient-to-r from-blue-500 to-blue-700 z-10 rounded-full transition-all duration-300"
      :style="{
        width: `${(currentIndex) / (steps.length - 1.5) * 100}%`,
        top: '2.5rem',
        transform: 'translateY(-50%)'
      }"
    ></div>

    <!-- Steps -->
    <div class="flex justify-between relative z-20">
      <div
        v-for="(step, index) in steps"
        :key="step.path"
        class="flex-1 flex flex-col items-center"
      >
        <!-- The circle -->
        <div
          :class="[
            'w-10 h-10 rounded-full flex items-center justify-center font-bold mb-2 transition-all duration-300 z-20 relative',
            currentIndex === index
              ? 'bg-blue-600 text-white ring-4 ring-blue-200'
              : index < currentIndex
              ? 'bg-green-500 text-white'
              : 'bg-gray-300 text-gray-600'
          ]"
        >
          <span v-if="index < currentIndex">✔</span>
          <span v-else>{{ index + 1 }}</span>
        </div>

        <!-- Label -->
        <span
          :class="[
            'text-sm font-medium transition-colors duration-300 mt-1',
            currentIndex === index ? 'text-blue-700' : 'text-gray-600'
          ]"
        >
          {{ step.label }}
        </span>
      </div>
    </div>
  </div>
</template>


<script setup>
import { ref, watchEffect } from 'vue'


const steps = [
  { path: '/register', label: 'Register' },
  { path: '/plans', label: 'Plan' },
  { path: '/paiment', label: 'Paiment' },
  { path: '/checkoutConfirmation', label: 'Confirmation' }
]

const currentIndex = ref(0)

watchEffect(() => {
  const index = steps.findIndex(step => step.path === route.path)
  if (index !== -1) {
    currentIndex.value = index
    localStorage.setItem('currentProgressStep', index)
  }
})

const savedIndex = localStorage.getItem('currentProgressStep')
if (savedIndex !== null && !isNaN(savedIndex)) {
  currentIndex.value = parseInt(savedIndex)
}
</script>
