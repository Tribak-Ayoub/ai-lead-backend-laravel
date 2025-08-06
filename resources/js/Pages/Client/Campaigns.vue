<template>

  <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50/30 to-indigo-50/20">
    <div class="p-4 sm:p-6 lg:p-8 max-w-[1400px] mx-auto">
      <!-- Ultra Modern Header -->
      <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between mb-8 gap-6">
        <div class="space-y-2">
          <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold bg-gradient-to-r from-gray-900 via-blue-900 to-indigo-900 bg-clip-text text-transparent">
            Campaigns
          </h1>
          <p class="text-gray-600 text-sm sm:text-base lg:text-lg font-medium">
            Manage and track your marketing campaigns with precision
          </p>
        </div>
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
          <!-- Import/Export Buttons -->
          <div class="flex gap-2">
            <button
              @click="handleImport"
              class="group relative overflow-hidden flex-1 sm:flex-none inline-flex items-center justify-center px-4 py-2.5 h-11 text-emerald-700 bg-white border border-emerald-200 hover:border-emerald-300 rounded-xl shadow-sm hover:shadow-md transition-all duration-300 text-sm font-semibold backdrop-blur-sm"
            >
              <div class="absolute inset-0 bg-gradient-to-r from-emerald-50 to-green-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
              <UploadIcon class="h-4 w-4 mr-2 relative z-10 group-hover:scale-110 transition-transform duration-200" />
              <span class="relative z-10">Import</span>
            </button>
            <button
              @click="handleExport"
              class="group relative overflow-hidden flex-1 sm:flex-none inline-flex items-center justify-center px-4 py-2.5 h-11 text-blue-700 bg-white border border-blue-200 hover:border-blue-300 rounded-xl shadow-sm hover:shadow-md transition-all duration-300 text-sm font-semibold backdrop-blur-sm"
            >
              <div class="absolute inset-0 bg-gradient-to-r from-blue-50 to-indigo-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
              <DownloadIcon class="h-4 w-4 mr-2 relative z-10 group-hover:scale-110 transition-transform duration-200" />
              <span class="relative z-10">Export</span>
            </button>
          </div>
          <!-- New Campaign Button -->
          <button
            @click="openModal"
            class="group relative overflow-hidden inline-flex items-center justify-center px-6 py-2.5 h-11 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 text-sm backdrop-blur-sm"
          >
            <div class="absolute inset-0 bg-gradient-to-r from-white/20 to-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <PlusIcon class="h-4 w-4 mr-2 group-hover:rotate-90 transition-transform duration-300" />
            <span>New Campaign</span>
          </button>
        </div>
      </div>

      <!-- Ultra Modern Search & Filters -->
      <div class="mb-8">
        <!-- Main Filter Bar -->
        <div class="bg-white/80 backdrop-blur-xl border border-white/20 rounded-2xl shadow-xl shadow-blue-500/5 p-4 sm:p-6">
          <div class="flex flex-col lg:flex-row lg:items-center gap-4">
            <!-- Search Section -->
            <div class="flex-1 max-w-2xl">
              <div class="relative group">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-500/20 to-indigo-500/20 rounded-xl opacity-0 group-focus-within:opacity-100 transition-opacity duration-300 blur-sm"></div>
                <div class="relative bg-gray-50/50 border border-gray-200/50 rounded-xl focus-within:border-blue-400/50 focus-within:bg-white transition-all duration-300">
                  <SearchIcon class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 h-5 w-5 group-focus-within:text-blue-500 transition-colors duration-200" />
                  <input
                    type="text"
                    placeholder="Search campaigns..."
                    v-model="filters.search"
                    class="w-full pl-12 pr-4 py-3.5 bg-transparent text-gray-900 placeholder-gray-500 focus:outline-none text-sm sm:text-base font-medium"
                  />
                </div>
              </div>
            </div>

            <!-- Filter Controls -->
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
              <!-- Active Filters Preview -->
              <div v-if="!isExpanded && getActiveFiltersCount() > 1" class="flex flex-wrap gap-2">
                <span v-if="filters.name" class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-medium bg-blue-100 text-blue-800 border border-blue-200">
                  Name: {{ filters.name.length > 8 ? filters.name.substring(0, 8) + '...' : filters.name }}
                  <XIcon
                    class="h-3 w-3 ml-2 cursor-pointer hover:text-red-600 transition-colors duration-150"
                    @click="updateFilter('name', '')"
                  />
                </span>
                <span v-if="filters.status" class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                  {{ filters.status }}
                  <XIcon
                    class="h-3 w-3 ml-2 cursor-pointer hover:text-red-600 transition-colors duration-150"
                    @click="updateFilter('status', '')"
                  />
                </span>
              </div>

              <!-- Action Buttons -->
              <div class="flex gap-2">
                <button
                  v-if="getActiveFiltersCount() > 0"
                  @click="clearFilters"
                  class="inline-flex items-center px-4 py-2.5 text-gray-600 hover:text-gray-900 bg-gray-100/50 hover:bg-gray-200/50 rounded-xl text-sm font-medium transition-all duration-200 backdrop-blur-sm"
                >
                  <RotateCcwIcon class="h-4 w-4 mr-2" />
                  Clear
                </button>

                <button
                  @click="isExpanded = !isExpanded"
                  class="inline-flex  px-4 py-2.5 text-gray-700 hover:text-gray-900 bg-gray-100/50 hover:bg-gray-200/50 rounded-xl text-sm font-medium transition-all duration-200 backdrop-blur-sm"
                >
                  <FilterIcon class="h-4 w-4 mr-2" />
                  <span class="hidden sm:inline">Filters</span>
                  <span v-if="getActiveFiltersCount() > 1" class="ml-2 bg-blue-500 text-white text-xs px-2 py-0.5 rounded-full">
                    {{ getActiveFiltersCount() - 1 }}
                  </span>
                  <ChevronUpIcon v-if="isExpanded" class="h-4 w-4 ml-2 transition-transform duration-200" />
                  <ChevronDownIcon v-else class="h-4 w-4 ml-2 transition-transform duration-200" />
                </button>
              </div>
            </div>
          </div>

          <!-- Expanded Filters Panel -->
          <transition
            enter-active-class="transition-all duration-300 ease-out"
            enter-from-class="opacity-0 max-h-0"
            enter-to-class="opacity-100 max-h-96"
            leave-active-class="transition-all duration-200 ease-in"
            leave-from-class="opacity-100 max-h-96"
            leave-to-class="opacity-0 max-h-0"
          >
            <div v-if="isExpanded" class="mt-6 pt-6 border-t border-gray-200/50 overflow-hidden">
              <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4">
                <!-- Name Filter -->
                <div class="space-y-2">
                  <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider">Campaign Name</label>
                  <input
                    type="text"
                    placeholder="Filter by name..."
                    v-model="filters.name"
                    class="w-full px-3 py-2.5 text-sm bg-gray-50/50 border border-gray-200/50 rounded-lg focus:border-blue-400 focus:bg-white focus:ring-2 focus:ring-blue-400/20 outline-none transition-all duration-200"
                  />
                </div>

                <!-- Status Filter -->
                <div class="space-y-2">
                  <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</label>
                  <select
                    v-model="filters.status"
                    class="w-full px-3 py-2.5 text-sm bg-gray-50/50 border border-gray-200/50 rounded-lg focus:border-blue-400 focus:bg-white focus:ring-2 focus:ring-blue-400/20 outline-none transition-all duration-200"
                  >
                    <option value="">All statuses</option>
                    <option value="live">Live</option>
                    <option value="paused">Paused</option>
                  </select>
                </div>

                <!-- Phone Filter -->
                <div class="space-y-2">
                  <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider">Phone Number</label>
                  <input
                    type="text"
                    placeholder="Filter by phone..."
                    v-model="filters.phone"
                    class="w-full px-3 py-2.5 text-sm bg-gray-50/50 border border-gray-200/50 rounded-lg focus:border-blue-400 focus:bg-white focus:ring-2 focus:ring-blue-400/20 outline-none transition-all duration-200"
                  />
                </div>

                <!-- Conversion Rate Filter -->
                <div class="space-y-2">
                  <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider">Min Conversion (%)</label>
                  <input
                    type="number"
                    min="0"
                    max="100"
                    placeholder="0"
                    v-model.number="filters.minConversionRate"
                    class="w-full px-3 py-2.5 text-sm bg-gray-50/50 border border-gray-200/50 rounded-lg focus:border-blue-400 focus:bg-white focus:ring-2 focus:ring-blue-400/20 outline-none transition-all duration-200"
                  />
                </div>

                <!-- Leads Qualified Filter -->
                <div class="space-y-2">
                  <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider">Min Leads</label>
                  <input
                    type="number"
                    min="0"
                    placeholder="0"
                    v-model.number="filters.minLeadsQualified"
                    class="w-full px-3 py-2.5 text-sm bg-gray-50/50 border border-gray-200/50 rounded-lg focus:border-blue-400 focus:bg-white focus:ring-2 focus:ring-blue-400/20 outline-none transition-all duration-200"
                  />
                </div>
              </div>

              <!-- Filter Actions -->
              <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mt-6 pt-4 border-t border-gray-200/50 gap-4">
                <div class="text-sm text-gray-600 font-medium">
                  <span v-if="getActiveFiltersCount() > 0">
                    <span class="text-blue-600 font-semibold">{{ getActiveFiltersCount() }}</span> filter{{ getActiveFiltersCount() !== 1 ? 's' : '' }} applied
                  </span>
                  <span v-else>No filters applied</span>
                </div>

                <div class="flex gap-3">
                  <button
                    @click="clearFilters"
                    :disabled="getActiveFiltersCount() === 0"
                    class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 bg-gray-100/50 hover:bg-gray-200/50 rounded-lg transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
                  >
                    <RotateCcwIcon class="h-4 w-4 mr-2 inline" />
                    Clear filters
                  </button>
                  <button
                    @click="isExpanded = false"
                    class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 bg-gray-100/50 hover:bg-gray-200/50 rounded-lg transition-all duration-200"
                  >
                    <ChevronUpIcon class="h-4 w-4 mr-2 inline" />
                    Hide
                  </button>
                </div>
              </div>
            </div>
          </transition>
        </div>
      </div>

      <!-- Ultra Modern Table -->
      <div class="bg-white/80 backdrop-blur-xl border border-white/20 rounded-2xl shadow-xl shadow-blue-500/5 overflow-hidden">
        <!-- Mobile Cards View -->
        <div class="block lg:hidden">
          <div class="p-4 space-y-4">
            <div
              v-for="campaign in paginatedCampaigns"
              :key="campaign.id"
              class="bg-gradient-to-r from-white to-gray-50/50 border border-gray-200/50 rounded-xl p-4 hover:shadow-lg transition-all duration-300"
            >
              <div class="flex items-start justify-between mb-3">
                <div class="flex-1">
                  <h3 class="font-semibold text-gray-900 text-sm mb-1">{{ campaign.name }}</h3>
                  <p class="text-xs text-gray-600 font-mono">{{ campaign.phone }}</p>
                </div>
                <span
                  :class="campaign.status === 'live'
                    ? 'bg-emerald-100 text-emerald-800 border-emerald-200'
                    : 'bg-gray-100 text-gray-800 border-gray-200'"
                  class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium border"
                >
                  <span
                    :class="campaign.status === 'live' ? 'bg-emerald-400' : 'bg-gray-400'"
                    class="w-1.5 h-1.5 rounded-full mr-1.5"
                  ></span>
                  {{ campaign.status === 'live' ? 'Live' : 'Paused' }}
                </span>
              </div>

              <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                  <p class="text-xs text-gray-500 font-medium">Conversion Rate</p>
                  <p class="text-sm font-semibold text-gray-900">{{ campaign.conversionRate }}%</p>
                </div>
                <div>
                  <p class="text-xs text-gray-500 font-medium">Leads Qualified</p>
                  <p class="text-sm font-semibold text-gray-900">{{ campaign.leadsQualified }}</p>
                </div>
              </div>

              <div class="flex justify-end space-x-2">
                <button
                  @click="editCampaign(campaign)"
                  class="p-2 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-lg transition-all duration-200"
                >
                  <EditIcon class="h-4 w-4" />
                </button>
                <button
                  @click="viewCampaign(campaign)"
                  class="p-2 text-gray-600 hover:text-gray-800 hover:bg-gray-100 rounded-lg transition-all duration-200"
                >
                  <EyeIcon class="h-4 w-4" />
                </button>
                <button
                  @click="deleteCampaign(campaign.id)"
                  class="p-2 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg transition-all duration-200"
                >
                  <Trash2Icon class="h-4 w-4" />
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Desktop Table View -->
        <div class="hidden lg:block overflow-x-auto">
          <table class="min-w-full">
            <thead class="bg-gradient-to-r from-gray-50 to-blue-50/30 border-b border-gray-200/50">
              <tr>
                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Name</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Status</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Phone</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Conversion Rate</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Leads Qualified</th>
                <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Actions</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200/50">
              <tr
                v-for="campaign in paginatedCampaigns"
                :key="campaign.id"
                class="hover:bg-gradient-to-r hover:from-blue-50/30 hover:to-indigo-50/20 transition-all duration-300 group"
              >
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="font-semibold text-gray-900 group-hover:text-blue-900 transition-colors duration-200">{{ campaign.name }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span
                    :class="campaign.status === 'live'
                      ? 'bg-emerald-100 text-emerald-800 border-emerald-200'
                      : 'bg-gray-100 text-gray-800 border-gray-200'"
                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold border shadow-sm"
                  >
                    <span
                      :class="campaign.status === 'live' ? 'bg-emerald-400' : 'bg-gray-400'"
                      class="w-2 h-2 rounded-full mr-2 animate-pulse"
                    ></span>
                    {{ campaign.status === 'live' ? 'Live' : 'Paused' }}
                  </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900 font-mono bg-gray-50 px-2 py-1 rounded">{{ campaign.phone }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm font-bold text-gray-900">{{ campaign.conversionRate }}%</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm font-bold text-gray-900">{{ campaign.leadsQualified }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center">
                  <div class="flex items-center justify-center space-x-2">
                    <button
                      @click="editCampaign(campaign)"
                      class="p-2 text-blue-600 hover:text-blue-800 hover:bg-blue-100 rounded-lg transition-all duration-200 hover:scale-110"
                      title="Edit campaign"
                    >
                      <EditIcon class="h-4 w-4" />
                    </button>
                    <button
                      @click="viewCampaign(campaign)"
                      class="p-2 text-gray-600 hover:text-gray-800 hover:bg-gray-100 rounded-lg transition-all duration-200 hover:scale-110"
                      title="View campaign"
                    >
                      <EyeIcon class="h-4 w-4" />
                    </button>
                    <button
                      @click="deleteCampaign(campaign.id)"
                      class="p-2 text-red-600 hover:text-red-800 hover:bg-red-100 rounded-lg transition-all duration-200 hover:scale-110"
                      title="Delete campaign"
                    >
                      <Trash2Icon class="h-4 w-4" />
                    </button>
                  </div>
                </td>
              </tr>
              <tr v-if="paginatedCampaigns.length === 0">
                <td colspan="6" class="text-center py-16 text-gray-500">
                  <div class="flex flex-col items-center">
                    <div class="text-gray-300 mb-4">
                      <SearchIcon class="h-16 w-16" />
                    </div>
                    <p class="text-lg font-semibold mb-2">No campaigns found</p>
                    <p class="text-sm text-gray-400">Try adjusting your search or filters</p>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Ultra Modern Pagination -->
      <div v-if="totalPages > 1" class="flex flex-col sm:flex-row sm:items-center sm:justify-between mt-8 gap-4">
        <!-- Results Info -->
        <div class="text-sm text-gray-600 font-medium">
          Showing <span class="font-bold text-gray-900">{{ startItem }}</span> to <span class="font-bold text-gray-900">{{ endItem }}</span> of
          <span class="font-bold text-blue-600">{{ filteredCampaigns.length }}</span> results
        </div>

        <!-- Pagination Controls -->
        <div class="flex items-center justify-center sm:justify-end space-x-2">
          <!-- Previous Button -->
          <button
            @click="currentPage = currentPage - 1"
            :disabled="currentPage === 1"
            class="p-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200 shadow-sm hover:shadow-md"
          >
            <ChevronLeftIcon class="h-5 w-5" />
          </button>

          <!-- Page Numbers -->
          <template v-for="(page, index) in getVisiblePages()" :key="index">
            <div v-if="page === '...'" class="flex items-center justify-center px-3 py-2">
              <MoreHorizontalIcon class="h-5 w-5 text-gray-400" />
            </div>
            <button
              v-else
              @click="currentPage = page"
              :class="currentPage === page
                ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-lg'
                : 'bg-white hover:bg-gray-50 border border-gray-300 text-gray-700 shadow-sm hover:shadow-md'"
              class="px-4 py-2 rounded-lg transition-all duration-200 font-semibold text-sm min-w-[40px]"
            >
              {{ page }}
            </button>
          </template>

          <!-- Next Button -->
          <button
            @click="currentPage = currentPage + 1"
            :disabled="currentPage === totalPages"
            class="p-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200 shadow-sm hover:shadow-md"
          >
            <ChevronRightIcon class="h-5 w-5" />
          </button>
        </div>
      </div>

      <!-- Ultra Modern Modal -->
      <transition
        enter-active-class="transition-all duration-300 ease-out"
        enter-from-class="opacity-0 scale-95"
        enter-to-class="opacity-100 scale-100"
        leave-active-class="transition-all duration-200 ease-in"
        leave-from-class="opacity-100 scale-100"
        leave-to-class="opacity-0 scale-95"
      >
        <div v-if="showModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4 z-50" @click="closeModal">
          <div class="bg-white/95 backdrop-blur-xl border border-white/20 rounded-2xl shadow-2xl max-w-md w-full max-h-[90vh] overflow-y-auto" @click.stop>
            <div class="p-6 sm:p-8">
              <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl font-bold bg-gradient-to-r from-gray-900 to-blue-900 bg-clip-text text-transparent">
                  {{ isEditing ? 'Edit Campaign' : 'New Campaign' }}
                </h2>
                <button @click="closeModal" class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-all duration-200">
                  <XIcon class="h-6 w-6" />
                </button>
              </div>

              <form @submit.prevent="handleSubmit" class="space-y-6">
                <!-- Campaign Name -->
                <div class="space-y-2">
                  <label class="block text-sm font-semibold text-gray-700">Campaign Name</label>
                  <input
                    v-model="formData.name"
                    type="text"
                    required
                    placeholder="Enter campaign name"
                    class="w-full px-4 py-3 bg-gray-50/50 border border-gray-200/50 rounded-xl focus:border-blue-400 focus:bg-white focus:ring-2 focus:ring-blue-400/20 outline-none transition-all duration-200 text-sm font-medium"
                  />
                </div>

                <!-- Phone -->
                <div class="space-y-2">
                  <label class="block text-sm font-semibold text-gray-700">Phone Number</label>
                  <input
                    v-model="formData.phone"
                    type="text"
                    placeholder="Enter phone number"
                    class="w-full px-4 py-3 bg-gray-50/50 border border-gray-200/50 rounded-xl focus:border-blue-400 focus:bg-white focus:ring-2 focus:ring-blue-400/20 outline-none transition-all duration-200 text-sm font-medium font-mono"
                  />
                </div>

                <!-- Status -->
                <div class="space-y-3">
                  <label class="block text-sm font-semibold text-gray-700">Status</label>
                  <div class="flex gap-4">
                    <label class="flex items-center cursor-pointer group">
                      <input
                        v-model="formData.status"
                        type="radio"
                        value="live"
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300"
                      />
                      <span class="ml-3 text-sm font-medium text-gray-700 group-hover:text-gray-900">Live</span>
                    </label>
                    <label class="flex items-center cursor-pointer group">
                      <input
                        v-model="formData.status"
                        type="radio"
                        value="paused"
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300"
                      />
                      <span class="ml-3 text-sm font-medium text-gray-700 group-hover:text-gray-900">Paused</span>
                    </label>
                  </div>
                </div>

                <!-- Form Actions -->
                <div class="flex gap-4 pt-6">
                  <button
                    type="button"
                    @click="closeModal"
                    class="flex-1 px-6 py-3 text-sm font-semibold text-gray-700 bg-gray-100/50 hover:bg-gray-200/50 rounded-xl transition-all duration-200"
                  >
                    Cancel
                  </button>
                  <button
                    type="submit"
                    class="flex-1 px-6 py-3 text-sm font-semibold text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 rounded-xl shadow-lg hover:shadow-xl transition-all duration-200"
                  >
                    {{ isEditing ? 'Update' : 'Create' }} Campaign
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </transition>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, watch } from 'vue'
import {
  Search as SearchIcon,
  Plus as PlusIcon,
  Upload as UploadIcon,
  Download as DownloadIcon,
  Filter as FilterIcon,
  X as XIcon,
  ChevronDown as ChevronDownIcon,
  ChevronUp as ChevronUpIcon,
  RotateCcw as RotateCcwIcon,
  Edit as EditIcon,
  Eye as EyeIcon,
  Trash2 as Trash2Icon,
  ChevronLeft as ChevronLeftIcon,
  ChevronRight as ChevronRightIcon,
  MoreHorizontal as MoreHorizontalIcon
} from 'lucide-vue-next'
import LayoutClient from '../../Layouts/LayoutClient.vue'
defineOptions ({layout : LayoutClient})
const ITEMS_PER_PAGE = 10

// Reactive data
const showModal = ref(false)
const isEditing = ref(false)
const selectedCampaign = ref(null)
const currentPage = ref(1)
const isExpanded = ref(false)

const filters = ref({
  search: '',
  name: '',
  status: '',
  phone: '',
  minConversionRate: 0,
  minLeadsQualified: 0
})

const formData = ref({
  name: '',
  phone: '',
  status: 'live',
  assignedLeads: 0
})

const campaigns = ref([
  { id: 1, name: 'Summer Product Launch', phone: '+123456789', status: 'live', conversionRate: 12.5, leadsQualified: 31, assignedLeads: 45 },
  { id: 2, name: 'Holiday Email Campaign', phone: '+987654321', status: 'paused', conversionRate: 8.3, leadsQualified: 16, assignedLeads: 32 },
  { id: 3, name: 'Q4 Outreach Initiative', phone: '+192837465', status: 'live', conversionRate: 15.2, leadsQualified: 47, assignedLeads: 62 },
  { id: 4, name: 'Social Media Boost', phone: '+5647382910', status: 'live', conversionRate: 9.7, leadsQualified: 15, assignedLeads: 28 },
  { id: 5, name: 'Partnership Outreach', phone: '+1029384756', status: 'paused', conversionRate: 22.1, leadsQualified: 17, assignedLeads: 25 },
  { id: 6, name: 'Content Marketing Push', phone: '+6758493021', status: 'live', conversionRate: 11.8, leadsQualified: 24, assignedLeads: 38 },
  { id: 7, name: 'Brand Awareness Drive', phone: '+1234567890', status: 'live', conversionRate: 14.3, leadsQualified: 28, assignedLeads: 42 },
  { id: 8, name: 'Customer Retention Program', phone: '+0987654321', status: 'paused', conversionRate: 18.7, leadsQualified: 35, assignedLeads: 55 },
  { id: 9, name: 'Lead Generation Sprint', phone: '+1122334455', status: 'live', conversionRate: 13.9, leadsQualified: 41, assignedLeads: 67 },
  { id: 10, name: 'Product Demo Series', phone: '+5566778899', status: 'live', conversionRate: 16.2, leadsQualified: 52, assignedLeads: 78 },
  { id: 11, name: 'Webinar Follow-up', phone: '+9988776655', status: 'paused', conversionRate: 10.4, leadsQualified: 19, assignedLeads: 33 },
  { id: 12, name: 'Newsletter Signup Drive', phone: '+4433221100', status: 'live', conversionRate: 7.8, leadsQualified: 12, assignedLeads: 21 }
])

// Computed properties
const filteredCampaigns = computed(() => {
  return campaigns.value.filter(campaign => {
    const matchesSearch = campaign.name.toLowerCase().includes(filters.value.search.toLowerCase())
    const matchesName = campaign.name.toLowerCase().includes(filters.value.name.toLowerCase())
    const matchesStatus = filters.value.status ? campaign.status === filters.value.status : true
    const matchesPhone = filters.value.phone ? campaign.phone.toLowerCase().includes(filters.value.phone.toLowerCase()) : true
    const matchesConversionRate = campaign.conversionRate >= filters.value.minConversionRate
    const matchesLeadsQualified = campaign.leadsQualified >= filters.value.minLeadsQualified

    return matchesSearch && matchesName && matchesStatus && matchesPhone && matchesConversionRate && matchesLeadsQualified
  })
})

const totalPages = computed(() => Math.ceil(filteredCampaigns.value.length / ITEMS_PER_PAGE))
const startIndex = computed(() => (currentPage.value - 1) * ITEMS_PER_PAGE)
const endIndex = computed(() => startIndex.value + ITEMS_PER_PAGE)
const paginatedCampaigns = computed(() => filteredCampaigns.value.slice(startIndex.value, endIndex.value))

const startItem = computed(() => (currentPage.value - 1) * ITEMS_PER_PAGE + 1)
const endItem = computed(() => Math.min(currentPage.value * ITEMS_PER_PAGE, filteredCampaigns.value.length))

// Methods
const updateFilter = (key, value) => {
  filters.value[key] = value
}

const getActiveFiltersCount = () => {
  let count = 0
  if (filters.value.search) count++
  if (filters.value.name) count++
  if (filters.value.status) count++
  if (filters.value.phone) count++
  if (filters.value.minConversionRate > 0) count++
  if (filters.value.minLeadsQualified > 0) count++
  return count
}

const clearFilters = () => {
  filters.value = {
    search: '',
    name: '',
    status: '',
    phone: '',
    minConversionRate: 0,
    minLeadsQualified: 0
  }
}

const openModal = () => {
  selectedCampaign.value = null
  isEditing.value = false
  showModal.value = true
  formData.value = {
    name: '',
    phone: '',
    status: 'live',
    assignedLeads: 0
  }
}

const closeModal = () => {
  showModal.value = false
  selectedCampaign.value = null
  isEditing.value = false
}

const editCampaign = (campaign) => {
  selectedCampaign.value = { ...campaign }
  isEditing.value = true
  showModal.value = true
  formData.value = {
    name: campaign.name,
    phone: campaign.phone,
    status: campaign.status,
    assignedLeads: campaign.assignedLeads
  }
}

const viewCampaign = (campaign) => {
  console.log('Viewing campaign:', campaign.name)
}

const deleteCampaign = (id) => {
  if (confirm('Are you sure you want to delete this campaign?')) {
    campaigns.value = campaigns.value.filter(c => c.id !== id)
  }
}

const handleSubmit = () => {
  if (!formData.value.name.trim()) return

  if (isEditing.value) {
    const index = campaigns.value.findIndex(c => c.id === selectedCampaign.value.id)
    if (index !== -1) {
      campaigns.value[index] = {
        ...selectedCampaign.value,
        ...formData.value
      }
    }
  } else {
    const newCampaign = {
      ...formData.value,
      id: Date.now(),
      conversionRate: Math.floor(Math.random() * 20) + 5,
      leadsQualified: Math.floor(formData.value.assignedLeads * 0.15)
    }
    campaigns.value.push(newCampaign)
  }
  closeModal()
}

const handleImport = () => {
  alert('Import functionality coming soon!')
}

const handleExport = () => {
  alert('Export functionality coming soon!')
}

const getVisiblePages = () => {
  const delta = 2
  const range = []
  const rangeWithDots = []

  for (let i = Math.max(2, currentPage.value - delta); i <= Math.min(totalPages.value - 1, currentPage.value + delta); i++) {
    range.push(i)
  }

  if (currentPage.value - delta > 2) {
    rangeWithDots.push(1, '...')
  } else {
    rangeWithDots.push(1)
  }

  rangeWithDots.push(...range)

  if (currentPage.value + delta < totalPages.value - 1) {
    rangeWithDots.push('...', totalPages.value)
  } else if (totalPages.value > 1) {
    rangeWithDots.push(totalPages.value)
  }

  return rangeWithDots
}

// Watch for filter changes to reset pagination
watch(() => filteredCampaigns.value.length, () => {
  currentPage.value = 1
})
</script>
