<template>
  <div class="min-h-screen bg-gray-50 flex">
    <!-- Sidebar -->
    <aside
      :class="[
        'fixed top-0 left-0 h-screen w-64 bg-white shadow-lg z-50 transition-transform duration-300 ease-in-out',
        sidebarOpen ? 'translate-x-0' : '-translate-x-full'
      ]"
    >
      <!-- Sidebar Header -->
      <div class="flex items-center justify-between h-16 px-4 border-b border-gray-200">
        <div class="flex items-center space-x-3">
          <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
            <span class="text-white font-bold text-sm">SA</span>
          </div>
          <span class="text-xl font-semibold text-gray-900">SuperAdmin</span>
        </div>
        <button
          @click="sidebarOpen = false"
          class="p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500"
          aria-label="Close sidebar"
        >
          <X class="w-6 h-6" />
        </button>
      </div>

      <!-- Navigation -->
      <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
        <Link
          v-for="item in navigationItems"
          :key="item.name"
          :href="item.href"
          :class="[
            'group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200',
            isActiveRoute(item.href)
              ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-600'
              : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900'
          ]"
          @click="closeMobileSidebar"
        >
          <component
            :is="item.icon"
            :class="[
              'mr-3 h-5 w-5 transition-colors duration-200',
              isActiveRoute(item.href) ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-500'
            ]"
          />
          {{ item.name }}
          <span
            v-if="item.badge"
            class="ml-auto inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800"
          >
            {{ item.badge }}
          </span>
        </Link>
      </nav>

      <!-- Sidebar footer -->
      
    </aside>

    <!-- Main content -->
    <div
      :class="[
        'flex-1 flex flex-col min-h-screen transition-all duration-300',
        sidebarOpen ? 'pl-64' : 'pl-0'
      ]"
    >
      <!-- Header -->
      <header
        class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-30 flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8"
      >
        <button
          v-if="!sidebarOpen"
          @click="sidebarOpen = true"
          class="p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500"
          aria-label="Open sidebar"
        >
          <Menu class="w-6 h-6" />
        </button>

        <div class="flex-1 lg:flex-none"></div>

        <div class="flex items-center space-x-4">
          <!-- Search -->
          <div class="hidden md:block relative">
            <input
              type="text"
              placeholder="Search..."
              class="w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            />
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <Search class="h-5 w-5 text-gray-400" />
            </div>
          </div>

          <!-- Notifications -->
          <div class="relative">
            <button
              @click="toggleNotificationsDropdown"
              class="flex items-center p-2 text-gray-400 hover:text-gray-500 hover:bg-gray-100 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500"
              aria-label="Toggle notifications"
            >
              <Bell class="w-6 h-6" />
              <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-400 ring-2 ring-white"></span>
            </button>

            <transition name="fade">
              <div
                v-if="notificationsDropdownOpen"
                class="absolute right-0 mt-2 w-64 bg-white border border-gray-200 rounded-md shadow-lg py-2 z-50"
                @click.stop
              >
                <p class="px-4 py-2 text-sm text-gray-700 font-semibold">🔔 Notifications</p>
                <a href="#" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-100">💬 You have a new message</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-100">📦 Your order has shipped</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-100">📅 Meeting at 3:00 PM</a>
              </div>
            </transition>
          </div>

          <!-- User Dropdown -->
          <div class="relative">
            <button
              @click="toggleUserDropdown"
              class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500"
              aria-label="Toggle user menu"
            >
              <div class="w-8 h-8 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full flex items-center justify-center">
                <span class="text-white text-sm font-semibold">JD</span>
              </div>
              <div class="hidden md:block text-left">
                <div class="text-sm font-medium text-gray-900">John Doe</div>
                <div class="text-xs text-gray-500">john@company.com</div>
              </div>
              <ChevronDown class="w-4 h-4 text-gray-400" />
            </button>

            <div
              v-if="userDropdownOpen"
              class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 border border-gray-200"
              @click.stop
            >
              <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Your Profile</a>
              <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Billing</a>
              <div class="border-t border-gray-100"></div>
              <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Sign out</a>
            </div>
          </div>
        </div>
      </header>

      <!-- Main slot content -->
      <main class="flex-1 m-10">
        <slot />
      </main>

      <!-- Footer -->
      <footer class="bg-white border-t border-gray-200">
        <div
          class="max-w-7xl mx-auto px-4 py-6 flex flex-col md:flex-row items-center justify-between text-sm text-gray-500"
        >
          <p class="ml-6">&copy; 2025 Your Company. All rights reserved.</p>
          <div class="flex space-x-4 mt-2 md:mt-0 mr-6">
            <a href="/privacy" class=" hover:text-blue-500">Privacy</a>
          <a href="/Terms" class=" hover:text-blue-500">Terms</a>
            <a href="#" class="hover:text-blue-500">Contact</a>
          </div>
        </div>
      </footer>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'
import { router , Link, usePage } from '@inertiajs/vue3' 
import {
  Menu,
  X,
  Search,
  Bell,
  ChevronDown,
  LayoutDashboard,
  Users,
  CreditCard,
  Phone,
  FileText,
  Settings,
  UserCog,
  BarChart3
} from 'lucide-vue-next'


const sidebarOpen = ref(false)
const userDropdownOpen = ref(false)
const notificationsDropdownOpen = ref(false)

const navigationItems = [
  { name: 'Admin-Dashboard', href: '/Admin/dashboard', icon: LayoutDashboard },
  { name: 'Client', href: 'Admin/ClientManagment', icon: Users, badge: 12 },
  { name: 'Plans', href: '/Admin/plans', icon: CreditCard },
  { name: 'ai-intents', href: '/Admin/ai-intents', icon: FileText },
  { name: 'System Logs', href: '/systemlogs', icon: FileText },
  { name: 'Settings', href: '/client/billing', icon: Settings },
  { name: 'AdminUsers', href: '/admin/users', icon: UserCog },
  { name: 'Reports', href: '/client/support', icon: BarChart3 }
]

const currentUser = ref({
  name: 'John Doe',
  role: 'Super Admin'
})

const userInitials = computed(() => {
  return currentUser.value.name
    .split(' ')
    .map(word => word[0])
    .join('')
})

const closeMobileSidebar = () => {
  sidebarOpen.value = false
}

const toggleUserDropdown = () => {
  userDropdownOpen.value = !userDropdownOpen.value
}

const toggleNotificationsDropdown = () => {
  notificationsDropdownOpen.value = !notificationsDropdownOpen.value
}

const handleClickOutside = (event) => {
  if (!event.target.closest('.relative')) {
    userDropdownOpen.value = false
    notificationsDropdownOpen.value = false
  }
}

const isActiveRoute = (href) => {
  const page = usePage()
  return page.url === href
}

onMounted(() => {
  document.addEventListener('click', handleClickOutside)
})

onUnmounted(() => {
  document.removeEventListener('click', handleClickOutside)
})
</script>
