<template>
  <nav class="bg-white/80 backdrop-blur-md border-b border-slate-200 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-16">
        <!-- Logo -->
        <div class="flex items-center space-x-2">
          <div class="w-8 h-8 bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg flex items-center justify-center">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z">
              </path>
            </svg>
          </div>
          <span class="text-xl font-bold text-slate-900">LeadAI</span>
        </div>

        <!-- Navigation Items -->
        <div class="hidden md:flex items-center space-x-8">
          <Link
            v-for="item in navigationItems"
            :key="item.name"
            :href="item.to"
            class="text-slate-600 hover:text-slate-900 transition-colors"
          >
            {{ item.name }}
          </Link>
        </div>

        <!-- Buttons -->
        <div class="flex items-center space-x-4">
          <Link :href="'/login'" class="text-slate-600 hover:text-slate-900 transition-colors">
            Sign In
          </Link>
          <Link
            href="/register"
            class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-4 py-2 rounded-lg hover:from-blue-700 hover:to-purple-700 transition-all duration-200 shadow-lg hover:shadow-xl"
          >
            Get Started
          </Link>
        </div>
      </div>
    </div>
  </nav>
</template>

<script setup>
import { ref } from 'vue'
import { router, Link } from '@inertiajs/vue3';

const navigationItems = ref([
  { name: 'Features', to: '/features' },
  { name: 'How It Works', to: '/how-it-works' },
  { name: 'Pricing', to: '/pricing' },
  { name: 'Contact', to: '/contact' }
])
</script>
