<template>
  <section class="relative overflow-hidden py-20 lg:py-32">
    <div class="absolute inset-0 bg-gradient-to-r from-blue-600/10 to-purple-600/10"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center">
        <div class="inline-flex items-center px-4 py-2 bg-blue-50 border border-blue-200 rounded-full text-blue-700 text-sm font-medium mb-8">
          <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
          </svg>
          AI-Powered Lead Qualification
        </div>

        <h1 class="text-4xl md:text-6xl font-bold text-slate-900 mb-6 leading-tight">
          Qualify Phone Leads with
          <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent"> AI Intelligence</span>
        </h1>

        <p class="text-xl text-slate-600 mb-8 max-w-3xl mx-auto leading-relaxed">
          {{ heroDescription }}
        </p>

        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
          <button
            @click="startTrial"
            class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-4 rounded-lg text-lg font-semibold hover:from-blue-700 hover:to-purple-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-1"
          >
            Start Free Trial
          </button>
          <button
            @click="watchDemo"
            class="flex items-center text-slate-700 hover:text-slate-900 transition-colors"
          >
            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Watch Demo
          </button>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref } from 'vue'

const heroDescription = ref(
  'Transform your phone conversations into qualified leads automatically. Our AI analyzes calls in real-time, scores prospects, and provides instant insights to boost your conversion rates.'
)

const startTrial = () => {
  // Handle start trial action
  console.log('Starting free trial...')
}

const watchDemo = () => {
  // Handle watch demo action
  console.log('Opening demo...')
}
</script>
<style scoped></style>
