<template>
  <div>
    <!-- Page actions -->
    <div class="flex justify-between items-center mb-6">
      <div class="flex items-center space-x-4">
        <div class="relative">
          <input
            type="text"
            placeholder="Search leads..."
            class="block w-64 pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
          >
          <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
          </div>
        </div>
        <select class="block w-40 pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 rounded-md">
          <option>All Status</option>
          <option>Qualified</option>
          <option>Not Qualified</option>
          <option>Follow Up</option>
        </select>
      </div>
      <button class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
        </svg>
        Export Leads
      </button>
    </div>

    <!-- Leads table -->
    <div class="bg-white shadow-sm rounded-lg border border-gray-200 overflow-hidden">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lead</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Score</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <tr v-for="lead in leads" :key="lead.id" class="hover:bg-gray-50">
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="flex items-center">
                <div class="flex-shrink-0 h-10 w-10">
                  <div class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center">
                    <span class="text-sm font-medium text-gray-700">{{ lead.name.charAt(0) }}</span>
                  </div>
                </div>
                <div class="ml-4">
                  <div class="text-sm font-medium text-gray-900">{{ lead.name }}</div>
                  <div class="text-sm text-gray-500">{{ lead.phone }}</div>
                </div>
              </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm font-medium text-gray-900">{{ lead.score }}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span :class="[
                'inline-flex px-2 py-1 text-xs font-semibold rounded-full',
                lead.status === 'qualified' ? 'bg-green-100 text-green-800' :
                lead.status === 'not-qualified' ? 'bg-red-100 text-red-800' :
                'bg-yellow-100 text-yellow-800'
              ]">
                {{ lead.status }}
              </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
              {{ lead.date }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
              <button class="text-blue-600 hover:text-blue-900 mr-3">View</button>
              <button class="text-gray-600 hover:text-gray-900">Edit</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const leads = ref([
  { id: 1, name: 'Sarah Johnson', phone: '+1 (555) 123-4567', score: 85, status: 'qualified', date: '2024-01-15' },
  { id: 2, name: 'Mike Chen', phone: '+1 (555) 987-6543', score: 45, status: 'not-qualified', date: '2024-01-15' },
  { id: 3, name: 'Emily Davis', phone: '+1 (555) 456-7890', score: 92, status: 'qualified', date: '2024-01-14' },
  { id: 4, name: 'Robert Wilson', phone: '+1 (555) 321-0987', score: 67, status: 'follow-up', date: '2024-01-14' }
])
</script>