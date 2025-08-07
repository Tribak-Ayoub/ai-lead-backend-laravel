<template>
    
  <div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    
     
      <!-- Page Content -->
      <main >
        <!-- Current Plan Overview -->
        <div class="mb-8">
          <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-lg shadow-lg p-6 text-white">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
              <div class="mb-4 lg:mb-0">
                <h2 class="text-2xl font-bold mb-2">{{ currentPlan.name }}</h2>
                <p class="text-blue-100 mb-4">{{ currentPlan.description }}</p>
                <div class="flex items-center gap-4">
                  <div class="flex items-center">
                    <span class="text-3xl font-bold">${{ currentPlan.price }}</span>
                    <span class="text-blue-100 ml-1">/month</span>
                  </div>
                  <div class="flex items-center gap-2">
                    <Calendar class="w-4 h-4" />
                    <span class="text-sm">Next billing: {{ nextBillingDate }}</span>
                  </div>
                </div>
              </div>
              <div class="flex flex-col sm:flex-row gap-3">
                <button @click="showUpgradeModal = true" class="px-6 py-2 bg-white text-blue-600 rounded-lg font-medium hover:bg-gray-50 transition-colors">
                  Upgrade Plan
                </button>
                <button @click="showCancelModal = true" class="px-6 py-2 border border-blue-200 text-white rounded-lg font-medium hover:bg-blue-800 transition-colors">
                  Manage Plan
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Usage Statistics -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
          <!-- Current Usage -->
          <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Current Usage</h3>
            <div class="space-y-4">
              <div v-for="usage in usageStats" :key="usage.name">
                <div class="flex justify-between items-center mb-2">
                  <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ usage.name }}</span>
                  <span class="text-sm text-gray-500 dark:text-gray-400">{{ usage.used }} / {{ usage.limit }}</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2 dark:bg-gray-700">
                  <div class="h-2 rounded-full transition-all duration-300" :class="getUsageBarClass(usage.percentage)" :style="{ width: usage.percentage + '%' }"></div>
                </div>
                <div class="flex justify-between text-xs text-gray-500 dark:text-gray-400 mt-1">
                  <span>{{ usage.percentage }}% used</span>
                  <span v-if="usage.resetDate">Resets {{ usage.resetDate }}</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Plan Features -->
          <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Plan Features</h3>
            <div class="space-y-3">
              <div v-for="feature in currentPlan.features" :key="feature.name" class="flex items-center">
                <Check class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" />
                <div>
                  <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ feature.name }}</span>
                  <p v-if="feature.description" class="text-xs text-gray-500 dark:text-gray-400">{{ feature.description }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Payment Method & Billing History -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
          <!-- Payment Method -->
          <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
              <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Payment Method</h3>
              <button @click="showPaymentModal = true" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                Update
              </button>
            </div>
            <div class="flex items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg">
              <CreditCard class="w-8 h-8 text-gray-400 mr-4" />
              <div>
                <p class="font-medium text-gray-900 dark:text-white">•••• •••• •••• {{ paymentMethod.last4 }}</p>
                <p class="text-sm text-gray-500 dark:text-gray-400">{{ paymentMethod.brand }} • Expires {{ paymentMethod.expiry }}</p>
              </div>
            </div>
          </div>

          <!-- Quick Stats -->
          <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">This Month</h3>
            <div class="grid grid-cols-2 gap-4">
              <div class="text-center p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ monthlyStats.calls }}</p>
                <p class="text-sm text-gray-500 dark:text-gray-400">Total Calls</p>
              </div>
              <div class="text-center p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ monthlyStats.qualified }}%</p>
                <p class="text-sm text-gray-500 dark:text-gray-400">Qualified Rate</p>
              </div>
              <div class="text-center p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ monthlyStats.minutes }}</p>
                <p class="text-sm text-gray-500 dark:text-gray-400">Call Minutes</p>
              </div>
              <div class="text-center p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ monthlyStats.leads }}</p>
                <p class="text-sm text-gray-500 dark:text-gray-400">New Leads</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Billing History -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
          <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
              <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Billing History</h3>
              <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                Download All
              </button>
            </div>
          </div>
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
              <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Description</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Amount</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Invoice</th>
                </tr>
              </thead>
              <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                <tr v-for="invoice in billingHistory" :key="invoice.id">
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">{{ invoice.date }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">{{ invoice.description }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">${{ invoice.amount }}</td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full" :class="getStatusBadgeClass(invoice.status)">
                      {{ invoice.status }}
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm">
                    <button class="text-blue-600 hover:text-blue-800 font-medium">
                      <Download class="w-4 h-4 inline mr-1" />
                      Download
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </main>
    </div>

    <!-- Upgrade Plan Modal -->
    <div v-if="showUpgradeModal" class="fixed inset-0 z-50 overflow-y-auto">
      <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="showUpgradeModal = false"></div>
        
        <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
          <div class="bg-white dark:bg-gray-800 px-6 pt-6 pb-4">
            <div class="flex items-center justify-between mb-6">
              <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Choose Your Plan</h3>
              <button @click="showUpgradeModal = false" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                <X class="w-6 h-6" />
              </button>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
              <div v-for="plan in availablePlans" :key="plan.id" class="border rounded-lg p-6 relative" :class="plan.id === currentPlan.id ? 'border-blue-500 bg-blue-50 dark:bg-blue-900/20' : 'border-gray-200 dark:border-gray-700'">
                <div v-if="plan.id === currentPlan.id" class="absolute top-4 right-4">
                  <span class="bg-blue-500 text-white px-2 py-1 rounded-full text-xs font-medium">Current</span>
                </div>
                <div v-if="plan.popular" class="absolute top-4 right-4">
                  <span class="bg-green-500 text-white px-2 py-1 rounded-full text-xs font-medium">Popular</span>
                </div>
                
                <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">{{ plan.name }}</h4>
                <p class="text-gray-500 dark:text-gray-400 text-sm mb-4">{{ plan.description }}</p>
                <div class="mb-4">
                  <span class="text-3xl font-bold text-gray-900 dark:text-white">${{ plan.price }}</span>
                  <span class="text-gray-500 dark:text-gray-400">/month</span>
                </div>
                
                <ul class="space-y-2 mb-6">
                  <li v-for="feature in plan.features" :key="feature.name" class="flex items-center text-sm">
                    <Check class="w-4 h-4 text-green-500 mr-2 flex-shrink-0" />
                    <span class="text-gray-700 dark:text-gray-300">{{ feature.name }}</span>
                  </li>
                </ul>
                
                <button v-if="plan.id !== currentPlan.id" @click="upgradeToPlan(plan)" class="w-full py-2 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                  {{ plan.price > currentPlan.price ? 'Upgrade' : 'Downgrade' }}
                </button>
                <button v-else disabled class="w-full py-2 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-400 bg-gray-100 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600">
                  Current Plan
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Cancel/Manage Plan Modal -->
    <div v-if="showCancelModal" class="fixed inset-0 z-50 overflow-y-auto">
      <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="showCancelModal = false"></div>
        
        <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
          <div class="bg-white dark:bg-gray-800 px-6 pt-6 pb-4">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Manage Subscription</h3>
            
            <div class="space-y-4">
              <button class="w-full text-left p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700">
                <div class="flex items-center">
                  <Pause class="w-5 h-5 text-orange-500 mr-3" />
                  <div>
                    <p class="font-medium text-gray-900 dark:text-white">Pause Subscription</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Temporarily pause your subscription</p>
                  </div>
                </div>
              </button>
              
              <button class="w-full text-left p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700">
                <div class="flex items-center">
                  <ArrowDown class="w-5 h-5 text-blue-500 mr-3" />
                  <div>
                    <p class="font-medium text-gray-900 dark:text-white">Downgrade Plan</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Switch to a lower tier plan</p>
                  </div>
                </div>
              </button>
              
              <button @click="confirmCancel = true" class="w-full text-left p-4 border border-red-200 dark:border-red-800 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20">
                <div class="flex items-center">
                  <AlertTriangle class="w-5 h-5 text-red-500 mr-3" />
                  <div>
                    <p class="font-medium text-red-900 dark:text-red-400">Cancel Subscription</p>
                    <p class="text-sm text-red-600 dark:text-red-500">Permanently cancel your subscription</p>
                  </div>
                </div>
              </button>
            </div>
          </div>
          
          <div class="bg-gray-50 dark:bg-gray-700 px-6 py-3">
            <button @click="showCancelModal = false" class="w-full py-2 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-gray-600 dark:text-gray-300 dark:border-gray-500 dark:hover:bg-gray-500">
              Close
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Payment Method Modal -->
    <div v-if="showPaymentModal" class="fixed inset-0 z-50 overflow-y-auto">
      <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="showPaymentModal = false"></div>
        
        <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full">
          <div class="bg-white dark:bg-gray-800 px-6 pt-6 pb-4">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Update Payment Method</h3>
            
            <form class="space-y-4">
              <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Card Number</label>
                <input type="text" placeholder="1234 5678 9012 3456" class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
              </div>
              
              <div class="grid grid-cols-2 gap-4">
                <div>
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Expiry</label>
                  <input type="text" placeholder="MM/YY" class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">CVC</label>
                  <input type="text" placeholder="123" class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>
              </div>
              
              <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Cardholder Name</label>
                <input type="text" placeholder="John Doe" class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
              </div>
            </form>
          </div>
          
          <div class="bg-gray-50 dark:bg-gray-700 px-6 py-3 flex justify-end gap-3">
            <button @click="showPaymentModal = false" class="py-2 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-gray-600 dark:text-gray-300 dark:border-gray-500 dark:hover:bg-gray-500">
              Cancel
            </button>
            <button @click="updatePaymentMethod" class="py-2 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
              Update Card
            </button>
          </div>
        </div>
      </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, watch } from 'vue'
import { 
  Menu, X, BarChart3, Users, Phone, Target, Brain, CreditCard, Settings,
  Sun, Moon, Calendar, Check, Download, Pause, ArrowDown, AlertTriangle
} from 'lucide-vue-next'

import LayoutClient from '@/Layouts/LayoutClient.vue'
defineOptions({layout : LayoutClient})
// Reactive data
const sidebarOpen = ref(false)
const darkMode = ref(false)
const showUpgradeModal = ref(false)
const showCancelModal = ref(false)
const showPaymentModal = ref(false)
const confirmCancel = ref(false)

// Current plan data
const currentPlan = ref({
  id: 'pro',
  name: 'Professional Plan',
  description: 'Perfect for growing businesses',
  price: 99,
  features: [
    { name: '1,000 calls per month', description: 'AI-powered lead qualification' },
    { name: 'Advanced AI intents', description: 'Custom intent training' },
    { name: 'Real-time analytics', description: 'Detailed performance metrics' },
    { name: 'CRM integrations', description: 'Connect with popular CRMs' },
    { name: 'Priority support', description: '24/7 email and chat support' }
  ]
})

const nextBillingDate = ref('March 15, 2024')

// Usage statistics
const usageStats = ref([
  {
    name: 'Monthly Calls',
    used: 742,
    limit: 1000,
    percentage: 74,
    resetDate: 'March 1st'
  },
  {
    name: 'AI Training Hours',
    used: 12,
    limit: 20,
    percentage: 60,
    resetDate: 'March 1st'
  },
  {
    name: 'Storage (GB)',
    used: 8.5,
    limit: 50,
    percentage: 17,
    resetDate: null
  },
  {
    name: 'API Requests',
    used: 15420,
    limit: 25000,
    percentage: 62,
    resetDate: 'March 1st'
  }
])

// Payment method
const paymentMethod = ref({
  brand: 'Visa',
  last4: '4242',
  expiry: '12/25'
})

// Monthly stats
const monthlyStats = ref({
  calls: 742,
  qualified: 68,
  minutes: 1240,
  leads: 156
})

// Billing history
const billingHistory = ref([
  {
    id: '1',
    date: 'Feb 15, 2024',
    description: 'Professional Plan - Monthly',
    amount: '99.00',
    status: 'Paid'
  },
  {
    id: '2',
    date: 'Jan 15, 2024',
    description: 'Professional Plan - Monthly',
    amount: '99.00',
    status: 'Paid'
  },
  {
    id: '3',
    date: 'Dec 15, 2023',
    description: 'Professional Plan - Monthly',
    amount: '99.00',
    status: 'Paid'
  },
  {
    id: '4',
    date: 'Nov 15, 2023',
    description: 'Starter Plan - Monthly',
    amount: '29.00',
    status: 'Paid'
  },
  {
    id: '5',
    date: 'Oct 15, 2023',
    description: 'Starter Plan - Monthly',
    amount: '29.00',
    status: 'Failed'
  }
])

// Available plans
const availablePlans = ref([
  {
    id: 'starter',
    name: 'Starter',
    description: 'Perfect for small businesses',
    price: 29,
    features: [
      { name: '250 calls per month' },
      { name: 'Basic AI intents' },
      { name: 'Standard analytics' },
      { name: 'Email support' }
    ]
  },
  {
    id: 'pro',
    name: 'Professional',
    description: 'Perfect for growing businesses',
    price: 99,
    popular: true,
    features: [
      { name: '1,000 calls per month' },
      { name: 'Advanced AI intents' },
      { name: 'Real-time analytics' },
      { name: 'CRM integrations' },
      { name: 'Priority support' }
    ]
  },
  {
    id: 'enterprise',
    name: 'Enterprise',
    description: 'For large organizations',
    price: 299,
    features: [
      { name: 'Unlimited calls' },
      { name: 'Custom AI models' },
      { name: 'Advanced analytics' },
      { name: 'All integrations' },
      { name: 'Dedicated support' },
      { name: 'SLA guarantee' }
    ]
  }
])

// Methods
const getUsageBarClass = (percentage) => {
  if (percentage >= 90) return 'bg-red-500'
  if (percentage >= 75) return 'bg-yellow-500'
  return 'bg-blue-500'
}

const getStatusBadgeClass = (status) => {
  switch (status.toLowerCase()) {
    case 'paid':
      return 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200'
    case 'failed':
      return 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200'
    case 'pending':
      return 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200'
    default:
      return 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200'
  }
}

const upgradeToPlan = (plan) => {
  // Implementation for plan upgrade
  console.log('Upgrading to plan:', plan)
  showUpgradeModal.value = false
  // Show success message or redirect to payment
}

const updatePaymentMethod = () => {
  // Implementation for updating payment method
  console.log('Updating payment method')
  showPaymentModal.value = false
  // Show success message
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
