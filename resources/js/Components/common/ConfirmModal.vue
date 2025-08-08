<template>
  <div v-if="show" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50" @click="$emit('cancel')">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full" @click.stop>
      <div class="p-6">
        <!-- Icon -->
        <div class="flex items-center justify-center w-12 h-12 mx-auto mb-4 bg-red-100 rounded-full">
          <AlertTriangle class="w-6 h-6 text-red-600" />
        </div>

        <!-- Content -->
        <div class="text-center mb-6">
          <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ title }}</h3>
          <p class="text-gray-600">{{ message }}</p>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-center space-x-3">
          <button @click="$emit('cancel')" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
            Cancel
          </button>
          <button @click="$emit('confirm')" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
            Delete
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { AlertTriangle } from 'lucide-vue-next'

defineProps({
  show: Boolean,
  title: String,
  message: String
})

defineEmits(['confirm', 'cancel'])
</script>
