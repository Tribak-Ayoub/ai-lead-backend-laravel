
<template>
  <div class="min-h-screen bg-gray-50 flex">
<aside
:class="[
  'fixed top-0 left-0 h-screen w-64 bg-white shadow-lg z-50 transition-transform duration-300 ease-in-out',
  sidebarOpen ? 'translate-x-0' : '-translate-x-full'
]"

>

      <div class="flex items-center justify-between h-16 px-4 border-b border-gray-200">
        <div class="flex items-center space-x-2">
          <div
            class="w-8 h-8 bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg flex items-center justify-center"
          >
            <svg
              class="w-5 h-5 text-white"
              fill="none"
              stroke="currentColor"
              viewBox="0 0 24 24"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"
              />
            </svg>
          </div>
          <span class="text-xl font-bold text-gray-900">LeadAI</span>
        </div>

        <button
          @click="sidebarOpen = false"
          class="p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500"
        >
          <svg
            class="w-6 h-6"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M6 18L18 6M6 6l12 12"
            />
          </svg>
        </button>
      </div>

      <nav class="mt-8 px-4 space-y-2">
        <SidebarLink
          v-for="item in navigationItems"
          :key="item.name"
          :to="item.to"
          :icon="item.icon"
          :name="item.name"
          :badge="item.badge"
          @click="closeMobileSidebar"
        />
      </nav>


    </aside>

   <div
:class="[
  'flex-1 flex flex-col min-h-screen transition-all duration-300',
  sidebarOpen ? 'pl-64' : 'pl-0'
]"

    >
   <header
  class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-30 flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8"
>

        <button
          v-if="!sidebarOpen"
          @click="sidebarOpen = true"
          class="p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500"
        >
          <svg
            class="w-6 h-6"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M4 6h16M4 12h16M4 18h16"
            />
          </svg>
        </button>

        <div class="flex-1 lg:flex-none">

        </div>

          <div class="flex items-center space-x-4">
            <!-- Search (hidden on mobile) -->
            <div class="hidden md:block relative">
              <input
                type="text"
                placeholder="Search..."
                class="w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              >
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
              </div>
            </div>

            <!-- Notifications -->
            <div class="relative">
                <button
                  @click="toggleNotificationsDropdown"
                  class="flex items-center p-2 text-gray-400 hover:text-gray-500 hover:bg-gray-100 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                  <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5-5-5h5v-12" />
                  </svg>
                  <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-400 ring-2 ring-white"></span>
                </button>

              <!-- Dropdown Notification-->
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
            <!-- User dropdown -->
            <div class="relative">
              <button
                @click="toggleUserDropdown"
                class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500"
              >
                <div class="w-8 h-8 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full flex items-center justify-center">
                  <span class="text-white text-sm font-semibold">JD</span>
                </div>
                <div class="hidden md:block text-left">
                  <div class="text-sm font-medium text-gray-900">John Doe</div>
                  <div class="text-xs text-gray-500">john@company.com</div>
                </div>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7h5v-12" />
                </svg>
              </button>

              <!-- Dropdown menu -->
              <div
                v-if="userDropdownOpen"
                class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 border border-gray-200"
                @click.stop
              >
                <a href="/prfsetting" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Your Profile</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Account Settings</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Billing</a>
                <div class="border-t border-gray-100"></div>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Sign out</a>
              </div>
            </div>
          </div>

      </header>

      <main class="flex-1 m-10">
        <slot />
      </main>

      <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 ">
      <div class="max-w-7xl mx-auto px-4 py-6 flex flex-col md:flex-row items-center justify-between text-sm text-gray-500">
        <p class=" ml-6">&copy; 2025 Your Company. All rights reserved.</p>
        <div class="flex space-x-4 mt-2 md:mt-0 mr-6">
          <a href="/privacy" class=" hover:text-blue-500">Privacy</a>
          <a href="/Terms" class=" hover:text-blue-500">Terms</a>
          <a href="/privacy" class=" hover:text-blue-500 ">Contact</a>
        </div>
      </div>
    </footer>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      sidebarOpen: false,
      currentPageTitle: 'Dashboard',
      currentPageDescription: 'Welcome to your dashboard',
      navigationItems: [
        // مثال عناصر القائمة
        { name: 'Home', to: '/', icon: 'home', badge: null },
        { name: 'Leads', to: '/leads', icon: 'user', badge: 5 },
        // ... غيرها حسب احتياجك
      ],
    };
  },
  methods: {
    closeMobileSidebar() {
      // تغلق sidebar فالشاشات الصغيرة عند اختيار رابط
      this.sidebarOpen = false;
    },

  },
};
</script>



<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'
import { router } from '@inertiajs/vue3';
import SidebarLink from '../Components/Layout/SidebarLink.vue'


const sidebarOpen = ref(false)
const userDropdownOpen = ref(false)
const notificationsDropdownOpen = ref(false)

const navigationItems = ref([
  {
    name: 'Dashboard',
    to: '/dashboard',
    icon: 'M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z'
  },
  {
    name: 'Leads',
    to: '/leads',
    icon: 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z',
    badge: '23'
  },
  {
    name: 'Campaigns',
    to: '/campaigne',
    icon: 'M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z'
  },
  {
    name: 'Call Logs',
    to: '/call-logs',
    icon: 'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z'
  },
  {
    name: 'AI Intents',
    to: '/client/ai-intents',
    icon: 'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z'
  },
  {
    name: 'Billing',
    to: '/client/billing',
    icon: 'M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z'
  },
  {
    name: 'Settings',
    to: '/client/settings',
    icon: 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z'
  },
  {
    name: 'Support',
    to: '/support',
    icon: 'M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z'
  }
])

const pageInfo = {
  '/client/dashboard': { title: 'Dashboard', description: 'Overview of your lead qualification performance' },
  '/client/leads': { title: 'Leads', description: 'Manage and track your qualified leads' },
  '/client/campaigns': { title: 'Campaigns', description: 'Create and manage your marketing campaigns' },
  '/client/call-logs': { title: 'Call Logs', description: 'Review detailed call history and recordings' },
  '/client/ai-intents': { title: 'AI Intents', description: 'Configure AI qualification criteria and intents' },
  '/client/billing': { title: 'Billing', description: 'Manage your subscription and billing information' },
  '/client/settings': { title: 'Settings', description: 'Configure your account and system preferences' },
  '/client/support': { title: 'Support', description: 'Get help and contact our support team' }
}

const currentPageTitle = computed(() => {
  return pageInfo[route.path]?.title || 'Client Area'
})

const currentPageDescription = computed(() => {
  return pageInfo[route.path]?.description || 'Manage your AI-powered lead qualification system'
})

const closeMobileSidebar = () => {
  sidebarOpen.value = false
}

const handleClickOutside = (event) => {
  if (userDropdownOpen.value && !event.target.closest('.relative')) {
    userDropdownOpen.value = false

  }
   if (notificationsDropdownOpen.value && !event.target.closest('.relative')) {
    notificationsDropdownOpen.value = false

  }
}

const toggleUserDropdown = () => {
  userDropdownOpen.value = !userDropdownOpen.value
}

const toggleNotificationsDropdown =() => {
  notificationsDropdownOpen.value = !notificationsDropdownOpen.value

}

onMounted(() => {
  document.addEventListener('click', handleClickOutside)
})

onUnmounted(() => {
  document.removeEventListener('click', handleClickOutside)
})
</script>
