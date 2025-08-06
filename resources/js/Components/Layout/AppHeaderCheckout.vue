<template>
  <header class="bg-white shadow-sm border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-16">
        <div class="flex items-center">
          <router-link to="/" class="text-xl font-bold text-gray-900">
            Your Store
          </router-link>
        </div>
        <nav class="hidden md:flex space-x-8">
          <router-link to="/" class="text-gray-600 hover:text-gray-900">Home</router-link>
          <router-link to="/orders" class="text-gray-600 hover:text-gray-900">Orders</router-link>
          <router-link to="/support" class="text-gray-600 hover:text-gray-900">Support</router-link>
        </nav>
      </div>
    </div>
  </header>
</template>

<script>
export default {
  name: 'AppHeader'
}
</script>


