<template>
  <div class="flex items-center p-4 border border-slate-200 rounded-lg hover:bg-slate-50 transition-colors">
    <div class="flex-1">
      <div class="flex items-center justify-between mb-2">
        <div class="font-medium text-slate-900">{{ call.caller }}</div>
        <div class="text-sm text-slate-500">{{ call.time }}</div>
      </div>
      <div class="flex items-center space-x-4 text-sm text-slate-600">
        <span>{{ call.phone }}</span>
        <span>{{ call.duration }}</span>
        <div class="flex items-center">
          <div :class="[
            'w-2 h-2 rounded-full mr-1',
            sentimentColors[call.sentiment]
          ]"></div>
          {{ call.sentiment }}
        </div>
      </div>
    </div>  
    <div class="flex items-center space-x-3">
      <div class="text-right">
        <div class="text-lg font-semibold text-slate-900">{{ call.score }}</div>
        <div class="text-xs text-slate-500">Score</div>
      </div>
      
      <div :class="[
        'px-3 py-1 rounded-full text-xs font-medium',
        statusColors[call.status]
      ]">
        {{ statusLabels[call.status] }}
      </div>
    </div>
  </div>
</template>

<script setup>
defineProps({
  call: {
    type: Object,
    required: true
  }
})

const statusColors = {
  'qualified': 'bg-green-100 text-green-800',
  'not-qualified': 'bg-red-100 text-red-800',
  'follow-up': 'bg-yellow-100 text-yellow-800'
}

const statusLabels = {
  'qualified': 'Qualified',
  'not-qualified': 'Not Qualified',
  'follow-up': 'Follow Up'
}

const sentimentColors = {
  'positive': 'bg-green-500',
  'neutral': 'bg-yellow-500',
  'negative': 'bg-red-500'
}
</script>