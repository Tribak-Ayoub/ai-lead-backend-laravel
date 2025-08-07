<template>
  <footer class="bg-slate-900 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid md:grid-cols-4 gap-8">
        <div class="col-span-2">
          <div class="flex items-center space-x-2 mb-4">
            <div class="w-8 h-8 bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg flex items-center justify-center">
              <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
              </svg>
            </div>
            <span class="text-xl font-bold">LeadAI</span>
          </div>
          <p class="text-slate-400 mb-6 max-w-md">
            AI-powered phone lead qualification system that helps businesses convert more prospects into customers.
          </p>
        </div>
        
        <FooterColumn 
          title="Product"
          :links="productLinks"
        />
        
        <FooterColumn 
          title="Company"
          :links="companyLinks"
        />
      </div>
      
      <div class="border-t border-slate-800 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center">
        <p class="text-slate-400">© 2024 LeadAI. All rights reserved.</p>
        <div class="flex space-x-6 mt-4 md:mt-0">
          <a 
            v-for="link in legalLinks" 
            :key="link.name"
            :href="link.href" 
            class="text-slate-400 hover:text-white transition-colors"
          >
            {{ link.name }}
          </a>
        </div>
      </div>
    </div>
  </footer>
</template>

<script setup>
import { ref } from 'vue'
import FooterColumn from '../Layout/FooterColumn.vue'

const productLinks = ref([
  { name: 'Features', href: '#' },
  { name: 'Pricing', href: '#' },
  { name: 'API', href: '#' },
  { name: 'Integrations', href: '#' }
])

const companyLinks = ref([
  { name: 'About', href: '#' },
  { name: 'Blog', href: '#' },
  { name: 'Careers', href: '#' },
  { name: 'Contact', href: '#' }
])

const legalLinks = ref([
  { name: 'Privacy', href: '#' },
  { name: 'Terms', href: '#' },
  { name: 'Security', href: '#' }
])
</script>