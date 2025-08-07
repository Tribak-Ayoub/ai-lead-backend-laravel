<template>
  <div>
    <h4 class="font-semibold mb-4">{{ title }}</h4>
    <ul class="space-y-2 text-slate-400">
      <li v-for="link in links" :key="link.name">
        <a :href="link.href" class="hover:text-white transition-colors">
          {{ link.name }}
        </a>
      </li>
    </ul>
  </div>
</template>

<script setup>
defineProps({
  title: {
    type: String,
    required: true
  },
  links: {
    type: Array,
    required: true
  }
})
</script>