<template>
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <StatCard 
      v-for="stat in stats" 
      :key="stat.title"
      :title="stat.title"
      :value="stat.value"
      :change="stat.change"
      :trend="stat.trend"
      :icon="stat.icon"
      :color="stat.color"
    />
  </div>
</template>

<script setup>
import { ref } from 'vue'
import StatCard from './StatCard.vue'

const stats = ref([
  {
    title: 'Calls Today',
    value: '47',
    change: '+12%',
    trend: 'up',
    icon: 'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z',
    color: 'blue'
  },
  {
    title: 'Qualified Leads',
    value: '23',
    change: '+8%',
    trend: 'up',
    icon: 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z',
    color: 'green'
  },
  {
    title: 'Conversion Rate',
    value: '48.9%',
    change: '+2.1%',
    trend: 'up',
    icon: 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6',
    color: 'purple'
  },
  {
    title: 'Avg Call Duration',
    value: '4:32',
    change: '-0:15',
    trend: 'down',
    icon: 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
    color: 'orange'
  }
])
</script>