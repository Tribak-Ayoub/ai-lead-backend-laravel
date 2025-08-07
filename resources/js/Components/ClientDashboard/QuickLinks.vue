<template>
  <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-200">
    <h3 class="text-lg font-semibold text-slate-900 mb-6">Quick Actions</h3>
    <div class="space-y-3">
      <QuickLinkItem 
        v-for="link in quickLinks" 
        :key="link.title"
        :title="link.title"
        :description="link.description"
        :icon="link.icon"
        :color="link.color"
        @click="handleQuickAction(link.action)"
      />
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import QuickLinkItem from './QuickLinkItem.vue'

const quickLinks = ref([
  {
    title: 'View All Calls',
    description: 'Browse complete call history',
    icon: 'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z',
    color: 'blue',
    action: 'view-calls'
  },
  {
    title: 'Export Leads',
    description: 'Download qualified leads data',
    icon: 'M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
    color: 'green',
    action: 'export-leads'
  },
  {
    title: 'AI Settings',
    description: 'Configure qualification criteria',
    icon: 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z',
    color: 'purple',
    action: 'ai-settings'
  },
  {
    title: 'Integration Setup',
    description: 'Connect CRM and tools',
    icon: 'M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1',
    color: 'orange',
    action: 'integrations'
  }
])

const handleQuickAction = (action) => {
  console.log('Quick action:', action)
  // Handle different actions
}
</script>