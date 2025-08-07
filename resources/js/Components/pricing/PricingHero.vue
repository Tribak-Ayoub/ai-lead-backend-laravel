<template>
  <section class="relative overflow-hidden py-20 lg:py-32">
    <div class="absolute inset-0 bg-gradient-to-r from-blue-600/10 to-purple-600/10"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center">
        <div class="inline-flex items-center px-4 py-2 bg-blue-50 border border-blue-200 rounded-full text-blue-700 text-sm font-medium mb-8">
          <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
          </svg>
          Simple, Transparent Pricing
        </div>
        
        <h1 class="text-4xl md:text-6xl font-bold text-slate-900 mb-6 leading-tight">
          Choose Your
          <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent"> Perfect Plan</span>
        </h1>
        
        <p class="text-xl text-slate-600 mb-8 max-w-3xl mx-auto leading-relaxed">
          Start with our free trial and scale as you grow. No hidden fees, no long-term contracts. 
          Cancel anytime with full data export.
        </p>
        
        <div class="flex items-center justify-center space-x-4 mb-8">
          <span class="text-slate-600">Monthly</span>
          <button 
            @click="toggleBilling"
            class="relative inline-flex h-6 w-11 items-center rounded-full bg-gradient-to-r from-blue-600 to-purple-600 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
          >
            <span 
              :class="[
                isYearly ? 'translate-x-6' : 'translate-x-1',
                'inline-block h-4 w-4 transform rounded-full bg-white transition-transform'
              ]"
            ></span>
          </button>
          <span class="text-slate-600">
            Yearly 
            <span class="text-green-600 font-semibold">(Save 20%)</span>
          </span>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref } from 'vue'

const isYearly = ref(false)

const toggleBilling = () => {
  isYearly.value = !isYearly.value
}

defineExpose({
  isYearly
})
</script>