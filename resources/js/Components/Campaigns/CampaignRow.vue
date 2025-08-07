<template>
  <tr class="hover:bg-gray-50 transition-colors duration-150">
    <td class="px-6 py-4 whitespace-nowrap">
      <div class="text-sm font-medium text-gray-900">{{ campaign.name }}</div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
      <StatusBadge :status="campaign.status" />
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
      <div class="text-sm text-gray-900">{{ campaign.assignedLeads }}</div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
      <div class="text-sm text-gray-900">{{ campaign.conversionRate }}%</div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
      <div class="text-sm text-gray-900">{{ campaign.leadsQualified }}</div>
    </td>
    

    <!-- Action buttons -->
    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
      <div class="flex items-center space-x-2">
        <!-- Edit Button -->
        <button
          @click="$emit('edit', campaign)"
          class="text-blue-600 hover:text-blue-900 p-2 rounded-full hover:bg-blue-50 transition-colors duration-150 cursor-pointer focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-600 focus-visible:ring-offset-1"
          title="Edit"
          aria-label="Edit campaign"
        >
          <EditIcon class="w-4 h-4" />
        </button>

        <!-- View Button -->
        <button
          @click="$emit('view', campaign)"
          class="text-gray-600 hover:text-gray-900 p-2 rounded-full hover:bg-gray-100 transition-colors duration-150 cursor-pointer focus:outline-none focus-visible:ring-2 focus-visible:ring-gray-600 focus-visible:ring-offset-1"
          title="View"
          aria-label="View campaign"
        >
          <EyeIcon class="w-4 h-4" />
        </button>

        <!-- Delete Button -->
        <button
          @click="$emit('delete', campaign.id)"
          class="text-red-600 hover:text-red-900 p-2 rounded-full hover:bg-red-50 transition-colors duration-150 cursor-pointer focus:outline-none focus-visible:ring-2 focus-visible:ring-red-600 focus-visible:ring-offset-1"
          title="Delete"
          aria-label="Delete campaign"
        >
          <Trash2Icon class="w-4 h-4" />
        </button>
      </div>
    </td>
  </tr>
</template>

<script setup>
import { Pencil as EditIcon, Eye as EyeIcon, Trash2 as Trash2Icon } from 'lucide-vue-next'
import StatusBadge from './StatusBadge.vue'

defineProps({
  campaign: {
    type: Object,
    required: true
  }
})

defineEmits(['edit', 'view', 'delete'])
</script>

<style scoped>
button {
  transition: all 0.2s ease-in-out;
}
</style>
