<template>
  <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
    <!-- Filters Section -->
    <div class="border-b border-gray-200 bg-gray-50">
      <div class="px-6 py-4">
        <div class="flex items-center justify-between">
          <h3 class="text-sm font-medium text-gray-900 flex items-center">
            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
            </svg>
            Filters
          </h3>
          <button 
            @click="toggleFilters"
            class="text-sm text-blue-600 hover:text-blue-800 font-medium flex items-center"
          >
            {{ showFilters ? 'Hide' : 'Show' }} Filters
            <svg 
              :class="['w-4 h-4 ml-1 transform transition-transform duration-200', showFilters ? 'rotate-180' : '']"
              fill="none" 
              stroke="currentColor" 
              viewBox="0 0 24 24"
            >
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
          </button>
        </div>
        
        <!-- Filter Controls -->
        <div 
          v-show="showFilters"
          class="mt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4"
        >
          <!-- Status Filter -->
          <div class="relative">
            <label class="block text-xs font-medium text-gray-700 mb-1">Status</label>
            <div class="relative">
              <button
                @click="toggleStatusDropdown"
                class="w-full bg-white border border-gray-300 rounded-md px-3 py-2 text-left text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 flex items-center justify-between"
              >
                <span class="truncate">
                  {{ selectedStatuses.length === 0 ? 'All Statuses' : 
                     selectedStatuses.length === 1 ? selectedStatuses[0] : 
                     `${selectedStatuses.length} selected` }}
                </span>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
              </button>
              
              <!-- Status Dropdown -->
              <div 
                v-if="showStatusDropdown"
                class="absolute z-10 mt-1 w-full bg-white border border-gray-300 rounded-md shadow-lg"
              >
                <div class="py-1 max-h-60 overflow-auto">
                  <label 
                    v-for="status in statusOptions" 
                    :key="status"
                    class="flex items-center px-3 py-2 hover:bg-gray-50 cursor-pointer"
                  >
                    <input
                      type="checkbox"
                      :value="status"
                      v-model="selectedStatuses"
                      class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                    >
                    <span class="ml-2 text-sm text-gray-900">{{ status }}</span>
                    <span 
                      :class="[
                        'ml-auto inline-flex px-2 py-0.5 text-xs font-medium rounded-full',
                        getStatusColor(status)
                      ]"
                    >
                      {{ getStatusCount(status) }}
                    </span>
                  </label>
                </div>
              </div>
            </div>
          </div>

          <!-- Date Range Filter -->
          <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Date From</label>
            <input
              v-model="dateFrom"
              type="date"
              class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            >
          </div>

          <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Date To</label>
            <input
              v-model="dateTo"
              type="date"
              class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            >
          </div>

          <!-- Lead Source Filter -->
          <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Lead Source</label>
            <select
              v-model="selectedSource"
              class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            >
              <option value="">All Sources</option>
              <option v-for="source in sourceOptions" :key="source" :value="source">
                {{ source }}
              </option>
            </select>
          </div>

          <!-- Assigned To Filter -->
          <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Assigned To</label>
            <select
              v-model="selectedAssignee"
              class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            >
              <option value="">All Assignees</option>
              <option v-for="assignee in assigneeOptions" :key="assignee" :value="assignee">
                {{ assignee }}
              </option>
            </select>
          </div>

          <!-- Company Filter -->
          <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Company</label>
            <input
              v-model="companyFilter"
              type="text"
              placeholder="Filter by company..."
              class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            >
          </div>

          <!-- Clear Filters Button -->
          <div class="flex items-end">
            <button
              @click="clearFilters"
              class="w-full px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200"
            >
              Clear Filters
            </button>
          </div>
        </div>

        <!-- Active Filters Display -->
        <div v-if="hasActiveFilters" class="mt-4 flex flex-wrap gap-2">
          <span class="text-xs font-medium text-gray-500">Active filters:</span>
          
          <!-- Status filters -->
          <span 
            v-for="status in selectedStatuses" 
            :key="`status-${status}`"
            class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800"
          >
            {{ status }}
            <button 
              @click="removeStatusFilter(status)"
              class="ml-1 text-blue-600 hover:text-blue-800"
            >
              <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
              </svg>
            </button>
          </span>

          <!-- Date range filter -->
          <span 
            v-if="dateFrom || dateTo"
            class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800"
          >
            {{ dateFrom || '...' }} - {{ dateTo || '...' }}
            <button 
              @click="clearDateFilters"
              class="ml-1 text-green-600 hover:text-green-800"
            >
              <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
              </svg>
            </button>
          </span>

          <!-- Other active filters -->
          <span 
            v-if="selectedSource"
            class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800"
          >
            Source: {{ selectedSource }}
            <button 
              @click="selectedSource = ''"
              class="ml-1 text-purple-600 hover:text-purple-800"
            >
              <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
              </svg>
            </button>
          </span>

          <span 
            v-if="selectedAssignee"
            class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800"
          >
            Assigned: {{ selectedAssignee }}
            <button 
              @click="selectedAssignee = ''"
              class="ml-1 text-yellow-600 hover:text-yellow-800"
            >
              <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
              </svg>
            </button>
          </span>

          <span 
            v-if="companyFilter"
            class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800"
          >
            Company: {{ companyFilter }}
            <button 
              @click="companyFilter = ''"
              class="ml-1 text-gray-600 hover:text-gray-800"
            >
              <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
              </svg>
            </button>
          </span>
        </div>
      </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th 
              v-for="column in columns" 
              :key="column.key"
              class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
            >
              {{ column.label }}
            </th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <tr 
            v-for="lead in filteredLeads" 
            :key="lead.id"
            class="hover:bg-gray-50 transition-colors duration-150"
          >
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="flex items-center">
                <div class="flex-shrink-0 h-10 w-10">
                  <div class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center">
                    <span class="text-sm font-medium text-gray-700">{{ lead.name.charAt(0) }}</span>
                  </div>
                </div>
                <div class="ml-4">
                  <div class="text-sm font-medium text-gray-900">{{ lead.name }}</div>
                  <div class="text-sm text-gray-500">{{ lead.company }}</div>
                </div>
              </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ lead.email }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ lead.phone }}</td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span 
                :class="[
                  'inline-flex px-2 py-1 text-xs font-semibold rounded-full',
                  getStatusColor(lead.status)
                ]"
              >
                {{ lead.status }}
              </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
              <div class="flex space-x-1">
                                              <button
                                @click="$emit('detail', lead)"
                                class="text-gray-600 hover:text-gray-900 p-2 rounded-full hover:bg-gray-100 transition-colors duration-150"
                                title="View Details"
                              >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                              </button>

                <button 
                  @click="$emit('edit', lead)"
                  class="text-blue-600 hover:text-blue-900 p-2 rounded-full hover:bg-blue-50 transition-colors duration-150"
                  title="Edit"
                >
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                  </svg>
                </button>
                <button 
                  @click="$emit('delete', lead.id)"
                  class="text-red-600 hover:text-red-900 p-2 rounded-full hover:bg-red-50 transition-colors duration-150"
                  title="Delete"
                >
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                  </svg>
                </button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
      
      <!-- Empty State -->
      <div v-if="filteredLeads.length === 0" class="text-center py-12">
        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
        </svg>
        <h3 class="mt-2 text-sm font-medium text-gray-900">No leads found</h3>
        <p class="mt-1 text-sm text-gray-500">Try adjusting your filters or search criteria.</p>
        <div class="mt-6">
          <button 
            @click="clearFilters"
            class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
          >
            Clear all filters
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, watch, onMounted, onUnmounted } from 'vue'

const props = defineProps({
  leads: {
    type: Array,
    required: true
  },
  columns: {
    type: Array,
    default: () => [
      { key: 'name', label: 'Name' },
      { key: 'email', label: 'Email' },
      { key: 'phone', label: 'Phone' },
      { key: 'status', label: 'Status' },
      { key: 'actions', label: 'Actions' }
    ]
  }
})

defineEmits(['view-detail', 'edit', 'delete'])

// Filter state
const showFilters = ref(false)
const showStatusDropdown = ref(false)
const selectedStatuses = ref([])
const dateFrom = ref('')
const dateTo = ref('')
const selectedSource = ref('')
const selectedAssignee = ref('')
const companyFilter = ref('')

// Filter options
const statusOptions = ['New', 'Contacted', 'Qualified', 'Lost']
const sourceOptions = ['Website', 'Social Media', 'Email Campaign', 'Referral', 'Cold Call', 'Trade Show']
const assigneeOptions = ['John Doe', 'Jane Smith', 'Mike Johnson', 'Sarah Wilson', 'David Brown']

// Computed properties
const filteredLeads = computed(() => {
  let filtered = props.leads

  // Status filter
  if (selectedStatuses.value.length > 0) {
    filtered = filtered.filter(lead => selectedStatuses.value.includes(lead.status))
  }

  // Date range filter (mock implementation - you'd use actual date fields)
  if (dateFrom.value || dateTo.value) {
    // This would filter by actual date fields in real implementation
    filtered = filtered.filter(lead => {
      // Mock date comparison logic
      return true
    })
  }

  // Source filter (mock - you'd have actual source field)
  if (selectedSource.value) {
    // Mock source filtering
    filtered = filtered.filter(lead => {
      // This would check lead.source in real implementation
      return true
    })
  }

  // Assignee filter (mock - you'd have actual assignee field)
  if (selectedAssignee.value) {
    // Mock assignee filtering
    filtered = filtered.filter(lead => {
      // This would check lead.assignedTo in real implementation
      return true
    })
  }

  // Company filter
  if (companyFilter.value) {
    filtered = filtered.filter(lead => 
      lead.company.toLowerCase().includes(companyFilter.value.toLowerCase())
    )
  }

  return filtered
})

const hasActiveFilters = computed(() => {
  return selectedStatuses.value.length > 0 || 
         dateFrom.value || 
         dateTo.value || 
         selectedSource.value || 
         selectedAssignee.value || 
         companyFilter.value
})

// Methods
const toggleFilters = () => {
  showFilters.value = !showFilters.value
}

const toggleStatusDropdown = () => {
  showStatusDropdown.value = !showStatusDropdown.value
}

const getStatusColor = (status) => {
  const colors = {
    'New': 'bg-blue-100 text-blue-800',
    'Contacted': 'bg-yellow-100 text-yellow-800',
    'Qualified': 'bg-green-100 text-green-800',
    'Lost': 'bg-red-100 text-red-800'
  }
  return colors[status] || 'bg-gray-100 text-gray-800'
}

const getStatusCount = (status) => {
  return props.leads.filter(lead => lead.status === status).length
}

const clearFilters = () => {
  selectedStatuses.value = []
  dateFrom.value = ''
  dateTo.value = ''
  selectedSource.value = ''
  selectedAssignee.value = ''
  companyFilter.value = ''
}

const removeStatusFilter = (status) => {
  selectedStatuses.value = selectedStatuses.value.filter(s => s !== status)
}

const clearDateFilters = () => {
  dateFrom.value = ''
  dateTo.value = ''
}

// Close dropdown when clicking outside
const handleClickOutside = (event) => {
  if (!event.target.closest('.relative')) {
    showStatusDropdown.value = false
  }
}

onMounted(() => {
  document.addEventListener('click', handleClickOutside)
})

onUnmounted(() => {
  document.removeEventListener('click', handleClickOutside)
})

// Watch for filter changes to close status dropdown
watch([selectedStatuses, dateFrom, dateTo, selectedSource, selectedAssignee, companyFilter], () => {
  showStatusDropdown.value = false
})
</script>