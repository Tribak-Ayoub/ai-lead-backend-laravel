<template>
  <section class="py-20 bg-gradient-to-r from-blue-600 to-purple-600">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
        Ready to Transform Your Lead Qualification?
      </h2>
      <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
        Join thousands of businesses already using AI to qualify leads faster and more accurately.
      </p>
      <div class="flex flex-col sm:flex-row gap-4 justify-center">
        <button 
          @click="startTrial"
          class="bg-white text-blue-600 px-8 py-4 rounded-lg text-lg font-semibold hover:bg-slate-50 transition-colors shadow-lg"
        >
          Start Free Trial
        </button>
        <button 
          @click="scheduleDemo"
          class="border-2 border-white text-white px-8 py-4 rounded-lg text-lg font-semibold hover:bg-white hover:text-blue-600 transition-colors"
        >
          Schedule Demo
        </button>
      </div>
    </div>
  </section>
</template>

<script setup>
const startTrial = () => {
  // Handle start trial action
  console.log('Starting free trial...')
}

const scheduleDemo = () => {
  // Handle schedule demo action
  console.log('Scheduling demo...')
}
</script>