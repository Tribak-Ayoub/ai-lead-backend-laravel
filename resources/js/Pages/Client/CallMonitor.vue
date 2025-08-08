<template>
  <div class="min-h-screen ">
    <div class="">
      <!-- Header Section -->
      <div class="mb-8">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
          <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white flex items-center gap-3">
              <div class="relative">
                <Phone class="h-12 w-12 text-blue-600 drop-shadow-lg " />
                <div class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full animate-pulse"></div>
              </div>
             <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold bg-gradient-to-r from-gray-900 via-blue-900 to-indigo-900 bg-clip-text text-transparent">
            Live CallMonitor
          </h1>
            </h1>
            <p class="mt-2 text-gray-600 dark:text-gray-400">
              Monitor and manage AI-powered calls in real-time
            </p>
          </div>
          
          <!-- Live Stats -->
          <div class="flex items-center gap-4">
            <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm border border-gray-200/50 dark:border-gray-700/50 rounded-xl p-4 shadow-sm">
              <div class="flex items-center gap-3">
                <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                <div>
                  <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ activeCalls.length }}</div>
                  <div class="text-sm text-gray-500 dark:text-gray-400">Active Calls</div>
                </div>
              </div>
            </div>
            
            <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm border border-gray-200/50 dark:border-gray-700/50 rounded-xl p-4 shadow-sm">
              <div class="flex items-center gap-3">
                <BarChart3 class="w-5 h-5 text-blue-600" />
                <div>
                  <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ totalCallsToday }}</div>
                  <div class="text-sm text-gray-500 dark:text-gray-400">Today</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Toolbar / Filters -->
      <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm border border-gray-200/50 dark:border-gray-700/50 rounded-xl shadow-sm mb-6">
        <div class="p-6">
          <div class="flex flex-col lg:flex-row gap-4 items-start lg:items-center justify-between">
            <!-- Search and Filters -->
            <div class="flex flex-col sm:flex-row gap-4 flex-1">
              <!-- Search Bar -->
              <div class="relative flex-1 max-w-md">
                <Search class="absolute left-3 top-1/2 transform -translate-y-1/2 h-4 w-4 text-gray-400" />
                <input
                  v-model="searchQuery"
                  type="text"
                  placeholder="Search by lead name or phone..."
                  class="w-full pl-10 pr-4 py-2.5 text-sm border border-gray-200 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 bg-white/50 dark:bg-gray-700/50 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 transition-all duration-200"
                />
              </div>

              <!-- Filters -->
              <div class="flex gap-3">
                <select v-model="campaignFilter" class="px-3 py-2.5 text-sm border border-gray-200 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 bg-white/50 dark:bg-gray-700/50 text-gray-900 dark:text-white">
                  <option value="all">All Campaigns</option>
                  <option value="sales">Sales Outreach</option>
                  <option value="support">Customer Support</option>
                  <option value="followup">Follow-up</option>
                </select>

                <select v-model="agentFilter" class="px-3 py-2.5 text-sm border border-gray-200 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 bg-white/50 dark:bg-gray-700/50 text-gray-900 dark:text-white">
                  <option value="all">All Agents</option>
                  <option value="sarah">Sarah AI</option>
                  <option value="alex">Alex AI</option>
                  <option value="emma">Emma AI</option>
                </select>

                <select v-model="statusFilter" class="px-3 py-2.5 text-sm border border-gray-200 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 bg-white/50 dark:bg-gray-700/50 text-gray-900 dark:text-white">
                  <option value="all">All Status</option>
                  <option value="connecting">Connecting</option>
                  <option value="in-progress">In Progress</option>
                  <option value="on-hold">On Hold</option>
                </select>
              </div>
            </div>

            <!-- Toggle Switch -->
            <div class="flex items-center gap-3">
              <label class="flex items-center cursor-pointer">
                <input
                  v-model="showActiveOnly"
                  type="checkbox"
                  class="sr-only"
                />
                <div :class="[
                  'relative w-11 h-6 rounded-full transition-colors duration-200',
                  showActiveOnly ? 'bg-blue-600' : 'bg-gray-300 dark:bg-gray-600'
                ]">
                  <div :class="[
                    'absolute top-0.5 left-0.5 w-5 h-5 bg-white rounded-full transition-transform duration-200',
                    showActiveOnly ? 'translate-x-5' : 'translate-x-0'
                  ]"></div>
                </div>
                <span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">
                  Active calls only
                </span>
              </label>
            </div>
          </div>
        </div>
      </div>

      <!-- Live Calls Per Minute Chart -->
      <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm border border-gray-200/50 dark:border-gray-700/50 rounded-xl shadow-sm mb-6 p-6">
        <div class="flex items-center justify-between mb-4">
          <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Live Activity</h3>
          <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
            <div class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></div>
            Real-time
          </div>
        </div>
        <div class="h-20 flex items-end justify-between gap-1">
          <div v-for="(value, index) in callsPerMinute" :key="index" 
               :class="[
                 'bg-gradient-to-t from-blue-500 to-blue-400 rounded-t transition-all duration-500',
                 index === callsPerMinute.length - 1 ? 'animate-pulse' : ''
               ]"
               :style="{ height: `${Math.max(value * 10, 4)}px`, width: '8px' }">
          </div>
        </div>
      </div>

      <!-- Live Call Cards Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div
          v-for="call in filteredCalls"
          :key="call.id"
          class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm border border-gray-200/50 dark:border-gray-700/50 rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden"
        >
          <!-- Card Header -->
          <div class="p-6 pb-4">
            <div class="flex items-start justify-between mb-4">
              <div class="flex-1">
                <div class="flex items-center gap-2 mb-1">
                  <h3 class="font-semibold text-gray-900 dark:text-white">{{ call.leadName }}</h3>
                  <div v-if="call.status === 'in-progress'" class="flex items-center gap-1">
                    <div class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></div>
                    <span class="text-xs font-medium text-red-600 dark:text-red-400 uppercase tracking-wide">LIVE</span>
                  </div>
                </div>
                <p class="text-sm text-gray-500 dark:text-gray-400 flex items-center gap-1">
                  <Phone class="h-3 w-3" />
                  {{ call.phoneNumber }}
                </p>
              </div>
              
              <div :class="getStatusBadgeClass(call.status)" class="px-2 py-1 rounded-full text-xs font-medium">
                {{ getStatusText(call.status) }}
              </div>
            </div>

            <!-- Campaign and Agent Info -->
            <div class="grid grid-cols-2 gap-4 mb-4">
              <div>
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Campaign</p>
                <p class="text-sm font-medium text-gray-900 dark:text-white">{{ call.campaign }}</p>
              </div>
              <div>
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">AI Agent</p>
                <p class="text-sm font-medium text-gray-900 dark:text-white flex items-center gap-1">
                  <Bot class="h-3 w-3 text-blue-500" />
                  {{ call.agent }}
                </p>
              </div>
            </div>

            <!-- Call Duration -->
            <div class="flex items-center justify-between mb-4">
              <div class="flex items-center gap-2">
                <Clock class="h-4 w-4 text-gray-400" />
                <span class="text-sm font-mono text-gray-900 dark:text-white">
                  {{ formatDuration(call.duration) }}
                </span>
              </div>
              
              <!-- Intent Detection -->
              <div v-if="call.intent" class="flex items-center gap-1">
                <Brain class="h-3 w-3 text-purple-500" />
                <span class="text-xs text-purple-600 dark:text-purple-400 font-medium">
                  {{ call.intent }}
                </span>
              </div>
            </div>

            <!-- Audio Player -->
            <div v-if="call.status === 'in-progress'" class="bg-gray-50/50 dark:bg-gray-700/50 rounded-lg p-3 mb-4">
              <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                  <button
                    @click="toggleAudio(call.id)"
                    :class="[
                      'p-2 rounded-full transition-colors',
                      call.isPlaying 
                        ? 'bg-red-500 hover:bg-red-600 text-white' 
                        : 'bg-blue-500 hover:bg-blue-600 text-white'
                    ]"
                  >
                    <Pause v-if="call.isPlaying" class="h-3 w-3" />
                    <Play v-else class="h-3 w-3" />
                  </button>
                  
                  <div class="flex items-center gap-1">
                    <Volume2 class="h-3 w-3 text-gray-400" />
                    <input
                      v-model="call.volume"
                      type="range"
                      min="0"
                      max="100"
                      class="w-16 h-1 bg-gray-300 rounded-lg appearance-none cursor-pointer"
                    />
                  </div>
                </div>
                
                <div class="flex items-center gap-1">
                  <div v-for="i in 5" :key="i" 
                       :class="[
                         'w-1 bg-blue-500 rounded-full transition-all duration-150',
                         call.isPlaying ? 'animate-pulse' : ''
                       ]"
                       :style="{ height: `${Math.random() * 12 + 4}px` }">
                  </div>
                </div>
              </div>
            </div>

            <!-- Tags -->
            <div v-if="call.tags && call.tags.length > 0" class="flex flex-wrap gap-1 mb-4">
              <span
                v-for="tag in call.tags"
                :key="tag"
                class="px-2 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 text-xs rounded-full"
              >
                {{ tag }}
              </span>
            </div>
          </div>

          <!-- Card Actions -->
          <div class="px-6 py-4 bg-gray-50/50 dark:bg-gray-700/50 border-t border-gray-200/50 dark:border-gray-600/50">
            <div class="flex items-center justify-between">
              <div class="flex gap-2">
                <button
                  @click="addTag(call)"
                  class="px-3 py-1.5 text-xs font-medium text-gray-600 dark:text-gray-300 bg-white dark:bg-gray-600 border border-gray-200 dark:border-gray-500 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-500 transition-colors flex items-center gap-1"
                >
                  <Tag class="h-3 w-3" />
                  Tag
                </button>
                
                <button
                  @click="viewDetails(call)"
                  class="px-3 py-1.5 text-xs font-medium text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/30 border border-blue-200 dark:border-blue-800 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-900/50 transition-colors flex items-center gap-1"
                >
                  <Eye class="h-3 w-3" />
                  Details
                </button>
              </div>
              
              <button
                @click="cancelCall(call)"
                class="px-3 py-1.5 text-xs font-medium text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-lg hover:bg-red-100 dark:hover:bg-red-900/50 transition-colors flex items-center gap-1"
              >
                <PhoneOff class="h-3 w-3" />
                Cancel
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Empty State -->
      <div v-if="filteredCalls.length === 0" class="text-center py-12">
        <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm border border-gray-200/50 dark:border-gray-700/50 rounded-xl p-8">
          <PhoneOff class="h-16 w-16 text-gray-400 mx-auto mb-4" />
          <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">No active calls</h3>
          <p class="text-gray-500 dark:text-gray-400">
            {{ searchQuery || campaignFilter !== 'all' || agentFilter !== 'all' || statusFilter !== 'all' 
               ? 'No calls match your current filters.' 
               : 'All quiet on the phone lines right now.' }}
          </p>
        </div>
      </div>
    </div>

    <!-- Tag Modal -->
    <div v-if="showTagModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4 z-50">
      <div class="bg-white/95 dark:bg-gray-800/95 backdrop-blur-sm border border-gray-200/50 dark:border-gray-700/50 rounded-2xl shadow-2xl max-w-md w-full">
        <div class="p-6">
          <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Add Tag</h3>
          
          <div class="space-y-3 mb-6">
            <button
              v-for="tag in availableTags"
              :key="tag"
              @click="selectTag(tag)"
              class="w-full px-3 py-2 text-left text-sm bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 rounded-lg transition-colors"
            >
              {{ tag }}
            </button>
          </div>
          
          <div class="flex justify-end gap-3">
            <button
              @click="showTagModal = false"
              class="px-4 py-2 text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors"
            >
              Cancel
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'
import {
  Phone,
  PhoneOff,
  Search,
  Clock,
  Play,
  Pause,
  Volume2,
  Bot,
  Brain,
  Eye,
  Tag,
  BarChart3,
} from 'lucide-vue-next'

import LayoutClient from '@/Layouts/LayoutClient.vue'
defineOptions({layout : LayoutClient})

// State
const searchQuery = ref('')
const campaignFilter = ref('all')
const agentFilter = ref('all')
const statusFilter = ref('all')
const showActiveOnly = ref(true)
const showTagModal = ref(false)
const selectedCall = ref(null)
const totalCallsToday = ref(47)
const callsPerMinute = ref([3, 5, 2, 7, 4, 6, 8, 3, 5, 9, 4, 6])

// Available tags for calls
const availableTags = ref([
  'Important',
  'Escalate',
  'Follow-up Required',
  'Hot Lead',
  'Technical Issue',
  'Pricing Question'
])

// Sample call data
const calls = ref([
  {
    id: 1,
    leadName: 'John Smith',
    phoneNumber: '+1 (555) 123-4567',
    campaign: 'Sales Outreach',
    agent: 'Sarah AI',
    status: 'in-progress',
    duration: 245, // seconds
    intent: 'Book appointment',
    isPlaying: false,
    volume: 75,
    tags: ['Hot Lead']
  },
  {
    id: 2,
    leadName: 'Emily Johnson',
    phoneNumber: '+1 (555) 987-6543',
    campaign: 'Customer Support',
    agent: 'Alex AI',
    status: 'connecting',
    duration: 12,
    intent: null,
    isPlaying: false,
    volume: 50,
    tags: []
  },
  {
    id: 3,
    leadName: 'Michael Brown',
    phoneNumber: '+1 (555) 456-7890',
    campaign: 'Follow-up',
    agent: 'Emma AI',
    status: 'in-progress',
    duration: 180,
    intent: 'Pricing inquiry',
    isPlaying: true,
    volume: 80,
    tags: ['Pricing Question', 'Follow-up Required']
  },
  {
    id: 4,
    leadName: 'Sarah Davis',
    phoneNumber: '+1 (555) 321-0987',
    campaign: 'Sales Outreach',
    agent: 'Sarah AI',
    status: 'on-hold',
    duration: 95,
    intent: 'Technical support',
    isPlaying: false,
    volume: 60,
    tags: ['Technical Issue']
  },
  {
    id: 5,
    leadName: 'David Wilson',
    phoneNumber: '+1 (555) 654-3210',
    campaign: 'Customer Support',
    agent: 'Alex AI',
    status: 'in-progress',
    duration: 320,
    intent: 'Complaint resolution',
    isPlaying: false,
    volume: 70,
    tags: ['Escalate', 'Important']
  }
])

// Computed properties
const activeCalls = computed(() => {
  return calls.value.filter(call => call.status === 'in-progress')
})

const filteredCalls = computed(() => {
  let filtered = calls.value

  // Apply search filter
  if (searchQuery.value) {
    const query = searchQuery.value.toLowerCase()
    filtered = filtered.filter(call =>
      call.leadName.toLowerCase().includes(query) ||
      call.phoneNumber.includes(query)
    )
  }

  // Apply campaign filter
  if (campaignFilter.value !== 'all') {
    filtered = filtered.filter(call => 
      call.campaign.toLowerCase().includes(campaignFilter.value)
    )
  }

  // Apply agent filter
  if (agentFilter.value !== 'all') {
    filtered = filtered.filter(call => 
      call.agent.toLowerCase().includes(agentFilter.value)
    )
  }

  // Apply status filter
  if (statusFilter.value !== 'all') {
    filtered = filtered.filter(call => call.status === statusFilter.value)
  }

  // Apply active only filter
  if (showActiveOnly.value) {
    filtered = filtered.filter(call => 
      call.status === 'in-progress' || call.status === 'connecting'
    )
  }

  return filtered
})

// Methods
const getStatusBadgeClass = (status) => {
  const classes = {
    'connecting': 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300',
    'in-progress': 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300',
    'on-hold': 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300',
    'ended': 'bg-gray-100 text-gray-800 dark:bg-gray-900/30 dark:text-gray-300'
  }
  return classes[status] || 'bg-gray-100 text-gray-800 dark:bg-gray-900/30 dark:text-gray-300'
}

const getStatusText = (status) => {
  const texts = {
    'connecting': 'Connecting',
    'in-progress': 'In Progress',
    'on-hold': 'On Hold',
    'ended': 'Ended'
  }
  return texts[status] || status
}

const formatDuration = (seconds) => {
  const mins = Math.floor(seconds / 60)
  const secs = seconds % 60
  return `${mins}:${secs.toString().padStart(2, '0')}`
}

const toggleAudio = (callId) => {
  const call = calls.value.find(c => c.id === callId)
  if (call) {
    call.isPlaying = !call.isPlaying
  }
}

const addTag = (call) => {
  selectedCall.value = call
  showTagModal.value = true
}

const selectTag = (tag) => {
  if (selectedCall.value && !selectedCall.value.tags.includes(tag)) {
    selectedCall.value.tags.push(tag)
  }
  showTagModal.value = false
  selectedCall.value = null
}

const viewDetails = (call) => {
  // Implementation for viewing call details
  console.log('View details for call:', call.id)
}

const cancelCall = (call) => {
  // Implementation for canceling call
  if (confirm(`Are you sure you want to cancel the call with ${call.leadName}?`)) {
    call.status = 'ended'
    call.isPlaying = false
  }
}

// Simulate real-time updates
let updateInterval = null

const simulateRealTimeUpdates = () => {
  updateInterval = setInterval(() => {
    // Update call durations
    calls.value.forEach(call => {
      if (call.status === 'in-progress' || call.status === 'connecting') {
        call.duration += 1
      }
    })

    // Update calls per minute chart
    callsPerMinute.value.shift()
    callsPerMinute.value.push(Math.floor(Math.random() * 10) + 1)

    // Randomly update some call statuses
    if (Math.random() < 0.1) {
      const connectingCalls = calls.value.filter(c => c.status === 'connecting')
      if (connectingCalls.length > 0) {
        const randomCall = connectingCalls[Math.floor(Math.random() * connectingCalls.length)]
        randomCall.status = 'in-progress'
        if (!randomCall.intent) {
          const intents = ['Book appointment', 'Pricing inquiry', 'Technical support', 'General question']
          randomCall.intent = intents[Math.floor(Math.random() * intents.length)]
        }
      }
    }
  }, 1000)
}

onMounted(() => {
  simulateRealTimeUpdates()
})

onUnmounted(() => {
  if (updateInterval) {
    clearInterval(updateInterval)
  }
})
</script>

<style scoped>
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

/* Audio visualizer animation */
@keyframes audio-wave {
  0%, 100% { height: 4px; }
  50% { height: 16px; }
}

.animate-audio-wave {
  animation: audio-wave 1s ease-in-out infinite;
}

.animate-audio-wave:nth-child(2) { animation-delay: 0.1s; }
.animate-audio-wave:nth-child(3) { animation-delay: 0.2s; }
.animate-audio-wave:nth-child(4) { animation-delay: 0.3s; }
.animate-audio-wave:nth-child(5) { animation-delay: 0.4s; }
</style>