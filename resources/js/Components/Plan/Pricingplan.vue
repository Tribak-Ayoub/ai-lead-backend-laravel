<template>
  <div
    class="relative w-full sm:w-[300px] md:w-[320px] h-[550px] bg-white rounded-xl shadow-md p-6 pb-4 transition duration-300 cursor-pointer hover:shadow-lg flex flex-col justify-between border border-gray-200"
    :class="selected ? 'border-2 border-blue-600 ring-2 ring-blue-200' : ''"
    @click="handleSelect"
  >
    <!-- Content Block -->
    <div class="flex-grow">
      <h2 class="text-xl font-bold text-gray-900 mb-2">{{ title }}</h2>
      <p class="text-gray-600 mb-4">{{ description }}</p>

      <p class="text-4xl font-extrabold text-gray-900 mb-4">
        {{ price }}
        <span class="text-base font-normal text-gray-500">{{ period }}</span>
      </p>

      <ul class="mb-6 space-y-2 text-gray-700">
        <li v-for="(feature, index) in features" :key="index" class="flex items-center gap-2">
          <span class="text-green-500">✔</span>
          <span>{{ feature }}</span>
        </li>
      </ul>
    </div>

    <!-- Button Always at Bottom -->
    <button
      class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded transition mt-auto"
    >
      {{ buttonText }}
    </button>
  </div>
</template>

<script setup>
const props = defineProps({
  id: Number,
  title: String,
  price: String,
  period: String,
  description: String,
  features: Array,
  buttonText: String,
  selected: Boolean,
})

const emit = defineEmits(['select'])

function handleSelect() {
  emit('select', { id: props.id, title: props.title })
}
</script>
