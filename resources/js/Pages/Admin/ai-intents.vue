<template>
     
  <div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <main >
      <!-- Campaign Selection -->
       
    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Select Campaign</label>
         <div class="flex flex-col sm:flex-row sm:items-stretch sm:justify-between gap-4 mb-6">
  <!-- Select Campaign -->
              <div class="flex-1">
                <select v-model="selectedCampaign"
                  class="block w-full max-w-xs px-3 py-2 h-full min-h-[42px] border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                  <option value="">Choose a campaign...</option>
                  <option v-for="campaign in campaigns" :key="campaign.id" :value="campaign.id">
                    {{ campaign.name }}
                  </option>
                </select>
              </div>

              <!-- Total Intents -->
              <div class="flex items-center bg-white dark:bg-gray-800 rounded-lg shadow px-4 w-full sm:w-auto h-full min-h-[42px]">
                <div class="flex flex-row gap-3">
                  <p class="text-lg font-bold text-gray-500 dark:text-gray-400">Total Intents :</p>
                  <p class="text-lg font-bold text-gray-900 dark:text-white">{{ intents.length }}</p>
                </div>
              </div>
            </div>

      <div v-if="selectedCampaign" class="space-y-6">
      
        

        <!-- Actions Bar -->
        <div class="flex flex-col sm:flex-row gap-4 justify-between items-start sm:items-center">
          <div class="flex items-center gap-2">
             <input v-model="searchQuery" type="text" placeholder="Search intents..."
              class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400">
         
            <Search class="w-5 h-5 text-gray-400" />
            </div>
          <div class="flex gap-3">
            <button @click="showAddIntentModal = true"
              class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
              <Plus class="w-4 h-4 mr-2" />
              Add Intent
            </button>
            <button @click="retrainModel" :disabled="isRetraining"
              class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-lg shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 disabled:opacity-50">
              
              {{ isRetraining ? 'Retraining...' : 'Retrain Model' }}
            </button>
          </div>

          
        </div>

        <!-- Intents List -->
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
          <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Intent Configuration</h3>
          </div>

          <div class="divide-y divide-gray-200 dark:divide-gray-700">
            <div v-for="intent in filteredIntents" :key="intent.id" class="p-6">
              <div class="flex items-start justify-between">
                <div class="flex-1">
                  <div class="flex items-center gap-3 mb-2">
                    <h4 class="text-lg font-medium text-gray-900 dark:text-white">{{ intent.name }}</h4>
                    <span :class="getAccuracyBadgeClass(intent.accuracy)"
                      class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium">
                      {{ intent.accuracy }}% accuracy
                    </span>
                  </div>
                  <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">{{ intent.description }}</p>

                  <!-- Utterances -->
                  <div class="mb-4">
                    <div class="flex items-center justify-between mb-2">
                      <h5 class="text-sm font-medium text-gray-700 dark:text-gray-300">
                        Sample Utterances ({{ intent.utterances.length }})
                      </h5>
                      
                    </div>

                    <div v-if="expandedIntents.includes(intent.id)" class="space-y-2">
                      <div v-for="(utterance, index) in intent.utterances" :key="index"
                        class="flex items-center justify-between p-2 bg-gray-50 dark:bg-gray-700 rounded">
                        <span class="text-sm text-gray-700 dark:text-gray-300">{{ utterance }}</span>
                        <button @click="removeUtterance(intent.id, index)" class="text-red-500 hover:text-red-700">
                          <Trash2 class="w-4 h-4" />
                        </button>
                      </div>
                      <div class="flex gap-2 mt-3">
                        <input v-model="newUtterances[intent.id]" @keyup.enter="addUtterance(intent.id)" type="text"
                          placeholder="Add new utterance..."
                          class="flex-1 px-3 py-2 text-sm border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                        <button @click="addUtterance(intent.id)"
                          class="px-3 py-2 text-sm bg-blue-600 text-white rounded hover:bg-blue-700">
                          <Plus class="w-4 h-4" />
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="flex items-center gap-2 ml-4">
                  <button @click="editIntent(intent)" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <Edit class="w-5 h-5" />
                  </button>
                  <button @click="deleteIntent(intent.id)" class="text-red-400 hover:text-red-600">
                    <Trash2 class="w-5 h-5" />
                  </button>
                </div>
                <div class="flex items-center gap-2 ml-4">
  <button @click="toggleUtterances(intent.id)"
          class="text-blue-600 hover:text-blue-800 dark:text-blue-400">
    <component :is="expandedIntents.includes(intent.id) ? EyeOff : Eye" class="w-5 h-5" />
  </button>
</div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Empty state -->
      <div v-else class="text-center py-12">
        <Brain class="w-16 h-16 text-gray-400 mx-auto mb-4" />
        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Select a Campaign</h3>
        <p class="text-gray-500 dark:text-gray-400">Choose a campaign to view and manage its AI intents.</p>
      </div>
    </main>

    <!-- Add Intent Modal -->
    <div v-if="showAddIntentModal" class="fixed inset-0 z-50 overflow-y-auto">
      <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="showAddIntentModal = false"></div>

        <div
          class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
          <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Add New Intent</h3>

            <div class="space-y-4">
              <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Intent Name</label>
                <input v-model="newIntent.name" type="text"
                  class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                <textarea v-model="newIntent.description" rows="3"
                  class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"></textarea>
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Sample Utterances</label>
                <div class="space-y-2">
                  <input v-for="(utterance, index) in newIntent.utterances" :key="index"
                    v-model="newIntent.utterances[index]" type="text" :placeholder="`Utterance ${index + 1}`"
                    class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>
                <button @click="newIntent.utterances.push('')"
                  class="mt-2 text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400">+ Add another utterance</button>
              </div>
            </div>
          </div>

          <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <button @click="saveNewIntent"
              class="w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
              Save Intent
            </button>
            <button @click="showAddIntentModal = false"
              class="mt-3 w-full inline-flex justify-center rounded-lg border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm dark:bg-gray-600 dark:text-gray-300 dark:border-gray-500 dark:hover:bg-gray-500">
              Cancel
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script setup>
import { ref, computed, onMounted, watch } from 'vue'
import {
    Menu, X, BarChart3, Users, Phone, Target, Brain, CreditCard, Settings,
    Sun, Moon, Plus, RefreshCw, Search, Edit, Trash2, TrendingUp, Clock
} from 'lucide-vue-next'

import LayoutAdmins from '@/Layouts/LayoutAdmins.vue';
defineOptions({layout : LayoutAdmins})

import { Eye, EyeOff } from 'lucide-vue-next'
// Reactive data
const sidebarOpen = ref(false)
const darkMode = ref(false)
const selectedCampaign = ref('')
const searchQuery = ref('')
const expandedIntents = ref([])
const newUtterances = ref({})
const isRetraining = ref(false)
const showAddIntentModal = ref(false)

// Sample data
const campaigns = ref([
    { id: '1', name: 'Real Estate Leads Q4' },
    { id: '2', name: 'Insurance Prospects' },
    { id: '3', name: 'Solar Panel Campaign' }
])

const intents = ref([
    {
        id: '1',
        name: 'Interested',
        description: 'Customer shows interest in the product or service',
        accuracy: 92,
        utterances: [
            'I\'m interested in learning more',
            'Tell me more about this',
            'This sounds good',
            'I want to know more details',
            'Can you send me information?'
        ]
    },
    {
        id: '2',
        name: 'Not Interested',
        description: 'Customer explicitly declines or shows no interest',
        accuracy: 88,
        utterances: [
            'I\'m not interested',
            'No thank you',
            'Not right now',
            'I don\'t need this',
            'Please remove me from your list'
        ]
    },
    {
        id: '3',
        name: 'Budget Concern',
        description: 'Customer mentions price or budget as a concern',
        accuracy: 85,
        utterances: [
            'How much does it cost?',
            'That\'s too expensive',
            'I can\'t afford that',
            'What\'s the price?',
            'Is there a cheaper option?'
        ]
    },
    {
        id: '4',
        name: 'Need More Time',
        description: 'Customer needs time to think or decide',
        accuracy: 90,
        utterances: [
            'I need to think about it',
            'Can I call you back?',
            'Let me discuss with my spouse',
            'I\'ll get back to you',
            'Give me some time to decide'
        ]
    }
])

const newIntent = ref({
    name: '',
    description: '',
    utterances: ['', '', '']
})

// Computed properties
const filteredIntents = computed(() => {
    if (!searchQuery.value) return intents.value
    return intents.value.filter(intent =>
        intent.name.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
        intent.description.toLowerCase().includes(searchQuery.value.toLowerCase())
    )
})

const averageAccuracy = computed(() => {
    if (intents.value.length === 0) return 0
    const sum = intents.value.reduce((acc, intent) => acc + intent.accuracy, 0)
    return Math.round(sum / intents.value.length)
})

// Methods
const toggleUtterances = (intentId) => {
    const index = expandedIntents.value.indexOf(intentId)
    if (index > -1) {
        expandedIntents.value.splice(index, 1)
    } else {
        expandedIntents.value.push(intentId)
    }
}

const addUtterance = (intentId) => {
    const utterance = newUtterances.value[intentId]
    if (utterance && utterance.trim()) {
        const intent = intents.value.find(i => i.id === intentId)
        if (intent) {
            intent.utterances.push(utterance.trim())
            newUtterances.value[intentId] = ''
        }
    }
}

const removeUtterance = (intentId, index) => {
    const intent = intents.value.find(i => i.id === intentId)
    if (intent) {
        intent.utterances.splice(index, 1)
    }
}

const editIntent = (intent) => {
    // Implementation for editing intent
    console.log('Edit intent:', intent)
}

const deleteIntent = (intentId) => {
    if (confirm('Are you sure you want to delete this intent?')) {
        const index = intents.value.findIndex(i => i.id === intentId)
        if (index > -1) {
            intents.value.splice(index, 1)
        }
    }
}

const retrainModel = async () => {
    isRetraining.value = true
    // Simulate API call
    await new Promise(resolve => setTimeout(resolve, 3000))
    isRetraining.value = false
    alert('Model retrained successfully!')
}

const saveNewIntent = () => {
    if (newIntent.value.name && newIntent.value.description) {
        const intent = {
            id: Date.now().toString(),
            name: newIntent.value.name,
            description: newIntent.value.description,
            accuracy: Math.floor(Math.random() * 20) + 80, // Random accuracy between 80-100
            utterances: newIntent.value.utterances.filter(u => u.trim())
        }
        intents.value.push(intent)

        // Reset form
        newIntent.value = {
            name: '',
            description: '',
            utterances: ['', '', '']
        }
        showAddIntentModal.value = false
    }
}

const getAccuracyBadgeClass = (accuracy) => {
    if (accuracy >= 90) return 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200'
    if (accuracy >= 80) return 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200'
    return 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200'
}

// Watch for dark mode changes
watch(darkMode, (newValue) => {
    if (newValue) {
        document.documentElement.classList.add('dark')
    } else {
        document.documentElement.classList.remove('dark')
    }
})

// Initialize dark mode
onMounted(() => {
    const isDark = localStorage.getItem('darkMode') === 'true'
    darkMode.value = isDark
    if (isDark) {
        document.documentElement.classList.add('dark')
    }
})

// Save dark mode preference
watch(darkMode, (newValue) => {
    localStorage.setItem('darkMode', newValue.toString())
})
</script>
