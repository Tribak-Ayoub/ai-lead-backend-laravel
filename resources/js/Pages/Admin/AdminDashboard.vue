<template>
    <div >
        <!-- Page Content -->
      <main >
        <!-- Key Metrics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
          <!-- Total Clients -->
          <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <div class="flex items-center">
              <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center">
                  <Users class="w-6 h-6 text-blue-600 dark:text-blue-400" />
                </div>
              </div>
              <div class="ml-4">
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Clients</p>
                <div class="flex items-baseline">
                  <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ metrics.totalClients }}</p>
                  <span class="ml-2 text-sm font-medium text-green-600">+12%</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Daily Calls -->
          <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <div class="flex items-center">
              <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center">
                  <Phone class="w-6 h-6 text-green-600 dark:text-green-400" />
                </div>
              </div>
              <div class="ml-4">
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Daily Calls</p>
                <div class="flex items-baseline">
                  <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ metrics.dailyCalls.toLocaleString() }}</p>
                  <span class="ml-2 text-sm font-medium text-green-600">+8%</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Monthly Revenue -->
          <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <div class="flex items-center">
              <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center">
                  <DollarSign class="w-6 h-6 text-purple-600 dark:text-purple-400" />
                </div>
              </div>
              <div class="ml-4">
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Monthly Revenue</p>
                <div class="flex items-baseline">
                  <p class="text-2xl font-bold text-gray-900 dark:text-white">${{ metrics.monthlyRevenue.toLocaleString() }}</p>
                  <span class="ml-2 text-sm font-medium text-green-600">+15%</span>
                </div>
              </div>
            </div>
          </div>

          <!-- System Health -->
          <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <div class="flex items-center">
              <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-orange-100 dark:bg-orange-900 rounded-lg flex items-center justify-center">
                  <Activity class="w-6 h-6 text-orange-600 dark:text-orange-400" />
                </div>
              </div>
              <div class="ml-4">
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">System Uptime</p>
                <div class="flex items-baseline">
                  <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ metrics.uptime }}%</p>
                  <span class="ml-2 text-sm font-medium text-green-600">Excellent</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Charts and Analytics -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
          <!-- Call Volume Chart -->
          <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
              <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Call Volume (Last 7 Days)</h3>
              <select class="text-sm border border-gray-300 rounded-lg px-3 py-1 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <option>Last 7 days</option>
                <option>Last 30 days</option>
                <option>Last 90 days</option>
              </select>
            </div>
            <div class="h-64 flex items-end justify-between space-x-2">
              <div v-for="(day, index) in callVolumeData" :key="index" class="flex flex-col items-center flex-1">
                <div class="w-full bg-blue-200 dark:bg-blue-800 rounded-t" :style="{ height: (day.calls / Math.max(...callVolumeData.map(d => d.calls))) * 200 + 'px' }">
                  <div class="w-full bg-blue-600 rounded-t" :style="{ height: '100%' }"></div>
                </div>
                <span class="text-xs text-gray-500 dark:text-gray-400 mt-2">{{ day.day }}</span>
                <span class="text-xs font-medium text-gray-700 dark:text-gray-300">{{ day.calls.toLocaleString() }}</span>
              </div>
            </div>
          </div>

          <!-- Revenue Trend -->
          <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
              <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Revenue Trend</h3>
              <div class="flex items-center gap-2">
                <span class="text-sm text-gray-500 dark:text-gray-400">This month:</span>
                <span class="text-sm font-medium text-green-600">+15.3%</span>
              </div>
            </div>
            <div class="h-64 flex items-end justify-between space-x-1">
              <div v-for="(month, index) in revenueData" :key="index" class="flex flex-col items-center flex-1">
                <div class="w-full bg-purple-200 dark:bg-purple-800 rounded-t" :style="{ height: (month.revenue / Math.max(...revenueData.map(d => d.revenue))) * 200 + 'px' }">
                  <div class="w-full bg-purple-600 rounded-t" :style="{ height: '100%' }"></div>
                </div>
                <span class="text-xs text-gray-500 dark:text-gray-400 mt-2">{{ month.month }}</span>
                <span class="text-xs font-medium text-gray-700 dark:text-gray-300">${{ month.revenue }}k</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Recent Activity and System Status -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
          <!-- Recent Activity -->
          <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
              <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Recent Activity</h3>
            </div>
            <div class="p-6">
              <div class="space-y-4">
                <div v-for="activity in recentActivity" :key="activity.id" class="flex items-start space-x-3">
                  <div class="flex-shrink-0">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center" :class="getActivityIconClass(activity.type)">
                      <component :is="getActivityIcon(activity.type)" class="w-4 h-4" />
                    </div>
                  </div>
                  <div class="flex-1 min-w-0">
                    <p class="text-sm text-gray-900 dark:text-white">{{ activity.message }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ activity.time }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- System Status -->
          <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
              <h3 class="text-lg font-semibold text-gray-900 dark:text-white">System Status</h3>
            </div>
            <div class="p-6">
              <div class="space-y-4">
                <div v-for="service in systemStatus" :key="service.name" class="flex items-center justify-between">
                  <div class="flex items-center space-x-3">
                    <div class="w-2 h-2 rounded-full" :class="service.status === 'operational' ? 'bg-green-500' : service.status === 'warning' ? 'bg-yellow-500' : 'bg-red-500'"></div>
                    <span class="text-sm font-medium text-gray-900 dark:text-white">{{ service.name }}</span>
                  </div>
                  <span class="text-xs text-gray-500 dark:text-gray-400 capitalize">{{ service.status }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Quick Actions and Top Clients -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
          <!-- Quick Actions -->
          <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Quick Actions</h3>
            <div class="grid grid-cols-2 gap-4">
              <button class="flex flex-col items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                <UserPlus class="w-6 h-6 text-blue-600 dark:text-blue-400 mb-2" />
                <span class="text-sm font-medium text-gray-900 dark:text-white">Add Client</span>
              </button>
              <button class="flex flex-col items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                <Package class="w-6 h-6 text-green-600 dark:text-green-400 mb-2" />
                <span class="text-sm font-medium text-gray-900 dark:text-white">Create Plan</span>
              </button>
              <button class="flex flex-col items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                <AlertTriangle class="w-6 h-6 text-orange-600 dark:text-orange-400 mb-2" />
                <span class="text-sm font-medium text-gray-900 dark:text-white">View Alerts</span>
              </button>
              <button class="flex flex-col items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                <Download class="w-6 h-6 text-purple-600 dark:text-purple-400 mb-2" />
                <span class="text-sm font-medium text-gray-900 dark:text-white">Export Data</span>
              </button>
            </div>
          </div>

          <!-- Top Clients -->
          <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
              <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Top Clients</h3>
              <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">View All</button>
            </div>
            <div class="space-y-4">
              <div v-for="client in topClients" :key="client.id" class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                  <div class="w-8 h-8 bg-gray-200 dark:bg-gray-700 rounded-full flex items-center justify-center">
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ client.name.charAt(0) }}</span>
                  </div>
                  <div>
                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ client.name }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ client.plan }}</p>
                  </div>
                </div>
                <div class="text-right">
                  <p class="text-sm font-medium text-gray-900 dark:text-white">${{ client.revenue }}</p>
                  <p class="text-xs text-gray-500 dark:text-gray-400">{{ client.calls }} calls</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, watch } from 'vue'
import { 
  Menu, X, BarChart3, Users, Phone, Package, FileText, Settings, Shield, TrendingUp,
  Sun, Moon, Bell, DollarSign, Activity, UserPlus, AlertTriangle, Download
} from 'lucide-vue-next'
import LayoutAdmins from '@/Layouts/LayoutAdmins.vue';

defineOptions({layout : LayoutAdmins})
// Reactive data
const sidebarOpen = ref(false)
const darkMode = ref(false)

// Metrics data
const metrics = ref({
  totalClients: 1247,
  dailyCalls: 15420,
  monthlyRevenue: 124750,
  uptime: 99.9
})

// Call volume data for chart
const callVolumeData = ref([
  { day: 'Mon', calls: 12500 },
  { day: 'Tue', calls: 14200 },
  { day: 'Wed', calls: 13800 },
  { day: 'Thu', calls: 15420 },
  { day: 'Fri', calls: 16100 },
  { day: 'Sat', calls: 11200 },
  { day: 'Sun', calls: 9800 }
])

// Revenue data for chart
const revenueData = ref([
  { month: 'Jan', revenue: 98 },
  { month: 'Feb', revenue: 105 },
  { month: 'Mar', revenue: 112 },
  { month: 'Apr', revenue: 118 },
  { month: 'May', revenue: 125 },
  { month: 'Jun', revenue: 132 }
])

// Recent activity
const recentActivity = ref([
  {
    id: 1,
    type: 'user',
    message: 'New client "TechCorp Solutions" registered with Professional plan',
    time: '2 minutes ago'
  },
  {
    id: 2,
    type: 'alert',
    message: 'High call volume detected - Auto-scaling triggered',
    time: '15 minutes ago'
  },
  {
    id: 3,
    type: 'payment',
    message: 'Payment of $299 received from "Real Estate Pro"',
    time: '1 hour ago'
  },
  {
    id: 4,
    type: 'system',
    message: 'AI model retrained for campaign "Insurance Leads Q1"',
    time: '2 hours ago'
  },
  {
    id: 5,
    type: 'user',
    message: 'Client "Solar Solutions Inc" upgraded to Enterprise plan',
    time: '3 hours ago'
  }
])

// System status
const systemStatus = ref([
  { name: 'API Gateway', status: 'operational' },
  { name: 'Call Processing', status: 'operational' },
  { name: 'AI Services', status: 'operational' },
  { name: 'Database', status: 'operational' },
  { name: 'Payment System', status: 'warning' },
  { name: 'Backup Services', status: 'operational' }
])

// Top clients
const topClients = ref([
  { id: 1, name: 'TechCorp Solutions', plan: 'Enterprise', revenue: '2,450', calls: '1,240' },
  { id: 2, name: 'Real Estate Pro', plan: 'Professional', revenue: '1,890', calls: '890' },
  { id: 3, name: 'Insurance Leaders', plan: 'Professional', revenue: '1,650', calls: '750' },
  { id: 4, name: 'Solar Solutions Inc', plan: 'Enterprise', revenue: '3,200', calls: '1,580' },
  { id: 5, name: 'Marketing Masters', plan: 'Starter', revenue: '450', calls: '220' }
])

// Methods
const getActivityIcon = (type) => {
  switch (type) {
    case 'user': return Users
    case 'alert': return AlertTriangle
    case 'payment': return DollarSign
    case 'system': return Settings
    default: return Bell
  }
}

const getActivityIconClass = (type) => {
  switch (type) {
    case 'user': return 'bg-blue-100 text-blue-600 dark:bg-blue-900 dark:text-blue-400'
    case 'alert': return 'bg-orange-100 text-orange-600 dark:bg-orange-900 dark:text-orange-400'
    case 'payment': return 'bg-green-100 text-green-600 dark:bg-green-900 dark:text-green-400'
    case 'system': return 'bg-purple-100 text-purple-600 dark:bg-purple-900 dark:text-purple-400'
    default: return 'bg-gray-100 text-gray-600 dark:bg-gray-900 dark:text-gray-400'
  }
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
