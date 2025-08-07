<template>
  <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-200">
    <div class="flex items-center justify-between mb-6">
      <h3 class="text-lg font-semibold text-slate-900">Call Analytics</h3>
      <div class="flex items-center space-x-2">
        <button 
          v-for="period in periods" 
          :key="period"
          @click="selectedPeriod = period"
          :class="[
            'px-3 py-1 text-sm font-medium rounded-lg transition-colors',
            selectedPeriod === period 
              ? 'bg-blue-100 text-blue-700' 
              : 'text-slate-600 hover:text-slate-900'
          ]"
        >
          {{ period }}
        </button>
      </div>
    </div>
    
    <div class="h-64 flex items-center justify-center bg-slate-50 rounded-lg">
      <div class="text-center">
        <svg class="w-16 h-16 text-slate-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
        </svg>
        <p class="text-slate-600">Chart visualization would be rendered here</p>
        <p class="text-sm text-slate-500 mt-1">Integration with Chart.js or similar library</p>
      </div>
    </div>
    
    <div class="grid grid-cols-3 gap-4 mt-6 pt-6 border-t border-slate-200">
      <div class="text-center">
        <div class="text-2xl font-bold text-slate-900">156</div>
        <div class="text-sm text-slate-600">Total Calls</div>
      </div>
      <div class="text-center">
        <div class="text-2xl font-bold text-green-600">89</div>
        <div class="text-sm text-slate-600">Qualified</div>
      </div>
      <div class="text-center">
        <div class="text-2xl font-bold text-red-600">67</div>
        <div class="text-sm text-slate-600">Not Qualified</div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const periods = ref(['7D', '30D', '90D'])
const selectedPeriod = ref('7D')
</script>