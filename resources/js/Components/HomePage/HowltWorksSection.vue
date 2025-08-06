<template>
  <section id="how-it-works" class="py-20 bg-gradient-to-br from-slate-50 to-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">
          How It Works
        </h2>
        <p class="text-xl text-slate-600 max-w-2xl mx-auto">
          Simple integration, powerful results. Get started in minutes.
        </p>
      </div>
      
      <div class="grid md:grid-cols-3 gap-8">
        <StepCard 
          v-for="(step, index) in steps" 
          :key="step.title"
          :step="index + 1"
          :title="step.title"
          :description="step.description"
          :is-last="index === steps.length - 1"
        />
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref } from 'vue'
import StepCard from '../HomePage/StepCard.vue'

const steps = ref([
  {
    title: 'Connect Your Phone System',
    description: 'Integrate with your existing phone system or VoIP provider in just a few clicks.'
  },
  {
    title: 'AI Analyzes Conversations',
    description: 'Our AI listens to calls in real-time, analyzing speech patterns, sentiment, and key indicators.'
  },
  {
    title: 'Get Qualified Leads',
    description: 'Receive instant lead scores and insights to prioritize your follow-up efforts effectively.'
  }
])
</script>