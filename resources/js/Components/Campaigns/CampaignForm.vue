<template>
  <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50" @click.self="$emit('close')">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full max-h-[90vh] overflow-y-auto">
      <div class="p-6">
        <div class="flex items-center justify-between mb-6">
          <h2 class="text-xl font-semibold text-gray-900">
            {{ isEditing ? 'Edit Campaign' : 'New Campaign' }}
          </h2>
          <button
            @click="$emit('close')"
            class="text-gray-400 hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-[#002B5B] rounded-md p-1 transition-colors duration-200"
          >
            <XIcon class="w-6 h-6" />
          </button>
        </div>

        <form @submit.prevent="handleSubmit" class="space-y-6">
          <!-- Campaign Name -->
          <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
              Campaign Name
            </label>
            <input
              id="name"
              v-model="formData.name"
              type="text"
              required
              class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#002B5B] focus:border-[#002B5B] transition-colors duration-200"
              placeholder="Enter campaign name"
            />
          </div>

          <!-- Assign Leads -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
              Assign Leads
            </label>
            <div class="relative">
              <button
                type="button"
                @click="showLeadsDropdown = !showLeadsDropdown"
                class="w-full px-3 py-2 text-left border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#002B5B] focus:border-[#002B5B] bg-white flex items-center justify-between transition-colors duration-200"
              >
                <span class="text-gray-700">
                  {{ formData.selectedLeads.length }} leads selected
                </span>
                <ChevronDownIcon class="w-5 h-5 text-gray-400" />
              </button>
              
              <div v-if="showLeadsDropdown" class="absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg max-h-48 overflow-y-auto">
                <div
                  v-for="lead in availableLeads"
                  :key="lead.id"
                  @click="toggleLead(lead)"
                  class="px-3 py-2 hover:bg-gray-50 cursor-pointer flex items-center transition-colors duration-150"
                >
                  <input
                    type="checkbox"
                    :checked="isLeadSelected(lead)"
                    class="mr-3 h-4 w-4 text-[#002B5B] focus:ring-[#002B5B] border-gray-300 rounded"
                    readonly
                  />
                  <div>
                    <div class="text-sm font-medium text-gray-900">{{ lead.name }}</div>
                    <div class="text-xs text-gray-500">{{ lead.email }}</div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Status Toggle -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
              Status
            </label>
            <div class="flex items-center space-x-4">
              <label class="flex items-center cursor-pointer">
                <input
                  v-model="formData.status"
                  type="radio"
                  value="live"
                  class="h-4 w-4 text-[#002B5B] focus:ring-[#002B5B] border-gray-300"
                />
                <span class="ml-2 text-sm text-gray-700">Live</span>
              </label>
              <label class="flex items-center cursor-pointer">
                <input
                  v-model="formData.status"
                  type="radio"
                  value="paused"
                  class="h-4 w-4 text-[#002B5B] focus:ring-[#002B5B] border-gray-300"
                />
                <span class="ml-2 text-sm text-gray-700">Paused</span>
              </label>
            </div>
          </div>

          <!-- Form Actions -->
          <div class="flex space-x-3 pt-4">
            <button
              type="button"
              @click="$emit('close')"
              class="flex-1 px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[#002B5B] focus:ring-offset-2 transition-colors duration-200"
            >
              Cancel
            </button>
            <button
              type="submit"
              class="flex-1 px-4 py-2 text-sm font-medium text-white bg-[#002B5B] rounded-md hover:bg-[#003d7a] focus:outline-none focus:ring-2 focus:ring-[#002B5B] focus:ring-offset-2 transition-colors duration-200"
            >
              {{ isEditing ? 'Update' : 'Create' }} Campaign
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { reactive, ref, watch } from 'vue'
import { XIcon, ChevronDownIcon } from 'lucide-vue-next'

const props = defineProps({
  campaign: {
    type: Object,
    default: null
  },
  isEditing: {
    type: Boolean,
    default: false
  },
  availableLeads: {
    type: Array,
    required: true
  }
})

const emit = defineEmits(['close', 'submit'])

const formData = reactive({
  name: '',
  assignedLeads: 0,
  status: 'live',
  selectedLeads: []
})

const showLeadsDropdown = ref(false)

// Initialize form data when campaign prop changes
watch(() => props.campaign, (newCampaign) => {
  if (newCampaign) {
    formData.name = newCampaign.name
    formData.assignedLeads = newCampaign.assignedLeads
    formData.status = newCampaign.status
    formData.selectedLeads = []
  } else {
    formData.name = ''
    formData.assignedLeads = 0
    formData.status = 'live'
    formData.selectedLeads = []
  }
}, { immediate: true })

const toggleLead = (lead) => {
  const index = formData.selectedLeads.findIndex(l => l.id === lead.id)
  if (index > -1) {
    formData.selectedLeads.splice(index, 1)
  } else {
    formData.selectedLeads.push(lead)
  }
  formData.assignedLeads = formData.selectedLeads.length
}

const isLeadSelected = (lead) => {
  return formData.selectedLeads.some(l => l.id === lead.id)
}

const handleSubmit = () => {
  if (!formData.name.trim()) return
  
  const submitData = {
    ...formData,
    id: props.campaign?.id
  }
  emit('submit', submitData)
}
</script>

<style scoped>
/* Custom scrollbar for dropdown */
.overflow-y-auto::-webkit-scrollbar {
  width: 6px;
}

.overflow-y-auto::-webkit-scrollbar-track {
  background: #f1f1f1;
  border-radius: 3px;
}

.overflow-y-auto::-webkit-scrollbar-thumb {
  background: #c1c1c1;
  border-radius: 3px;
}

.overflow-y-auto::-webkit-scrollbar-thumb:hover {
  background: #a8a8a8;
}

/* Focus ring improvements */
input:focus, button:focus {
  outline: none;
}

/* Smooth transitions */
button, input {
  transition: all 0.2s ease-in-out;
}
</style>
