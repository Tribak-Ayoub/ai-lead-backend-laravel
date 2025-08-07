<template>
  <div 
    :class="[
      'relative rounded-2xl p-8 transition-all duration-200',
      isPopular 
        ? 'bg-gradient-to-br from-blue-50 to-purple-50 border-2 border-blue-200 shadow-xl scale-105' 
        : 'bg-slate-50 border border-slate-200 hover:shadow-lg hover:border-slate-300'
    ]"
  >
    <div v-if="isPopular" class="absolute -top-4 left-1/2 transform -translate-x-1/2">
      <span class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-4 py-2 rounded-full text-sm font-semibold">
        Most Popular
      </span>
    </div>
    
    <div class="text-center mb-8">
      <h3 class="text-2xl font-bold text-slate-900 mb-2">{{ plan.name }}</h3>
      <p class="text-slate-600 mb-6">{{ plan.description }}</p>
      
      <div class="mb-6">
        <span class="text-5xl font-bold text-slate-900">
          ${{ isYearly ? plan.yearlyPrice : plan.monthlyPrice }}
        </span>
        <span class="text-slate-600 ml-2">/month</span>
        <div v-if="isYearly" class="text-sm text-green-600 font-medium mt-1">
          Save ${{ (plan.monthlyPrice - plan.yearlyPrice) * 12 }} per year
        </div>
      </div>
      
      <button 
        @click="selectPlan"
        :class="[
          'w-full py-3 px-6 rounded-lg font-semibold transition-all duration-200',
          isPopular
            ? 'bg-gradient-to-r from-blue-600 to-purple-600 text-white hover:from-blue-700 hover:to-purple-700 shadow-lg hover:shadow-xl'
            : 'bg-slate-900 text-white hover:bg-slate-800'
        ]"
      >
        {{ plan.buttonText }}
      </button>
    </div>
    
    <div class="space-y-4">
      <h4 class="font-semibold text-slate-900 mb-4">What's included:</h4>
      <ul class="space-y-3">
        <li 
          v-for="feature in plan.features" 
          :key="feature"
          class="flex items-start"
        >
          <svg class="w-5 h-5 text-green-500 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
          </svg>
          <span class="text-slate-600">{{ feature }}</span>
        </li>
      </ul>
    </div>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';

const props = defineProps({
  plan: {
    type: Object,
    required: true
  },
  isYearly: {
    type: Boolean,
    default: false
  },
  isPopular: {
    type: Boolean,
    default: false
  }
  
})

const { plan, isYearly, isPopular } = props;

const selectPlan = () => {
  // Handle plan selection
  console.log('Plan selected:', plan.name)
}
</script>