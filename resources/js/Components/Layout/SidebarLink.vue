<template>
  <Link
    :href="to"
    :class="[
      'group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors duration-200',
      isActive
        ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-700'
        : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50'
    ]"
    @click="$emit('click')"
  >
    <svg
      :class="[
        'mr-3 flex-shrink-0 h-5 w-5 transition-colors duration-200',
        isActive ? 'text-blue-500' : 'text-gray-400 group-hover:text-gray-500'
      ]"
      fill="none"
      stroke="currentColor"
      viewBox="0 0 24 24"
    >
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="icon"></path>
    </svg>

    <span class="flex-1">{{ name }}</span>

    <span
      v-if="badge"
      :class="[
        'ml-3 inline-block py-0.5 px-2 text-xs font-medium rounded-full',
        isActive
          ? 'bg-blue-100 text-blue-800'
          : 'bg-gray-100 text-gray-800 group-hover:bg-gray-200'
      ]"
    >
      {{ badge }}
    </span>
  </Link>
</template>

<script setup>

import { computed } from 'vue'
import { router , Link } from '@inertiajs/vue3'



const props = defineProps({
  href: {
    type: String,
    required: true
  },
  icon: {
    type: String,
    required: true
  },
  name: {
    type: String,
    required: true
  },
  badge: {
    type: String,
    default: null
  }
})

defineEmits(['click'])

const isActive = computed(() => {
  return route.path === props.to || route.path.startsWith(props.to + '/')
})
</script>
