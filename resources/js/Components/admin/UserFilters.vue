<template>
  <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
      <!-- Search -->
      <div class="flex flex-col">
        <label class="text-sm font-medium text-gray-700 mb-2">Search</label>
        <div class="relative">
          <Search class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-400" />
          <input
            :value="search"
            @input="$emit('update:search', $event.target.value)"
            type="text"
            placeholder="Search by name or email..."
            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400"
          />
        </div>
      </div>

      <!-- Role -->
      <div class="flex flex-col">
        <label class="text-sm font-medium text-gray-700 mb-2">Role</label>
        <select 
          :value="role"
          @change="$emit('update:role', $event.target.value)"
          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white"
        >
          <option value="">All Roles</option>
          <option value="Super Admin">Super Admin</option>
          <option value="Admin">Admin</option>
          <option value="Moderator">Moderator</option>
        </select>
      </div>

      <!-- Status -->
      <div class="flex flex-col">
        <label class="text-sm font-medium text-gray-700 mb-2">Status</label>
        <select 
          :value="status"
          @change="$emit('update:status', $event.target.value)"
          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white"
        >
          <option value="">All Status</option>
          <option value="active">Active</option>
          <option value="inactive">Inactive</option>
        </select>
      </div>

      <!-- Reset -->
      <div class="flex flex-col">
        <label class="text-sm font-medium text-gray-700 mb-2">&nbsp;</label>
        <button 
          @click="$emit('reset')" 
          class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50"
        >
          <RotateCcw class="w-4 h-4 mr-2" />
          Reset
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Search, RotateCcw } from 'lucide-vue-next'

const props = defineProps({
  search: String,
  role: String,
  status: String
})
</script>
