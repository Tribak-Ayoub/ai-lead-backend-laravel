<template>
  <div
    v-if="show"
    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50"
    @click="handleOverlayClick"
  >
    <div
      class="bg-white rounded-lg shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto"
      @click.stop
    >
      <!-- Modal Header -->
      <div class="flex items-center justify-between p-6 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-900">
          {{ mode === 'edit' ? 'Edit Admin User' : 'Add New Admin User' }}
        </h3>
        <button
          @click="$emit('close')"
          class="p-2 hover:bg-gray-100 rounded-md transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500"
          aria-label="Close modal"
        >
          <X class="w-5 h-5" />
        </button>
      </div>

      <!-- Modal Form -->
      <form @submit.prevent="handleSubmit" class="p-6 space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <!-- Name Field -->
          <div class="space-y-2">
            <label for="name" class="block text-sm font-medium text-gray-700">Full Name *</label>
            <input
              id="name"
              v-model="formData.name"
              type="text"
              required
              placeholder="Enter full name"
              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400"
            />
          </div>

          <!-- Email Field -->
          <div class="space-y-2">
            <label for="email" class="block text-sm font-medium text-gray-700">Email Address *</label>
            <input
              id="email"
              v-model="formData.email"
              type="email"
              required
              placeholder="Enter email address"
              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400"
            />
          </div>

          <!-- Role Field -->
          <div class="space-y-2">
            <label for="role" class="block text-sm font-medium text-gray-700">Role *</label>
            <select
              id="role"
              v-model="formData.role"
              required
              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            >
              <option value="">Select a role</option>
              <option value="Super Admin">Super Admin</option>
              <option value="Admin">Admin</option>
              <option value="Moderator">Moderator</option>
            </select>
          </div>

          <!-- Status Field -->
          <div class="space-y-2">
            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
            <select
              id="status"
              v-model="formData.status"
              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            >
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
            </select>
          </div>
        </div>

        <!-- Avatar Upload -->
        <div class="space-y-2">
          <label class="block text-sm font-medium text-gray-700">Profile Picture</label>
          <div class="flex items-center space-x-4">
            <div class="flex-shrink-0">
              <img
                :src="formData.avatar || '/placeholder.svg?height=80&width=80'"
                :alt="formData.name || 'User avatar'"
                class="w-20 h-20 rounded-full object-cover border-2 border-gray-200"
              />
            </div>
            <div class="flex-1">
              <button
                type="button"
                class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors mb-2"
              >
                <Upload class="w-4 h-4 mr-2" />
                Upload Photo
              </button>
              <p class="text-xs text-gray-500">JPG, PNG up to 2MB</p>
            </div>
          </div>
        </div>

        <!-- Form Actions -->
        <div
          class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-200"
        >
          <button
            type="button"
            @click="$emit('close')"
            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors"
          >
            Cancel
          </button>
          <button
            type="submit"
            :disabled="!isFormValid"
            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
          >
            {{ mode === 'edit' ? 'Update User' : 'Create User' }}
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, watch } from 'vue'
import { X, Upload } from 'lucide-vue-next'

const props = defineProps({
  show: Boolean,
  user: Object,
  mode: {
    type: String,
    default: 'add',
  },
})

const emit = defineEmits(['close', 'save'])

const formData = ref({
  name: '',
  email: '',
  role: '',
  status: 'active',
  avatar: '',
})

const isFormValid = computed(() => {
  return (
    formData.value.name && formData.value.email && formData.value.role
  )
})

const resetForm = () => {
  formData.value = {
    name: '',
    email: '',
    role: '',
    status: 'active',
    avatar: '',
  }
}

watch(
  () => props.user,
  (newUser) => {
    if (newUser && props.mode === 'edit') {
      formData.value = {
        id: newUser.id,
        name: newUser.name,
        email: newUser.email,
        role: newUser.role,
        status: newUser.status,
        avatar: newUser.avatar,
      }
    } else {
      resetForm()
    }
  },
  { immediate: true }
)

watch(
  () => props.show,
  (newShow) => {
    if (newShow && props.mode === 'add') {
      resetForm()
    }
  }
)

const handleSubmit = () => {
  if (isFormValid.value) {
    emit('save', { ...formData.value })
  }
}

const handleOverlayClick = () => {
  emit('close')
}
</script>
