<template>
  <div class="flex min-h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside 
      class="w-64 bg-white shadow-xl border-r border-gray-200 fixed inset-y-0 left-0 z-50 flex flex-col"
    >
      <div class="h-16 flex items-center justify-center border-b border-gray-200 px-4 font-bold text-xl select-none">
        CRM Dashboard
      </div>

      <nav class="flex-1 overflow-y-auto px-4 py-6">
        <ul class="space-y-3">
          <li v-for="item in navigationItems" :key="item.name">
            <a
              href="#"
              @click.prevent="$emit('navigate', item)"
              :class="[
                'flex items-center px-4 py-3 rounded-lg text-sm font-semibold transition-colors duration-200 select-none',
                item.current
                  ? 'bg-blue-600 text-white shadow-md'
                  : 'text-gray-700 hover:bg-blue-100 hover:text-blue-700'
              ]"
            >
              <component :is="item.icon" class="mr-3 h-5 w-5 flex-shrink-0" />
              {{ item.name }}
            </a>
          </li>
        </ul>
      </nav>
    </aside>

    <!-- Main content -->
    
  </div>
</template>

<script setup>
import { h } from 'vue'

const navigationItems = [
  { 
    name: 'Dashboard', 
    current: true,
    icon: () => h('svg', { class: 'w-5 h-5', fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24' }, 
      h('path', { 'stroke-linecap': 'round', 'stroke-linejoin': 'round', 'stroke-width': '2', d: 'M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z' })
    )
  },
  { 
    name: 'Leads', 
    current: false,
    icon: () => h('svg', { class: 'w-5 h-5', fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24' }, 
      h('path', { 'stroke-linecap': 'round', 'stroke-linejoin': 'round', 'stroke-width': '2', d: 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z' })
    )
  },
  // Add more items...
]
</script>
