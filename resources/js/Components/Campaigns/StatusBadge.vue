<template>
  <span :class="badgeClasses">
    <span :class="dotClasses"></span>
    {{ status === 'live' ? 'Live' : 'Paused' }}
  </span>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
  status: {
    type: String,
    required: true,
    validator: (value) => ['live', 'paused'].includes(value)
  }
})

const badgeClasses = computed(() => {
  const baseClasses = 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium'
  return props.status === 'live' 
    ? `${baseClasses} bg-green-100 text-green-800`
    : `${baseClasses} bg-gray-100 text-gray-800`
})

const dotClasses = computed(() => {
  const baseClasses = 'w-1.5 h-1.5 rounded-full mr-1.5'
  return props.status === 'live'
    ? `${baseClasses} bg-green-400`
    : `${baseClasses} bg-gray-400`
})
</script>
