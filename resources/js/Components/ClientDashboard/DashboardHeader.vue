<template>
  <header class="bg-white border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">
        <div class="flex items-center space-x-4">
          <div class="flex items-center space-x-2">
            <div class="w-8 h-8 bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg flex items-center justify-center">
              <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
              </svg>
            </div>
            <span class="text-xl font-bold text-slate-900">LeadAI</span>
          </div>
          <div class="hidden md:block h-6 w-px bg-slate-300"></div>
          <h1 class="hidden md:block text-xl font-semibold text-slate-900">Dashboard</h1>
        </div>
        
        <div class="flex items-center space-x-4">
          <div class="flex items-center space-x-2 text-sm text-slate-600">
            <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
            <span>Live monitoring active</span>
          </div>
          
          <button class="relative p-2 text-slate-600 hover:text-slate-900 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5-5-5h5v-12"></path>
            </svg>
            <span class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full"></span>
          </button>
          
          <div class="flex items-center space-x-3">
            <div class="w-8 h-8 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full flex items-center justify-center">
              <span class="text-white text-sm font-semibold">JD</span>
            </div>
            <div class="hidden md:block">
              <div class="text-sm font-medium text-slate-900">John Doe</div>
              <div class="text-xs text-slate-600">Admin</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
</template>

<script setup>
// Dashboard header component
</script>