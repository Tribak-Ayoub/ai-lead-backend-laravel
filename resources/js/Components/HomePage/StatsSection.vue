<template>
  <section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid md:grid-cols-4 gap-8 text-center">
        <StatCard 
          v-for="stat in stats" 
          :key="stat.label"
          :value="stat.value"
          :label="stat.label"
        />
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref } from 'vue'
import StatCard from '../HomePage/StatCard.vue'

const stats = ref([
  { value: '95%', label: 'Accuracy Rate' },
  { value: '3x', label: 'Faster Qualification' },
  { value: '50%', label: 'More Conversions' },
  { value: '24/7', label: 'AI Monitoring' }
])
</script>