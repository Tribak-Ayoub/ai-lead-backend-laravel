<template>
  <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-gray-50 hidden md:table-header-group">
        <tr>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Login</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
<tr
  v-if="loading"
  v-for="n in 4"
  :key="n"
  class="md:table-row block md:table-row border-b md:border-none mb-4 md:mb-0 rounded-lg md:rounded-none shadow-sm md:shadow-none bg-white md:bg-transparent"
>
          <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm block md:table-cell">
            <div class="animate-pulse flex space-x-4 items-center">
              <div class="h-10 w-10 rounded-full bg-gray-200"></div>
              <div class="flex-1">
                <div class="h-4 bg-gray-200 rounded w-3/4 mb-2"></div>
                <div class="h-3 bg-gray-200 rounded w-1/2"></div>
              </div>
            </div>
          </td>
        </tr>

        <tr v-else-if="users.length === 0">
          <td colspan="6" class="py-12 text-center">
            <Users class="w-12 h-12 text-gray-400 mx-auto mb-4" />
            <p class="text-lg font-medium text-gray-900 mb-2">No users found</p>
            <p class="text-gray-500">Try adjusting your filters or add a new admin user</p>
          </td>
        </tr>

        <tr v-else v-for="user in users" :key="user.id"   class="mb-2 md:table-row block md:table-row hover:bg-gray-50 transition mb-4 md:mb-0 rounded-lg md:rounded-none shadow-sm md:shadow-none bg-white md:bg-transparent"
>
          <!-- User Info -->
          <td class="px-6 py-4 text-sm block md:table-cell">
            <div class="flex items-center">
              <img :src="user.avatar" class="h-10 w-10 rounded-full mr-4 object-cover" />
              <div class="min-w-0 flex-1">
                <div class="text-sm font-medium text-gray-900 truncate">{{ user.name }}</div>
                <div class="text-sm text-gray-500 truncate">{{ user.email }}</div>
              </div>
            </div>
          </td>

          <!-- Role -->
          <td class="px-6 py-4 text-sm block md:table-cell">
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                  :class="getRoleBadgeClass(user.role)">
              {{ user.role }}
            </span>
          </td>

          <!-- Status -->
          <td class="px-6 py-4 text-sm block md:table-cell">
            <button
              @click="toggleStatus(user)"
              class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium border-0 cursor-pointer transition"
              :class="user.status === 'active' ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-red-100 text-red-800 hover:bg-red-200'"
            >
              <div class="w-2 h-2 rounded-full mr-2" :class="user.status === 'active' ? 'bg-green-400' : 'bg-red-400'"></div>
              {{ user.status === 'active' ? 'Active' : 'Inactive' }}
            </button>
          </td>

          <!-- Last Login -->
          <td class="px-6 py-4 text-sm text-gray-500 block md:table-cell">
            {{ formatDate(user.lastLogin) }}
          </td>

          <!-- Created At -->
          <td class="px-6 py-4 text-sm text-gray-500 block md:table-cell">
            {{ formatDate(user.createdAt) }}
          </td>

          <!-- Actions -->
          <td class="px-6 py-4 text-sm block md:table-cell">
            <div class="flex items-center space-x-2">
              <button @click="openModal(user)" title="View Details"
                class="p-2 rounded-md text-gray-400 hover:text-indigo-600 hover:bg-indigo-50">
                <Eye class="w-4 h-4" />
              </button>
              <button @click="editUser(user)" title="Edit"
                class="p-2 rounded-md text-blue-600 hover:text-blue-800 hover:bg-blue-50">
                <Edit class="w-4 h-4" />
              </button>
              <button @click="deleteUser(user)" title="Delete"
                class="p-2 rounded-md text-red-600 hover:text-red-800 hover:bg-red-50">
                <Trash2 class="w-4 h-4" />
              </button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- Modal -->
    <UserModal v-if="showModal" :user="selectedUser" @save="handleSave" @close="showModal = false" />
  </div>
</template>

<script setup>
import { Edit, Trash2, Users, Eye } from 'lucide-vue-next'
import { ref } from 'vue'
import UserModal from './UserModal.vue'

const emit = defineEmits(['edit', 'delete', 'toggle-status', 'view', 'save'])

const props = defineProps({
  users: Array,
  loading: Boolean
})

const formatDate = (dateString) => {
  if (!dateString) return 'Never'
  const date = new Date(dateString)
  const now = new Date()
  const diff = Math.floor((now - date) / (1000 * 60 * 60 * 24))
  if (diff === 0) return 'Today'
  if (diff === 1) return 'Yesterday'
  if (diff < 7) return `${diff} days ago`
  return date.toLocaleDateString()
}

const getRoleBadgeClass = (role) => {
  return {
    'Super Admin': 'bg-purple-100 text-purple-800',
    'Admin': 'bg-blue-100 text-blue-800',
    'Moderator': 'bg-green-100 text-green-800'
  }[role] || 'bg-gray-100 text-gray-800'
}

const showModal = ref(false)
const selectedUser = ref(null)

function openModal(user) {
  selectedUser.value = user
  showModal.value = true
  emit('view', user)
}

function editUser(user) {
  emit('edit', user)
}

function deleteUser(user) {
  emit('delete', user)
}

function toggleStatus(user) {
  emit('toggle-status', user)
}

function handleSave(updatedUser) {
  emit('save', updatedUser)
  showModal.value = false
}
</script>
