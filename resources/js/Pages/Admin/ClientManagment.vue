<template>
  <!-- <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 dark:from-gray-900 dark:via-blue-900/20 dark:to-indigo-900/20 transition-all duration-500"> -->
    <div class="">
      <!-- Header Section -->
      <div class="mb-6">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
          <div class="space-y-2">
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold bg-gradient-to-r from-gray-900 via-blue-900 to-indigo-900 bg-clip-text text-transparent">
            Client Management
          </h1>
            <p class="text-gray-600 dark:text-gray-400">
              Manage your clients efficiently
            </p>
            
            <!-- Inline Stats -->
            <div class="flex flex-wrap items-center gap-4 text-sm mt-3">
              <div class="flex items-center gap-2 px-3 py-1.5 bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-lg border border-gray-200/50 dark:border-gray-700/50">
                <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                <span class="font-semibold text-gray-900 dark:text-white">{{ clients.length }}</span>
                <span class="text-gray-600 dark:text-gray-400">Total</span>
              </div>
              <div class="flex items-center gap-2 px-3 py-1.5 bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-lg border border-gray-200/50 dark:border-gray-700/50">
                <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                <span class="font-semibold text-gray-900 dark:text-white">{{ activeClientsCount }}</span>
                <span class="text-gray-600 dark:text-gray-400">Active</span>
              </div>
              <div class="flex items-center gap-2 px-3 py-1.5 bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-lg border border-gray-200/50 dark:border-gray-700/50">
                <div class="w-2 h-2 bg-yellow-500 rounded-full"></div>
                <span class="font-semibold text-gray-900 dark:text-white">{{ trialClientsCount }}</span>
                <span class="text-gray-600 dark:text-gray-400">Trial</span>
              </div>
              <div class="flex items-center gap-2 px-3 py-1.5 bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-lg border border-gray-200/50 dark:border-gray-700/50">
                <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                <span class="font-semibold text-gray-900 dark:text-white">{{ deactivatedClientsCount }}</span>
                <span class="text-gray-600 dark:text-gray-400">Deactivated</span>
              </div>
            </div>
          </div>

          <div class="flex items-center space-x-3">
            <button
              @click="darkMode = !darkMode"
              class="p-2.5 bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm border border-gray-200/50 dark:border-gray-700/50 rounded-lg hover:bg-white dark:hover:bg-gray-800 transition-all duration-200 group"
            >
              <Sun v-if="darkMode" class="h-4 w-4 text-yellow-500 group-hover:rotate-12 transition-transform duration-300" />
              <Moon v-else class="h-4 w-4 text-gray-600 group-hover:-rotate-12 transition-transform duration-300" />
            </button>

            <button @click="showAddClientModal = true" class="px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm hover:shadow-md transition-all duration-200 flex items-center gap-2">
              <Plus class="h-4 w-4" />
              Add Client
            </button>
          </div>
        </div>
      </div>

      <!-- Search and Controls -->
      <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm border border-gray-200/50 dark:border-gray-700/50 rounded-xl shadow-sm mb-6">
        <div class="p-4">
          <!-- Top Row: Search and Controls -->
          <div class="flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between mb-4">
            <!-- Compact Search -->
            <div class="relative flex-1 max-w-md">
              <Search class="absolute left-3 top-1/2 transform -translate-y-1/2 h-4 w-4 text-gray-400" />
              <input
                v-model="searchQuery"
                type="text"
                placeholder="Search clients..."
                class="w-full pl-9 pr-9 py-2.5 text-sm border border-gray-200 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 bg-white/50 dark:bg-gray-700/50 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 transition-all duration-200"
              />
              <button v-if="searchQuery" @click="searchQuery = ''" class="absolute right-2 top-1/2 transform -translate-y-1/2 p-1 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 rounded transition-colors">
                <X class="h-3 w-3" />
              </button>
            </div>

            <!-- Controls -->
            <div class="flex items-center gap-3">
              <!-- Filter Toggle -->
              <button
                @click="showFilters = !showFilters"
                :class="[
                  'px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 flex items-center gap-2',
                  showFilters 
                    ? 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300' 
                    : 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600'
                ]"
              >
                <Filter class="h-4 w-4" />
                Filters
                <ChevronDown :class="['h-3 w-3 transition-transform duration-200', showFilters ? 'rotate-180' : '']" />
              </button>

              <!-- View Toggle -->
              <div class="flex bg-gray-100 dark:bg-gray-700 rounded-lg p-0.5">
                <button
                  @click="viewMode = 'grid'"
                  :class="[
                    'p-2 rounded-md transition-all duration-200',
                    viewMode === 'grid'
                      ? 'bg-white dark:bg-gray-600 text-blue-600 dark:text-blue-400 shadow-sm'
                      : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white'
                  ]"
                >
                  <Grid3X3 class="w-4 h-4" />
                </button>
                <button
                  @click="viewMode = 'table'"
                  :class="[
                    'p-2 rounded-md transition-all duration-200',
                    viewMode === 'table'
                      ? 'bg-white dark:bg-gray-600 text-blue-600 dark:text-blue-400 shadow-sm'
                      : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white'
                  ]"
                >
                  <List class="w-4 h-4" />
                </button>
              </div>
            </div>
          </div>

          <!-- Collapsible Filters -->
          <div v-if="showFilters" class="border-t border-gray-200/50 dark:border-gray-700/50 pt-4 animate-slide-down">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3 mb-4">
              <div>
                <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                <select v-model="statusFilter" class="w-full px-3 py-2 text-sm border border-gray-200 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 bg-white/50 dark:bg-gray-700/50 text-gray-900 dark:text-white">
                  <option value="all">All Status</option>
                  <option value="active">🟢 Active</option>
                  <option value="trial">🟡 Trial</option>
                  <option value="cancelled">🔴 Cancelled</option>
                  <option value="deactivated">⚫ Deactivated</option>
                </select>
              </div>

              <div>
                <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Plan</label>
                <select v-model="planFilter" class="w-full px-3 py-2 text-sm border border-gray-200 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 bg-white/50 dark:bg-gray-700/50 text-gray-900 dark:text-white">
                  <option value="all">All Plans</option>
                  <option value="Starter">💎 Starter</option>
                  <option value="Pro">🚀 Pro</option>
                  <option value="Enterprise">⭐ Enterprise</option>
                </select>
              </div>

              <div>
                <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Visibility</label>
                <select v-model="visibilityFilter" class="w-full px-3 py-2 text-sm border border-gray-200 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 bg-white/50 dark:bg-gray-700/50 text-gray-900 dark:text-white">
                  <option value="all">All Clients</option>
                  <option value="visible">👁️ Visible</option>
                  <option value="deactivated">⚫ Deactivated</option>
                </select>
              </div>

              <div>
                <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Sort By</label>
                <select v-model="sortBy" class="w-full px-3 py-2 text-sm border border-gray-200 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 bg-white/50 dark:bg-gray-700/50 text-gray-900 dark:text-white">
                  <option value="newest">📅 Newest First</option>
                  <option value="oldest">📅 Oldest First</option>
                  <option value="name">🔤 Name A-Z</option>
                  <option value="apiCalls">📊 API Calls High-Low</option>
                </select>
              </div>

              <div class="flex items-end">
                <button @click="clearAllFilters" class="w-full px-3 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors flex items-center justify-center gap-2">
                  <RotateCcw class="h-3 w-3" />
                  Clear
                </button>
              </div>
            </div>

            <!-- Results Summary -->
            <div class="text-sm text-gray-600 dark:text-gray-400">
              <span class="font-medium text-gray-900 dark:text-white">{{ filteredClients.length }}</span>
              {{ filteredClients.length === 1 ? 'client' : 'clients' }} found
            </div>
          </div>
        </div>
      </div>

      <!-- Grid View -->
      <div v-if="viewMode === 'grid'" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mb-6">
        <div
          v-for="client in paginatedClients"
          :key="client.id"
          @click="viewClient(client)"
          class="group bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm border border-gray-200/50 dark:border-gray-700/50 rounded-xl p-4 hover:shadow-lg hover:border-blue-200 dark:hover:border-blue-800 transition-all duration-200 cursor-pointer"
        >
          <div class="flex items-start justify-between mb-3">
            <div class="flex items-center space-x-3">
              <img class="h-10 w-10 rounded-lg object-cover ring-2 ring-gray-100 dark:ring-gray-700" :src="client.avatar" :alt="client.name">
              <div class="min-w-0 flex-1">
                <h3 class="font-semibold text-gray-900 dark:text-white text-sm truncate group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                  {{ client.name }}
                </h3>
                <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ client.email }}</p>
              </div>
            </div>
            <span :class="getStatusBadgeClass(client.status)" class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium">
              <span :class="getStatusDotClass(client.status)" class="w-1.5 h-1.5 rounded-full mr-1.5"></span>
              {{ client.status }}
            </span>
          </div>

          <div class="space-y-2 mb-3">
            <div class="flex items-center justify-between">
              <span :class="getPlanBadgeClass(client.plan)" class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium">
                {{ getPlanIcon(client.plan) }} {{ client.plan }}
              </span>
              <span class="text-xs text-gray-500 dark:text-gray-400">{{ formatDate(client.created_at) }}</span>
            </div>

            <div class="grid grid-cols-2 gap-2 text-xs">
              <div class="bg-gray-50/50 dark:bg-gray-700/50 rounded-lg p-2">
                <div class="text-gray-500 dark:text-gray-400">API Calls</div>
                <div class="font-semibold text-gray-900 dark:text-white">{{ client.apiCalls.toLocaleString() }}</div>
              </div>
              <div class="bg-gray-50/50 dark:bg-gray-700/50 rounded-lg p-2">
                <div class="text-gray-500 dark:text-gray-400">Location</div>
                <div class="font-medium text-gray-900 dark:text-white truncate">{{ client.location }}</div>
              </div>
            </div>
          </div>

          <div class="flex space-x-1 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
            <button
              @click.stop="viewClient(client)"
              class="flex-1 px-2 py-1.5 bg-blue-50 dark:bg-blue-900/20 text-blue-700 dark:text-blue-300 text-xs font-medium rounded-md hover:bg-blue-100 dark:hover:bg-blue-900/30 transition-colors flex items-center justify-center gap-1"
            >
              <Eye class="h-3 w-3" />
              View
            </button>
            <button
              @click.stop="toggleClientStatus(client)"
              class="px-2 py-1.5 bg-gray-50 dark:bg-gray-900/20 text-gray-700 dark:text-gray-300 text-xs font-medium rounded-md hover:bg-gray-100 dark:hover:bg-gray-900/30 transition-colors"
            >
              <Power v-if="client.status !== 'deactivated'" class="h-3 w-3" />
              <PowerOff v-else class="h-3 w-3" />
            </button>
            <button
              @click.stop="suspendClient(client)"
              class="px-2 py-1.5 bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-300 text-xs font-medium rounded-md hover:bg-red-100 dark:hover:bg-red-900/30 transition-colors"
            >
              <UserX class="h-3 w-3" />
            </button>
          </div>
        </div>
      </div>

      <!-- Table View -->
      <div v-else class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm border border-gray-200/50 dark:border-gray-700/50 rounded-xl shadow-sm overflow-hidden mb-6">
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200/50 dark:divide-gray-700/50">
            <thead class="bg-gray-50/80 dark:bg-gray-700/80">
              <tr>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Client</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Plan</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">API Calls</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Location</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Created</th>
                <th class="px-4 py-3 text-right text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
              </tr>
            </thead>
            <tbody class="bg-white/50 dark:bg-gray-800/50 divide-y divide-gray-200/50 dark:divide-gray-700/50">
              <tr v-for="client in paginatedClients" :key="client.id" class="hover:bg-gray-50/80 dark:hover:bg-gray-700/80 transition-colors">
                <td class="px-4 py-3 whitespace-nowrap">
                  <div class="flex items-center">
                    <img class="h-8 w-8 rounded-lg object-cover ring-2 ring-gray-100 dark:ring-gray-700" :src="client.avatar" :alt="client.name">
                    <div class="ml-3">
                      <div class="text-sm font-semibold text-gray-900 dark:text-white">{{ client.name }}</div>
                      <div class="text-xs text-gray-500 dark:text-gray-400">{{ client.email }}</div>
                    </div>
                  </div>
                </td>
                <td class="px-4 py-3 whitespace-nowrap">
                  <span :class="getPlanBadgeClass(client.plan)" class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium">
                    {{ getPlanIcon(client.plan) }} {{ client.plan }}
                  </span>
                </td>
                <td class="px-4 py-3 whitespace-nowrap">
                  <span :class="getStatusBadgeClass(client.status)" class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium">
                    <span :class="getStatusDotClass(client.status)" class="w-1.5 h-1.5 rounded-full mr-1.5"></span>
                    {{ client.status }}
                  </span>
                </td>
                <td class="px-4 py-3 whitespace-nowrap text-sm font-semibold text-gray-900 dark:text-white">
                  {{ client.apiCalls.toLocaleString() }}
                </td>
                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                  {{ client.location }}
                </td>
                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                  {{ formatDate(client.created_at) }}
                </td>
                <td class="px-4 py-3 whitespace-nowrap text-right text-sm font-medium">
                  <div class="flex items-center justify-end space-x-1">
                    <button @click="viewClient(client)" class="p-1.5 bg-blue-50 dark:bg-blue-900/20 text-blue-700 dark:text-blue-300 rounded-md hover:bg-blue-100 dark:hover:bg-blue-900/30 transition-colors">
                      <Eye class="h-3 w-3" />
                    </button>
                    <button @click="toggleClientStatus(client)" class="p-1.5 bg-gray-50 dark:bg-gray-900/20 text-gray-700 dark:text-gray-300 rounded-md hover:bg-gray-100 dark:hover:bg-gray-900/30 transition-colors">
                      <Power v-if="client.status !== 'deactivated'" class="h-3 w-3" />
                      <PowerOff v-else class="h-3 w-3" />
                    </button>
                    <button @click="suspendClient(client)" class="p-1.5 bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-300 rounded-md hover:bg-red-100 dark:hover:bg-red-900/30 transition-colors">
                      <UserX class="h-3 w-3" />
                    </button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Pagination -->
      <div v-if="totalPages > 1" class="flex flex-col sm:flex-row items-center justify-between gap-4 bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm border border-gray-200/50 dark:border-gray-700/50 rounded-xl p-4">
        <div class="text-sm text-gray-700 dark:text-gray-300">
          Showing <span class="font-semibold">{{ startItem }}</span> to <span class="font-semibold">{{ endItem }}</span> of <span class="font-semibold">{{ filteredClients.length }}</span> results
        </div>

        <div class="flex items-center space-x-2">
          <button
            @click="currentPage = currentPage - 1"
            :disabled="currentPage === 1"
            class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-500 dark:text-gray-400 bg-white/80 dark:bg-gray-800/80 border border-gray-200 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200"
          >
            <ChevronLeft class="w-4 h-4 mr-1" />
            Previous
          </button>

          <div class="flex space-x-1">
            <template v-for="(page, index) in paginationButtons" :key="index">
              <div v-if="page === '...'" class="px-3 py-2 text-gray-500 dark:text-gray-400 flex items-center">
                <MoreHorizontal class="h-4 w-4" />
              </div>
              <button
                v-else
                @click="currentPage = page"
                :class="[
                  'px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200',
                  currentPage === page
                    ? 'bg-blue-600 text-white shadow-sm'
                    : 'text-gray-700 dark:text-gray-300 bg-white/80 dark:bg-gray-800/80 border border-gray-200 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700'
                ]"
              >
                {{ page }}
              </button>
            </template>
          </div>

          <button
            @click="currentPage = currentPage + 1"
            :disabled="currentPage === totalPages"
            class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-500 dark:text-gray-400 bg-white/80 dark:bg-gray-800/80 border border-gray-200 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200"
          >
            Next
            <ChevronRight class="w-4 h-4 ml-1" />
          </button>
        </div>
      </div>
    </div>

    <!-- Add Client Modal -->
    <div v-if="showAddClientModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4 z-50">
      <div class="bg-white/95 dark:bg-gray-800/95 backdrop-blur-sm border border-gray-200/50 dark:border-gray-700/50 rounded-2xl shadow-2xl max-w-md w-full">
        <div class="flex items-center justify-between p-6 border-b border-gray-200/50 dark:border-gray-700/50">
          <h2 class="text-xl font-bold text-gray-900 dark:text-white">Add New Client</h2>
          <button @click="showAddClientModal = false" class="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
            <X class="h-5 w-5" />
          </button>
        </div>

        <form @submit.prevent="addClient" class="p-6 space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Client Name</label>
            <input
              v-model="newClient.name"
              type="text"
              required
              class="w-full px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 bg-white/50 dark:bg-gray-700/50 text-gray-900 dark:text-white"
              placeholder="Enter client name"
            />
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email</label>
            <input
              v-model="newClient.email"
              type="email"
              required
              class="w-full px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 bg-white/50 dark:bg-gray-700/50 text-gray-900 dark:text-white"
              placeholder="Enter email address"
            />
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Plan</label>
            <select
              v-model="newClient.plan"
              required
              class="w-full px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 bg-white/50 dark:bg-gray-700/50 text-gray-900 dark:text-white"
            >
              <option value="">Select a plan</option>
              <option value="Starter">💎 Starter</option>
              <option value="Pro">🚀 Pro</option>
              <option value="Enterprise">⭐ Enterprise</option>
            </select>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Location</label>
            <input
              v-model="newClient.location"
              type="text"
              required
              class="w-full px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 bg-white/50 dark:bg-gray-700/50 text-gray-900 dark:text-white"
              placeholder="Enter location"
            />
          </div>

          <div class="flex justify-end space-x-3 pt-4">
            <button
              type="button"
              @click="showAddClientModal = false"
              class="px-4 py-2 text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors font-medium"
            >
              Cancel
            </button>
            <button
              type="submit"
              class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors flex items-center gap-2"
            >
              <Plus class="h-4 w-4" />
              Add Client
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- Client Details Modal -->
    <div v-if="showClientModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4 z-50">
      <div class="bg-white/95 dark:bg-gray-800/95 backdrop-blur-sm border border-gray-200/50 dark:border-gray-700/50 rounded-2xl shadow-2xl max-w-3xl w-full max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between p-6 border-b border-gray-200/50 dark:border-gray-700/50">
          <h2 class="text-xl font-bold text-gray-900 dark:text-white">Client Details</h2>
          <button @click="showClientModal = false" class="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
            <X class="h-5 w-5" />
          </button>
        </div>

        <div class="p-6" v-if="selectedClient">
          <!-- Client Header -->
          <div class="flex items-center space-x-4 mb-6 p-4 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-xl">
            <img class="h-16 w-16 rounded-xl object-cover ring-2 ring-white dark:ring-gray-700" :src="selectedClient.avatar" :alt="selectedClient.name">
            <div class="flex-1">
              <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ selectedClient.name }}</h3>
              <p class="text-gray-600 dark:text-gray-400 mb-2">{{ selectedClient.email }}</p>
              <div class="flex items-center space-x-2">
                <span :class="getPlanBadgeClass(selectedClient.plan)" class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium">
                  {{ getPlanIcon(selectedClient.plan) }} {{ selectedClient.plan }}
                </span>
                <span :class="getStatusBadgeClass(selectedClient.status)" class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium">
                  <span :class="getStatusDotClass(selectedClient.status)" class="w-1.5 h-1.5 rounded-full mr-1.5"></span>
                  {{ selectedClient.status }}
                </span>
              </div>
            </div>
          </div>

          <!-- Stats Grid -->
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-blue-50 dark:bg-blue-900/20 rounded-xl p-4 border border-blue-200/50 dark:border-blue-800/50">
              <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ selectedClient.apiCalls.toLocaleString() }}</div>
              <div class="text-blue-600/70 dark:text-blue-400/70 text-sm font-medium">API Calls</div>
            </div>
            <div class="bg-purple-50 dark:bg-purple-900/20 rounded-xl p-4 border border-purple-200/50 dark:border-purple-800/50">
              <div class="text-2xl font-bold text-purple-600 dark:text-purple-400">{{ formatDate(selectedClient.created_at) }}</div>
              <div class="text-purple-600/70 dark:text-purple-400/70 text-sm font-medium">Member Since</div>
            </div>
            <div class="bg-green-50 dark:bg-green-900/20 rounded-xl p-4 border border-green-200/50 dark:border-green-800/50">
              <div class="text-lg font-bold text-green-600 dark:text-green-400">{{ selectedClient.location }}</div>
              <div class="text-green-600/70 dark:text-green-400/70 text-sm font-medium">Location</div>
            </div>
          </div>

          <!-- Details Grid -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="space-y-4">
              <h4 class="text-lg font-semibold text-gray-900 dark:text-white">Account Information</h4>
              <div class="space-y-3">
                <div class="flex justify-between py-2 border-b border-gray-200 dark:border-gray-700">
                  <span class="text-gray-500 dark:text-gray-400">Account Type</span>
                  <span class="text-gray-900 dark:text-white font-medium">Business</span>
                </div>
                <div class="flex justify-between py-2 border-b border-gray-200 dark:border-gray-700">
                  <span class="text-gray-500 dark:text-gray-400">Time Zone</span>
                  <span class="text-gray-900 dark:text-white font-medium">UTC-8 (PST)</span>
                </div>
              </div>
            </div>

            <div class="space-y-4">
              <h4 class="text-lg font-semibold text-gray-900 dark:text-white">Usage Statistics</h4>
              <div class="space-y-3">
                <div class="flex justify-between py-2 border-b border-gray-200 dark:border-gray-700">
                  <span class="text-gray-500 dark:text-gray-400">Monthly Usage</span>
                  <span class="text-gray-900 dark:text-white font-medium">
                    {{ (selectedClient.apiCalls * 0.1).toLocaleString() }}
                  </span>
                </div>
                <div class="flex justify-between py-2 border-b border-gray-200 dark:border-gray-700">
                  <span class="text-gray-500 dark:text-gray-400">Support Tickets</span>
                  <span class="text-gray-900 dark:text-white font-medium">3 Open</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Action Buttons -->
          <div class="flex justify-end space-x-3">
            <button @click="showClientModal = false" class="px-4 py-2 text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors font-medium">
              Close
            </button>
            <button class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors flex items-center gap-2">
              <Settings class="h-4 w-4" />
              Edit Client
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Suspend Modal -->
    <div v-if="showSuspendModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4 z-50">
      <div class="bg-white/95 dark:bg-gray-800/95 backdrop-blur-sm border border-gray-200/50 dark:border-gray-700/50 rounded-2xl shadow-2xl max-w-md w-full">
        <div class="p-6">
          <div class="flex items-center mb-4">
            <div class="flex-shrink-0">
              <div class="w-12 h-12 bg-red-100 dark:bg-red-900/30 rounded-xl flex items-center justify-center">
                <AlertTriangle class="h-6 w-6 text-red-600 dark:text-red-400" />
              </div>
            </div>
            <div class="ml-4">
              <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Suspend Client</h3>
              <p class="text-sm text-gray-500 dark:text-gray-400">This action will disable their access</p>
            </div>
          </div>

          <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/20 rounded-xl border border-red-200 dark:border-red-800">
            <p class="text-sm text-gray-700 dark:text-gray-300">
              Are you sure you want to suspend <strong class="text-gray-900 dark:text-white">{{ clientToSuspend?.name }}</strong>?
              This will immediately disable their access to the platform.
            </p>
          </div>

          <div class="flex justify-end space-x-3">
            <button
              @click="showSuspendModal = false"
              class="px-4 py-2 text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors font-medium"
            >
              Cancel
            </button>
            <button
              @click="confirmSuspend"
              class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors"
            >
              Suspend Client
            </button>
          </div>
        </div>
      </div>
    </div>
  <!-- </div> -->
</template>

<script setup>
import { ref, computed, watch, onMounted } from 'vue'
import {
  Search,
  Grid3X3,
  List,
  UserCheck,
  Clock,
  UserX,
  Eye,
  EyeOff,
  ChevronLeft,
  ChevronRight,
  ChevronDown,
  X,
  AlertTriangle,
  Settings,
  Moon,
  Sun,
  Plus,
  Filter,
  MoreHorizontal,
  RotateCcw,
  Power,
  PowerOff,
} from 'lucide-vue-next'
import LayoutAdmins from '@/Layouts/LayoutAdmins.vue';
defineOptions({layout : LayoutAdmins})


// State
const darkMode = ref(false)
const viewMode = ref('grid')
const searchQuery = ref('')
const statusFilter = ref('all')
const planFilter = ref('all')
const visibilityFilter = ref('all')
const sortBy = ref('newest')
const dateRange = ref('all')
const currentPage = ref(1)
const itemsPerPage = ref(12)
const showClientModal = ref(false)
const showSuspendModal = ref(false)
const showAddClientModal = ref(false)
const showFilters = ref(false)
const selectedClient = ref(null)
const clientToSuspend = ref(null)

// New client form data
const newClient = ref({
  name: '',
  email: '',
  plan: '',
  location: ''
})

// Sample data
const clients = ref([
  {
    id: 1,
    name: "Acme Corporation",
    email: "hello@acme.io",
    plan: "Enterprise",
    status: "active",
    created_at: "2025-06-20",
    avatar: "/placeholder.svg?height=40&width=40&text=AC",
    apiCalls: 15420,
    location: "San Francisco, CA",
  },
  {
    id: 2,
    name: "NovaTech Solutions",
    email: "support@novatech.com",
    plan: "Pro",
    status: "trial",
    created_at: "2025-07-01",
    avatar: "/placeholder.svg?height=40&width=40&text=NT",
    apiCalls: 8750,
    location: "New York, NY",
  },
  {
    id: 3,
    name: "ZeroPoint Labs",
    email: "admin@zeropoint.io",
    plan: "Starter",
    status: "cancelled",
    created_at: "2025-05-15",
    avatar: "/placeholder.svg?height=40&width=40&text=ZP",
    apiCalls: 3200,
    location: "Austin, TX",
  },
  {
    id: 4,
    name: "Orbit AI Systems",
    email: "ceo@orbit.ai",
    plan: "Enterprise",
    status: "deactivated",
    created_at: "2025-07-10",
    avatar: "/placeholder.svg?height=40&width=40&text=OA",
    apiCalls: 22100,
    location: "Seattle, WA",
  },
  {
    id: 5,
    name: "Synapse Inc.",
    email: "team@synapse.inc",
    plan: "Pro",
    status: "active",
    created_at: "2025-06-01",
    avatar: "/placeholder.svg?height=40&width=40&text=SI",
    apiCalls: 12300,
    location: "Boston, MA",
  },
  {
    id: 6,
    name: "DataFlow Systems",
    email: "contact@dataflow.com",
    plan: "Starter",
    status: "trial",
    created_at: "2025-07-15",
    avatar: "/placeholder.svg?height=40&width=40&text=DF",
    apiCalls: 1850,
    location: "Denver, CO",
  },
  {
    id: 7,
    name: "CloudVision",
    email: "info@cloudvision.net",
    plan: "Pro",
    status: "active",
    created_at: "2025-06-10",
    avatar: "/placeholder.svg?height=40&width=40&text=CV",
    apiCalls: 14600,
    location: "Los Angeles, CA",
  },
  {
    id: 8,
    name: "TechForward",
    email: "hello@techforward.io",
    plan: "Enterprise",
    status: "deactivated",
    created_at: "2025-05-20",
    avatar: "/placeholder.svg?height=40&width=40&text=TF",
    apiCalls: 18900,
    location: "Chicago, IL",
  },
  {
    id: 9,
    name: "InnovateLab",
    email: "contact@innovatelab.com",
    plan: "Pro",
    status: "active",
    created_at: "2025-06-25",
    avatar: "/placeholder.svg?height=40&width=40&text=IL",
    apiCalls: 9800,
    location: "Miami, FL",
  },
  {
    id: 10,
    name: "FutureScope AI",
    email: "info@futurescope.ai",
    plan: "Starter",
    status: "trial",
    created_at: "2025-07-20",
    avatar: "/placeholder.svg?height=40&width=40&text=FS",
    apiCalls: 2100,
    location: "Portland, OR",
  },
  {
    id: 11,
    name: "Quantum Dynamics",
    email: "admin@quantumdyn.com",
    plan: "Enterprise",
    status: "active",
    created_at: "2025-05-30",
    avatar: "/placeholder.svg?height=40&width=40&text=QD",
    apiCalls: 28500,
    location: "Palo Alto, CA",
  },
  {
    id: 12,
    name: "Neural Networks Co",
    email: "support@neuralnet.co",
    plan: "Pro",
    status: "active",
    created_at: "2025-06-15",
    avatar: "/placeholder.svg?height=40&width=40&text=NN",
    apiCalls: 13700,
    location: "Nashville, TN",
  },
  {
    id: 13,
    name: "Digital Forge",
    email: "team@digitalforge.io",
    plan: "Starter",
    status: "deactivated",
    created_at: "2025-07-05",
    avatar: "/placeholder.svg?height=40&width=40&text=DF",
    apiCalls: 5600,
    location: "Phoenix, AZ",
  },
  {
    id: 14,
    name: "CloudSync Pro",
    email: "hello@cloudsync.pro",
    plan: "Enterprise",
    status: "trial",
    created_at: "2025-06-30",
    avatar: "/placeholder.svg?height=40&width=40&text=CS",
    apiCalls: 19200,
    location: "Dallas, TX",
  },
  {
    id: 15,
    name: "TechVision Labs",
    email: "info@techvision.labs",
    plan: "Pro",
    status: "cancelled",
    created_at: "2025-05-10",
    avatar: "/placeholder.svg?height=40&width=40&text=TV",
    apiCalls: 7800,
    location: "Atlanta, GA",
  },
])

// Computed properties
const filteredClients = computed(() => {
  let filtered = clients.value.filter(client => {
    const matchesSearch = !searchQuery.value ||
      client.name.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
      client.email.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
      client.location.toLowerCase().includes(searchQuery.value.toLowerCase())

    const matchesStatus = statusFilter.value === 'all' || client.status === statusFilter.value
    const matchesPlan = planFilter.value === 'all' || client.plan === planFilter.value

    const matchesVisibility =
      visibilityFilter.value === 'all' ||
      (visibilityFilter.value === 'visible' && client.status !== 'deactivated') ||
      (visibilityFilter.value === 'deactivated' && client.status === 'deactivated')

    let matchesDateRange = true
    if (dateRange.value !== 'all') {
      const clientDate = new Date(client.created_at)
      const now = new Date()
      const daysAgo = {
        '7d': 7,
        '30d': 30,
        '90d': 90
      }[dateRange.value]

      if (daysAgo) {
        const cutoffDate = new Date(now.getTime() - (daysAgo * 24 * 60 * 60 * 1000))
        matchesDateRange = clientDate >= cutoffDate
      }
    }

    return matchesSearch && matchesStatus && matchesPlan && matchesVisibility && matchesDateRange
  })

  // Apply sorting
  if (sortBy.value === 'newest') {
    filtered.sort((a, b) => new Date(b.created_at) - new Date(a.created_at))
  } else if (sortBy.value === 'oldest') {
    filtered.sort((a, b) => new Date(a.created_at) - new Date(b.created_at))
  } else if (sortBy.value === 'name') {
    filtered.sort((a, b) => a.name.localeCompare(b.name))
  } else if (sortBy.value === 'apiCalls') {
    filtered.sort((a, b) => b.apiCalls - a.apiCalls)
  }

  return filtered
})

const totalPages = computed(() => {
  return Math.ceil(filteredClients.value.length / itemsPerPage.value)
})

const paginatedClients = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage.value
  const end = start + itemsPerPage.value
  return filteredClients.value.slice(start, end)
})

const activeClientsCount = computed(() => {
  return clients.value.filter(client => client.status === 'active').length
})

const trialClientsCount = computed(() => {
  return clients.value.filter(client => client.status === 'trial').length
})

const deactivatedClientsCount = computed(() => {
  return clients.value.filter(client => client.status === 'deactivated').length
})

const startItem = computed(() => (currentPage.value - 1) * itemsPerPage.value + 1)
const endItem = computed(() => Math.min(currentPage.value * itemsPerPage.value, filteredClients.value.length))

const paginationButtons = computed(() => {
  const buttons = []
  const maxVisible = 5
  let startPage = Math.max(1, currentPage.value - Math.floor(maxVisible / 2))
  const endPage = Math.min(totalPages.value, startPage + maxVisible - 1)

  if (endPage - startPage + 1 < maxVisible) {
    startPage = Math.max(1, endPage - maxVisible + 1)
  }

  // Add first page and ellipsis if needed
  if (startPage > 1) {
    buttons.push(1)
    if (startPage > 2) {
      buttons.push('...')
    }
  }

  // Add visible pages
  for (let i = startPage; i <= endPage; i++) {
    buttons.push(i)
  }

  // Add ellipsis and last page if needed
  if (endPage < totalPages.value) {
    if (endPage < totalPages.value - 1) {
      buttons.push('...')
    }
    buttons.push(totalPages.value)
  }

  return buttons
})

// Methods
const addClient = () => {
  const clientInitials = newClient.value.name
    .split(' ')
    .map(word => word[0])
    .join('')
    .toUpperCase()

  const client = {
    id: Date.now(),
    name: newClient.value.name,
    email: newClient.value.email,
    plan: newClient.value.plan,
    status: 'active',
    created_at: new Date().toISOString().split('T')[0],
    avatar: `/placeholder.svg?height=40&width=40&text=${clientInitials}`,
    apiCalls: 0,
    location: newClient.value.location,
  }

  clients.value.unshift(client)
  
  // Reset form
  newClient.value = {
    name: '',
    email: '',
    plan: '',
    location: ''
  }
  
  showAddClientModal.value = false
}

const viewClient = (client) => {
  selectedClient.value = client
  showClientModal.value = true
}

const suspendClient = (client) => {
  clientToSuspend.value = client
  showSuspendModal.value = true
}

const toggleClientStatus = (client) => {
  const clientIndex = clients.value.findIndex(c => c.id === client.id)
  if (clientIndex !== -1) {
    clients.value[clientIndex].status = clients.value[clientIndex].status === 'deactivated' ? 'active' : 'deactivated'
  }
}

const confirmSuspend = () => {
  if (clientToSuspend.value) {
    const clientIndex = clients.value.findIndex(c => c.id === clientToSuspend.value.id)
    if (clientIndex !== -1) {
      clients.value[clientIndex].status = 'cancelled'
    }
  }
  showSuspendModal.value = false
  clientToSuspend.value = null
}

const clearAllFilters = () => {
  searchQuery.value = ''
  statusFilter.value = 'all'
  planFilter.value = 'all'
  visibilityFilter.value = 'all'
  sortBy.value = 'newest'
  dateRange.value = 'all'
  currentPage.value = 1
}

const getStatusBadgeClass = (status) => {
  const classes = {
    active: 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300',
    trial: 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300',
    cancelled: 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300',
    deactivated: 'bg-gray-100 text-gray-800 dark:bg-gray-900/30 dark:text-gray-300'
  }
  return classes[status] || 'bg-gray-100 text-gray-800 dark:bg-gray-900/30 dark:text-gray-300'
}

const getStatusDotClass = (status) => {
  const classes = {
    active: 'bg-green-500',
    trial: 'bg-yellow-500',
    cancelled: 'bg-red-500',
    deactivated: 'bg-gray-500'
  }
  return classes[status] || 'bg-gray-500'
}

const getPlanBadgeClass = (plan) => {
  const classes = {
    Starter: 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300',
    Pro: 'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-300',
    Enterprise: 'bg-indigo-100 text-indigo-800 dark:bg-indigo-900/30 dark:text-indigo-300'
  }
  return classes[plan] || 'bg-gray-100 text-gray-800 dark:bg-gray-900/30 dark:text-gray-300'
}

const getPlanIcon = (plan) => {
  const icons = {
    Starter: '💎',
    Pro: '🚀',
    Enterprise: '⭐'
  }
  return icons[plan] || '📦'
}

const formatDate = (dateString) => {
  return new Date(dateString).toLocaleDateString('en-US', {
    month: 'short',
    day: 'numeric',
    year: 'numeric'
  })
}

// Watchers
watch(darkMode, (newValue) => {
  if (newValue) {
    document.documentElement.classList.add('dark')
  } else {
    document.documentElement.classList.remove('dark')
  }
})

watch([searchQuery, statusFilter, planFilter, visibilityFilter, sortBy, dateRange], () => {
  currentPage.value = 1
})

onMounted(() => {
  if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
    darkMode.value = true
  }
})
</script>

<style scoped>
@keyframes slide-down {
  from {
    opacity: 0;
    transform: translateY(-10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.animate-slide-down {
  animation: slide-down 0.2s ease-out;
}

/* Custom scrollbar */
::-webkit-scrollbar {
  width: 6px;
}

::-webkit-scrollbar-track {
  background: transparent;
}

::-webkit-scrollbar-thumb {
  background: #cbd5e1;
  border-radius: 3px;
}

.dark ::-webkit-scrollbar-thumb {
  background: #475569;
}

/* Smooth transitions */
* {
  transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter;
  transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
  transition-duration: 200ms;
}
</style>