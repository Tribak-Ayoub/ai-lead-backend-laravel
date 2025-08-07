<template>
  <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-200">
    <div class="flex items-center justify-between mb-6">
      <h3 class="text-lg font-semibold text-slate-900">Recent Calls</h3>
      <button class="text-blue-600 hover:text-blue-700 text-sm font-medium">
        View All
      </button>
    </div>
    
    <div class="space-y-4">
      <CallItem 
        v-for="call in recentCalls" 
        :key="call.id"
        :call="call"
      />
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import CallItem from './CallItem.vue'

const recentCalls = ref([
  {
    id: 1,
    caller: 'Sarah Johnson',
    phone: '+1 (555) 123-4567',
    duration: '4:32',
    score: 85,
    status: 'qualified',
    time: '2 minutes ago',
    sentiment: 'positive'
  },
  {
    id: 2,
    caller: 'Mike Chen',
    phone: '+1 (555) 987-6543',
    duration: '2:15',
    score: 45,
    status: 'not-qualified',
    time: '15 minutes ago',
    sentiment: 'neutral'
  },
  {
    id: 3,
    caller: 'Emily Davis',
    phone: '+1 (555) 456-7890',
    duration: '6:48',
    score: 92,
    status: 'qualified',
    time: '32 minutes ago',
    sentiment: 'positive'
  },
  {
    id: 4,
    caller: 'Robert Wilson',
    phone: '+1 (555) 321-0987',
    duration: '3:21',
    score: 67,
    status: 'follow-up',
    time: '1 hour ago',
    sentiment: 'neutral'
  }
])
</script>