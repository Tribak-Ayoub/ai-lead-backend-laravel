<template>
        <div class="space-y-6">
            <!-- Page Header -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Call Logs</h1>
                    <p class="mt-1 text-sm text-gray-500">
                        Review detailed call history and recordings
                    </p>
                </div>
                <div class="mt-4 sm:mt-0 flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-3">

                    <button @click="exportToCSV" :disabled="paginatedCallLogs.length === 0"
                        class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Export CSV
                    </button>
                </div>
            </div>



            <!-- Filters Section -->
            <div class="border border-gray-200 bg-white rounded-lg">
                <div class="px-6 py-4 ">
                    <div class="flex items-center justify-between ">
                        <h3 class="text-sm font-medium text-gray-900 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z">
                                </path>
                            </svg>
                            Filters
                        </h3>
                        <button @click="toggleFilters"
                            class="text-sm text-blue-600 hover:text-blue-800 font-medium flex items-center">
                            {{ showFilters ? 'Hide' : 'Show' }} Filters
                            <svg :class="['w-4 h-4 ml-1 transform transition-transform duration-200 ', showFilters ? 'rotate-180' : '']"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Filter Controls -->
                    <div v-show="showFilters" class="mt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 ">
                        <!-- Status Filter -->
                        <div class="relative ">
                            <label class="block text-xs font-medium text-gray-700 mb-1">Status</label>
                            <div class="relative">
                                <button @click="toggleStatusDropdown"
                                    class="w-full bg-white border border-gray-300 rounded-md px-3 py-2 text-left text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 flex items-center justify-between">
                                    <span class="truncate">
                                        {{ selectedStatuses.length === 0 ? 'All Statuses' :
                                            selectedStatuses.length === 1 ? formatStatus(selectedStatuses[0]) :
                                                `${selectedStatuses.length} selected` }}
                                    </span>
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>

                                <!-- Status Dropdown -->
                                <div v-if="showStatusDropdown"
                                    class="absolute z-10 mt-1 w-full bg-white border border-gray-300 rounded-md shadow-lg">
                                    <div class="py-1 max-h-60 overflow-auto">
                                        <label v-for="status in statusOptions" :key="status"
                                            class="flex items-center px-3 py-2 hover:bg-gray-50 cursor-pointer">
                                            <input type="checkbox" :value="status" v-model="selectedStatuses"
                                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                            <span class="ml-2 text-sm text-gray-900">{{ formatStatus(status) }}</span>
                                            <span :class="[
                                                'ml-auto inline-flex px-2 py-0.5 text-xs font-medium rounded-full',
                                                getStatusColor(status)
                                            ]">
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
                            <input v-model="dateFrom" type="date"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Date To</label>
                            <input v-model="dateTo" type="date"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <!-- Lead Source Filter -->

                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Lead Source</label>
                            <div class="flex items-center border border-gray-300 rounded-md  w-full relative">
                            <select
                                v-model="selectedSource"
                                class="flex-grow appearance-none bg-transparent text-sm px-3 py-2 text-gray-900 focus:outline-none w-full"
                            >
                                <option value="">All Sources</option>
                                <option v-for="source in sourceOptions" :key="source" :value="source">
                                {{ source }}
                                </option>
                            </select>
                            <ChevronDown class="w-4 h-4 text-gray-500 ml-2 pointer-events-none absolute right-3" />
                            </div>
                        </div>
                        <!-- Assigned To Filter -->

                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Campaign</label>
                            <div class="flex items-center border border-gray-300 rounded-md  w-full relative">
                            <select
                                v-model="selectedAssignee"
                                class="flex-grow appearance-none bg-transparent text-sm px-3 py-2 text-gray-900 focus:outline-none"
                            >
                                <option value="">All Campaign</option>
                                <option v-for="assignee in assigneeOptions" :key="assignee" :value="assignee">
                                {{ assignee }}
                                </option>
                            </select>
                            <ChevronDown class="w-4 h-4 text-gray-500 ml-2 pointer-events-none absolute right-3" />
                            </div>
                        </div>
                        <!-- Company Filter -->
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Assigned To</label>
                            <input v-model="companyFilter" type="text" placeholder="Filter by Assigned..."
                                class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <!-- Duration Filter -->
                 
  
                <div class="w-full">
                <label for="duration" class="block text-xs font-medium text-gray-700 mb-1">Duration</label>
                <div class="relative flex items-center border border-gray-300 rounded-md  w-full">
                <select
                    id="duration"
                    v-model="selectedDuration"
                    class="flex-grow appearance-none bg-transparent px-3 py-2 text-sm text-gray-900 focus:outline-none"
                >
                    <option value="">All Durations</option>
                    <option value="short">Short (&lt; 2 min)</option>
                    <option value="medium">Medium (2–5 min)</option>
                    <option value="long">Long (&gt; 5 min)</option>
                </select>
                <ChevronDown class="w-4 h-4 text-gray-500 ml-2 pointer-events-none absolute right-3" />
                </div>
            </div>

                        <!-- Clear Filters Button -->
                        <div class="flex items-end">
                            <button @click="clearAllFilters"
                                class="w-full px-4 py-2 text-sm font-medium text-gray-700 bg-gray-50  border border-gray-300 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                Clear All Filters
                            </button>
                        </div>
                    </div>

                    <!-- Active Filters Display -->
                    <div v-if="hasActiveFilters" class="mt-4 flex flex-wrap gap-2">
                        <span class="text-xs font-medium text-gray-500">Active filters:</span>

                        <!-- Search filter -->
                        <span v-if="searchQuery"
                            class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                            Search: "{{ searchQuery }}"
                            <button @click="clearSearch" class="ml-1 text-indigo-600 hover:text-indigo-800">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </span>

                        <!-- Status filters -->
                        <span v-for="status in selectedStatuses" :key="`status-${status}`"
                            class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            {{ formatStatus(status) }}
                            <button @click="removeStatusFilter(status)" class="ml-1 text-blue-600 hover:text-blue-800">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </span>

                        <!-- Date range filter -->
                        <span v-if="dateFrom || dateTo"
                            class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            {{ dateFrom || '...' }} - {{ dateTo || '...' }}
                            <button @click="clearDateFilters" class="ml-1 text-green-600 hover:text-green-800">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </span>

                        <!-- Other active filters -->
                        <span v-if="selectedSource"
                            class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                            Source: {{ selectedSource }}
                            <button @click="selectedSource = ''" class="ml-1 text-purple-600 hover:text-purple-800">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </span>

                        <span v-if="selectedAssignee"
                            class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                            Assigned: {{ selectedAssignee }}
                            <button @click="selectedAssignee = ''" class="ml-1 text-yellow-600 hover:text-yellow-800">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </span>

                        <span v-if="companyFilter"
                            class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                            Company: {{ companyFilter }}
                            <button @click="companyFilter = ''" class="ml-1 text-gray-600 hover:text-gray-800">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </span>

                        <span v-if="durationFilter"
                            class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                            Duration: {{ formatDurationFilter(durationFilter) }}
                            <button @click="durationFilter = ''" class="ml-1 text-orange-600 hover:text-orange-800">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Call Logs Table - Responsive -->
            <div class="bg-white shadow-sm rounded-lg border border-gray-200 overflow-hidden">
                <div v-if="isLoading" class="p-8 text-center">
                    <div class="inline-flex items-center">
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                            </circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                        Loading call logs...
                    </div>
                </div>

                <div v-else-if="filteredCallLogs.length === 0" class="p-8 text-center">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">
                        {{ callLogs.length === 0 ? 'No call logs found' : 'No matching call logs' }}
                    </h3>
                    <p class="text-gray-500 mb-4">
                        {{ callLogs.length === 0
                            ? 'Click "Generate Logs" to create sample call data'
                            : 'Try adjusting your search or filter criteria'
                        }}
                    </p>
                    <button v-if="hasActiveFilters" @click="clearAllFilters"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-blue-600 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Clear All Filters
                    </button>
                </div>

                <!-- Desktop Table -->
                <div v-else class="hidden lg:block overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Lead</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Duration</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Date & Time</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Campaign</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="log in paginatedCallLogs" :key="log.id" class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div
                                                class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center">
                                                <span class="text-sm font-medium text-gray-700">{{
                                                    log.leadName.charAt(0) }}</span>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ log.leadName }}</div>
                                          
                                            <div class="text-xs text-gray-400">{{ log.phoneNumber }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span :class="getStatusClass(log.status)">
                                        {{ formatStatus(log.status) }}
                                    </span>
                                    <div v-if="log.confidenceScore" class="text-xs text-gray-500 mt-1">
                                        {{ log.confidenceScore }}% confidence
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ log.duration }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div>{{ formatDate(log.timestamp) }}</div>
                                    <div class="text-xs">{{ formatTime(log.timestamp) }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ log.campaign }}</div>
                                    <div v-if="log.intent" class="text-xs text-gray-500">{{ log.intent }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center space-x-2">
                                        <button @click="playRecording(log)" title="Play Recording"
                                            class="text-blue-600 hover:text-blue-900">
                                            <Play class="w-4 h-4" />
                                        </button>
                                        <button @click="deleteLog(log)" title="Delete"
                                            class="text-red-600 hover:text-red-900">
                                            <Trash2 class="w-4 h-4" />
                                        </button>
                                        <button @click="viewDetails(log)" title="Details"
                                            class="text-gray-600 hover:text-gray-900">
                                            <Info class="w-4 h-4" />
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Cards -->
                <div class="lg:hidden">
                    <div v-for="log in paginatedCallLogs" :key="log.id" class="border-b border-gray-200 p-4">
                        <div class="flex items-start justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <div class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center">
                                        <span class="text-sm font-medium text-gray-700">{{ log.leadName.charAt(0)
                                            }}</span>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="text-sm font-medium text-gray-900 truncate">{{ log.leadName }}</div>
                                    <div class="text-sm text-gray-500 truncate">{{ log.company }}</div>
                                    <div class="text-xs text-gray-400">{{ log.phoneNumber }}</div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <button @click="playRecording(log)" class="text-blue-600 hover:text-blue-900">
                                    <Play class="w-4 h-4" />
                                </button>
                                <button @click="deleteLog(log)" class="text-red-600 hover:text-red-900">
                                    <Trash2 class="w-4 h-4" />
                                </button>
                                <button @click="viewDetails(log)" class="text-gray-600 hover:text-gray-900">
                                    <Info class="w-4 h-4" />
                                </button>
                            </div>
                        </div>

                        <div class="mt-3 grid grid-cols-2 gap-3 text-sm">
                            <div>
                                <span class="text-gray-500">Status:</span>
                                <span :class="getStatusClass(log.status)" class="ml-1">
                                    {{ formatStatus(log.status) }}
                                </span>
                            </div>
                            <div>
                                <span class="text-gray-500">Duration:</span>
                                <span class="ml-1 text-gray-900">{{ log.duration }}</span>
                            </div>
                            <div>
                                <span class="text-gray-500">Date:</span>
                                <span class="ml-1 text-gray-900">{{ formatDate(log.timestamp) }}</span>
                            </div>
                            <div>
                                <span class="text-gray-500">Time:</span>
                                <span class="ml-1 text-gray-900">{{ formatTime(log.timestamp) }}</span>
                            </div>
                        </div>

                        <div class="mt-2">
                            <span class="text-gray-500 text-sm">Campaign:</span>
                            <span class="ml-1 text-sm text-gray-900">{{ log.campaign }}</span>
                            <div v-if="log.intent" class="text-xs text-gray-500 mt-1">Intent: {{ log.intent }}</div>
                            <div v-if="log.confidenceScore" class="text-xs text-gray-500">
                                {{ log.confidenceScore }}% confidence
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                    <div class="flex-1 flex justify-between sm:hidden">
                        <button @click="previousPage" :disabled="currentPage === 1"
                            class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                            Previous
                        </button>
                        <button @click="nextPage" :disabled="currentPage === totalPages"
                            class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                            Next
                        </button>
                    </div>

                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                Showing <span class="font-medium">{{ startIndex + 1 }}</span> to
                                <span class="font-medium">{{ Math.min(endIndex, filteredCallLogs.length) }}</span> of
                                <span class="font-medium">{{ filteredCallLogs.length }}</span> results
                            </p>
                        </div>
                        <div>
                            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px"
                                aria-label="Pagination">
                                <button @click="previousPage" :disabled="currentPage === 1"
                                    class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                                    <span class="sr-only">Previous</span>
                                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <button v-for="page in visiblePages" :key="page" @click="goToPage(page)" :class="[
                                    'relative inline-flex items-center px-4 py-2 border text-sm font-medium',
                                    page === currentPage
                                        ? 'z-10 bg-blue-50 border-blue-500 text-blue-600'
                                        : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50'
                                ]">
                                    {{ page }}
                                </button>

                                <button @click="nextPage" :disabled="currentPage === totalPages"
                                    class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                                    <span class="sr-only">Next</span>
                                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>

<script setup>
import { onMounted, ref, computed, watch, onUnmounted } from 'vue'

import { Play, Trash2, Info, ChevronDown } from 'lucide-vue-next'
import {UseCallLog} from '@/Components/UseCallLog.vue'
import LayoutClient from '@/Layouts/LayoutClient.vue'
defineOptions({layout : LayoutClient})
const selectedDuration = ref('')
const {
    callLogs,
    isLoading,
    generateCallLogs,
    exportToCSV,
    campaigns
} = UseCallLog()

// Search and Filter State
const searchQuery = ref('')
const showFilters = ref(false)
const showStatusDropdown = ref(false)

// Filter states
const selectedStatuses = ref([])
const dateFrom = ref('')
const dateTo = ref('')
const selectedSource = ref('')
const selectedAssignee = ref('')
const companyFilter = ref('')
const durationFilter = ref('')

// Pagination
const currentPage = ref(1)
const itemsPerPage = ref(10)

// Filter options
const statusOptions = ['qualified', 'completed', 'not-qualified', 'no-answer', 'busy', 'voicemail', 'failed']
const sourceOptions = computed(() => {
    const sources = [...new Set(callLogs.value.map(log => log.source).filter(Boolean))]
    return sources.sort()
})
const assigneeOptions = computed(() => {
    const assignees = [...new Set(callLogs.value.map(log => log.assignedTo).filter(Boolean))]
    return assignees.sort()
})

// Computed filtered logs
const filteredCallLogs = computed(() => {
    let filtered = [...callLogs.value]

    // Search filter
    if (searchQuery.value) {
        const query = searchQuery.value.toLowerCase()
        filtered = filtered.filter(log =>
            log.leadName.toLowerCase().includes(query) ||
            log.company.toLowerCase().includes(query) ||
            log.phoneNumber.includes(query) ||
            (log.notes && log.notes.toLowerCase().includes(query)) ||
            (log.aiSummary && log.aiSummary.toLowerCase().includes(query))
        )
    }

    // Status filter
    if (selectedStatuses.value.length > 0) {
        filtered = filtered.filter(log => selectedStatuses.value.includes(log.status))
    }

    // Date range filter
    if (dateFrom.value) {
        const fromDate = new Date(dateFrom.value)
        filtered = filtered.filter(log => new Date(log.timestamp) >= fromDate)
    }
    if (dateTo.value) {
        const toDate = new Date(dateTo.value)
        toDate.setHours(23, 59, 59, 999) // End of day
        filtered = filtered.filter(log => new Date(log.timestamp) <= toDate)
    }

    // Source filter
    if (selectedSource.value) {
        filtered = filtered.filter(log => log.source === selectedSource.value)
    }

    // Assignee filter
    if (selectedAssignee.value) {
        filtered = filtered.filter(log => log.assignedTo === selectedAssignee.value)
    }

    // Company filter
    if (companyFilter.value) {
        const query = companyFilter.value.toLowerCase()
        filtered = filtered.filter(log => log.company.toLowerCase().includes(query))
    }

    // Duration filter
    if (durationFilter.value) {
        filtered = filtered.filter(log => {
            const duration = parseDuration(log.duration)
            switch (durationFilter.value) {
                case 'short':
                    return duration < 120 // less than 2 minutes
                case 'medium':
                    return duration >= 120 && duration <= 300 // 2-5 minutes
                case 'long':
                    return duration > 300 // more than 5 minutes
                default:
                    return true
            }
        })
    }

    return filtered
})

// Computed pagination values
const totalPages = computed(() => {
    return Math.ceil(filteredCallLogs.value.length / itemsPerPage.value)
})

const startIndex = computed(() => {
    return (currentPage.value - 1) * itemsPerPage.value
})

const endIndex = computed(() => {
    return startIndex.value + itemsPerPage.value
})

const paginatedCallLogs = computed(() => {
    return filteredCallLogs.value.slice(startIndex.value, endIndex.value)
})

const visiblePages = computed(() => {
    const pages = []
    const start = Math.max(1, currentPage.value - 2)
    const end = Math.min(totalPages.value, currentPage.value + 2)

    for (let i = start; i <= end; i++) {
        pages.push(i)
    }
    return pages
})

// Computed active filters check
const hasActiveFilters = computed(() => {
    return searchQuery.value ||
        selectedStatuses.value.length > 0 ||
        dateFrom.value ||
        dateTo.value ||
        selectedSource.value ||
        selectedAssignee.value ||
        companyFilter.value ||
        durationFilter.value
})

// Helper functions
const parseDuration = (duration) => {
    const parts = duration.split(':')
    return parseInt(parts[0]) * 60 + parseInt(parts[1])
}

const getStatusCount = (status) => {
    return callLogs.value.filter(log => log.status === status).length
}

const getStatusColor = (status) => {
    const colors = {
        'qualified': 'bg-green-100 text-green-800',
        'completed': 'bg-blue-100 text-blue-800',
        'not-qualified': 'bg-red-100 text-red-800',
        'no-answer': 'bg-yellow-100 text-yellow-800',
        'busy': 'bg-orange-100 text-orange-800',
        'voicemail': 'bg-purple-100 text-purple-800',
        'failed': 'bg-gray-100 text-gray-800'
    }
    return colors[status] || 'bg-gray-100 text-gray-800'
}

const getStatusClass = (status) => {
    const classes = {
        'qualified': 'inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800',
        'completed': 'inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800',
        'not-qualified': 'inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800',
        'no-answer': 'inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800',
        'busy': 'inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-orange-100 text-orange-800',
        'voicemail': 'inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-purple-100 text-purple-800',
        'failed': 'inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800'
    }
    return classes[status] || 'inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800'
}

const formatStatus = (status) => {
    return status.replace('-', ' ').replace(/\b\w/g, l => l.toUpperCase())
}

const formatDurationFilter = (filter) => {
    const labels = {
        'short': 'Short (< 2 min)',
        'medium': 'Medium (2-5 min)',
        'long': 'Long (> 5 min)'
    }
    return labels[filter] || filter
}

const formatDate = (timestamp) => {
    return new Date(timestamp).toLocaleDateString()
}

const formatTime = (timestamp) => {
    return new Date(timestamp).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })
}

// Filter methods
const toggleFilters = () => {
    showFilters.value = !showFilters.value
}

const toggleStatusDropdown = () => {
    showStatusDropdown.value = !showStatusDropdown.value
}

const clearSearch = () => {
    searchQuery.value = ''
}

const clearDateFilters = () => {
    dateFrom.value = ''
    dateTo.value = ''
}

const removeStatusFilter = (status) => {
    const index = selectedStatuses.value.indexOf(status)
    if (index > -1) {
        selectedStatuses.value.splice(index, 1)
    }
}

const clearAllFilters = () => {
    searchQuery.value = ''
    selectedStatuses.value = []
    dateFrom.value = ''
    dateTo.value = ''
    selectedSource.value = ''
    selectedAssignee.value = ''
    companyFilter.value = ''
    durationFilter.value = ''
    showStatusDropdown.value = false
}

// Pagination methods
const goToPage = (page) => {
    currentPage.value = page
}

const nextPage = () => {
    if (currentPage.value < totalPages.value) {
        currentPage.value++
    }
}

const previousPage = () => {
    if (currentPage.value > 1) {
        currentPage.value--
    }
}

// Action methods
const playRecording = (log) => {
    console.log('Playing recording for:', log.leadName)
    alert(`Playing recording for ${log.leadName}`)
}

const deleteLog = (log) => {
    if (confirm(`Are you sure you want to delete the call log for ${log.leadName}?`)) {
        const index = callLogs.value.findIndex(item => item.id === log.id)
        if (index > -1) {
            callLogs.value.splice(index, 1)
        }
    }
}

const viewDetails = (log) => {
    console.log('Viewing details for:', log.leadName)
    alert(`Call details:\n\nLead: ${log.leadName}\nCompany: ${log.company}\nStatus: ${log.status}\nDuration: ${log.duration}\nNotes: ${log.notes}\n\nAI Summary: ${log.aiSummary}`)
}

// Close dropdown when clicking outside
const handleClickOutside = (event) => {
    if (!event.target.closest('.relative')) {
        showStatusDropdown.value = false
    }
}

// Reset to first page when filters change
watch([searchQuery, selectedStatuses, dateFrom, dateTo, selectedSource, selectedAssignee, companyFilter, durationFilter, itemsPerPage], () => {
    currentPage.value = 1
}, { deep: true })

// Generate initial data on mount
onMounted(() => {
    generateCallLogs(50)
    document.addEventListener('click', handleClickOutside)
})

// Cleanup event listener
onUnmounted(() => {
    document.removeEventListener('click', handleClickOutside)
})
</script>
