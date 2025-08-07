<template>
  <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-200">
    <h3 class="text-lg font-semibold text-slate-900 mb-6">AI Insights</h3>
    
    <div class="space-y-4">
      <div class="p-4 bg-blue-50 rounded-lg border border-blue-200">
        <div class="flex items-start">
          <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center mr-3 mt-0.5">
            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
          </div>
          <div>
            <div class="font-medium text-blue-900 mb-1">Peak Call Time</div>
            <div class="text-sm text-blue-700">Most qualified leads call between 2-4 PM. Consider increasing staff during these hours.</div>
          </div>
        </div>
      </div>
      
      <div class="p-4 bg-green-50 rounded-lg border border-green-200">
        <div class="flex items-start">
          <div class="w-8 h-8 bg-green-600 rounded-lg flex items-center justify-center mr-3 mt-0.5">
            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
            </svg>
          </div>
          <div>
            <div class="font-medium text-green-900 mb-1">Conversion Trend</div>
            <div class="text-sm text-green-700">Your conversion rate improved by 12% this week. Great job!</div>
          </div>
        </div>
      </div>
      
      <div class="p-4 bg-purple-50 rounded-lg border border-purple-200">
        <div class="flex items-start">
          <div class="w-8 h-8 bg-purple-600 rounded-lg flex items-center justify-center mr-3 mt-0.5">
            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
            </svg>
          </div>
          <div>
            <div class="font-medium text-purple-900 mb-1">AI Recommendation</div>
            <div class="text-sm text-purple-700">Consider updating qualification criteria for better lead scoring accuracy.</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
// AI insights component
</script>