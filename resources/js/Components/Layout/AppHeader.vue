<template>
  <header class="bg-white shadow-sm border-b border-gray-200 fixed top-0 left-0 right-0 h-16 z-50">
    <div class="flex items-center justify-between h-16 px-4 sm:px-6">
      <button 
        @click="$emit('toggle-sidebar')"
        class="lg:hidden p-2 rounded-md text-gray-400 hover:text-gray-600 hover:bg-gray-100"
      >
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
      </button>

      <!-- هاد div لي غادي يكون الوسط -->
      <div class="flex-1 flex justify-center">
        <h2 class="text-lg font-semibold text-gray-800">Leads Management</h2>
      </div>
      
      <div class="flex items-center space-x-4">
        <button class="p-2 text-gray-400 hover:text-gray-600 rounded-full hover:bg-gray-100">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM9 7H4l5-5v5z"></path>
          </svg>
        </button>
        <div class="relative">
          <button 
            @click="toggleUserMenu"
            class="flex items-center space-x-2 p-2 rounded-full hover:bg-gray-100"
          >
            <img 
              class="w-8 h-8 rounded-full bg-gray-300" 
              :src="user.avatar || '/placeholder.svg?height=32&width=32'" 
              :alt="user.name"
            >
            <span class="hidden sm:block text-sm font-medium text-gray-700">{{ user.name }}</span>
          </button>
          
          <!-- User dropdown menu -->
          <div 
            v-if="showUserMenu"
            class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 border border-gray-200"
          >
            <a href="#profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
            <a href="#settings" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
            <hr class="my-1">
            <a href="#logout" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Sign out</a>
          </div>
        </div>
      </div>
    </div>
  </header>
</template>



<script setup>
import { ref } from 'vue'

defineProps({
  title: {
    type: String,
    default: 'Dashboard'
  },
  user: {
    type: Object,
    default: () => ({
      name: 'John Doe',
      avatar: null
    })
  }
})

defineEmits(['toggle-sidebar'])

const showUserMenu = ref(false)

const toggleUserMenu = () => {
  showUserMenu.value = !showUserMenu.value
}

// Close menu when clicking outside
import { onMounted, onUnmounted } from 'vue'

const handleClickOutside = (event) => {
  if (!event.target.closest('.relative')) {
    showUserMenu.value = false
  }
}

onMounted(() => {
  document.addEventListener('click', handleClickOutside)
})

onUnmounted(() => {
  document.removeEventListener('click', handleClickOutside)
})
</script>