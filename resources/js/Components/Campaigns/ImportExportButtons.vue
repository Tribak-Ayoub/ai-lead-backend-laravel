<template>
  <div class="flex space-x-3">
    <!-- Import Button -->
    <button
      @click="$emit('import-click')"
      class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors duration-200"
    >
      <UploadIcon class="w-4 h-4 mr-2" />
      Import
    </button>

    <!-- Export Button -->
    <button
      @click="$emit('export-click')"
      class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200"
    >
      <DownloadIcon class="w-4 h-4 mr-2" />
      Export
    </button>
  </div>
</template>

<script setup>
import { UploadIcon, DownloadIcon } from 'lucide-vue-next'

// Define emitted events
defineEmits(['import-click', 'export-click'])
</script>

<style scoped>
/* Additional hover effects and transitions */
button {
  transition: all 0.2s ease-in-out;
}

button:hover {
  transform: translateY(-1px);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

button:active {
  transform: translateY(0);
}

/* Focus ring improvements */
button:focus {
  outline: none;
}
</style>
