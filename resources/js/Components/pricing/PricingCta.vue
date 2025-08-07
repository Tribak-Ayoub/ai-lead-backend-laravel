<template>
  <section class="py-20 bg-gradient-to-r from-blue-600 to-purple-600">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
        Ready to Get Started?
      </h2>
      <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
        Join thousands of businesses already using LeadAI to qualify leads faster and more accurately. 
        Start your free trial today - no credit card required.
      </p>
      <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
        <button 
          @click="startTrial"
          class="bg-white text-blue-600 px-8 py-4 rounded-lg text-lg font-semibold hover:bg-slate-50 transition-colors shadow-lg"
        >
          Start 14-Day Free Trial
        </button>
        <button 
          @click="contactSales"
          class="border-2 border-white text-white px-8 py-4 rounded-lg text-lg font-semibold hover:bg-white hover:text-blue-600 transition-colors"
        >
          Contact Sales
        </button>
      </div>
      
      <div class="mt-8 flex items-center justify-center space-x-8 text-blue-100">
        <div class="flex items-center">
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
          </svg>
          No credit card required
        </div>
        <div class="flex items-center">
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
          </svg>
          Cancel anytime
        </div>
        <div class="flex items-center">
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
          </svg>
          Full data export
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
const startTrial = () => {
  // Handle start trial action
  console.log('Starting free trial...')
}

const contactSales = () => {
  // Handle contact sales action
  console.log('Contacting sales...')
}
</script>