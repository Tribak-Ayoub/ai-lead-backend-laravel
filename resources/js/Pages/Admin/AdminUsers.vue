<template>
    <div class="min-h-screen bg-gray-50">
      <!-- Header -->
      <div class="bg-white border-b border-gray-200 px-4 sm:px-6 py-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
          <h1 class="text-2xl font-bold text-gray-900">User Management</h1>
          <p class="text-gray-600 text-sm">Manage admin users and their permissions</p>
        </div>
        <button
          @click="showAddModal = true"
          class="inline-flex items-center justify-center px-4 py-2 rounded-md text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 transition shadow"
        >
          <Plus class="w-4 h-4 mr-2" />
          Add New Admin
        </button>
      </div>

      <!-- Content -->
      <div class=" sm: py-6 space-y-6">
        <!-- Filters -->
        <UserFilters
          :search="filters.search"
          :role="filters.role"
          :status="filters.status"
          @update:search="val => filters.search = val"
          @update:role="val => filters.role = val"
          @update:status="val => filters.status = val"
          @reset="resetFilters"
        />

              <UserTable
          :users="paginatedUsers"
          :loading="loading"
          @edit="handleEdit"
          @delete="handleDelete"
          @toggle-status="handleToggleStatus"
        />


        <!-- Modals -->
        <UserModal
          :show="showAddModal"
          :user="selectedUser"
          :mode="modalMode"
          @save="handleSave"
          @close="closeModal"
        />

        <ConfirmModal
          :show="showDeleteModal"
          title="Delete Admin User"
          :message="`Are you sure you want to delete ${userToDelete?.name}? This action cannot be undone.`"
          @confirm="confirmDelete"
          @cancel="showDeleteModal = false"
        />
        <!-- Pagination -->
          <Pagination
            :current-page="currentPage"
            :total-pages="totalPages"
            :total-items="filteredUsers.length"
            :items-per-page="itemsPerPage"
            @previous="goToPreviousPage"
            @next="goToNextPage"
            @go-to-page="goToPage"
          />

      </div>
    </div>
</template>

<script setup>
import { ref, reactive, computed, onMounted } from 'vue'
import { Plus } from 'lucide-vue-next'

import LayoutAdmins from '@/Layouts/LayoutAdmins.vue';
defineOptions({layout : LayoutAdmins})

import UserFilters from '@/Components/admin/UserFilter.vue'
import UserTable from '@/Components/admin/UserTablee.vue';
import UserModal from '@/Components/admin/UserModal.vue'
import ConfirmModal from '@/Components/common/ConfirmModal.vue'
import Pagination from '@/Components/Layout/Pagination.vue';


// State
const loading = ref(false)
const users = ref([])
const showAddModal = ref(false)
const showDeleteModal = ref(false)
const selectedUser = ref(null)
const userToDelete = ref(null)
const modalMode = ref('add')

const filters = reactive({
  search: '',
  role: '',
  status: ''
})

// Dummy data
const mockUsers = [
  {
    id: 1,
    name: 'John Doe',
    email: 'john.doe@company.com',
    role: 'Super Admin',
    status: 'active',
    lastLogin: '2024-01-15T10:30:00Z',
    createdAt: '2023-06-01T09:00:00Z',
    avatar: '/placeholder.svg?height=40&width=40'
  },
  {
    id: 2,
    name: 'Jane Smith',
    email: 'jane.smith@company.com',
    role: 'Admin',
    status: 'active',
    lastLogin: '2024-01-14T16:45:00Z',
    createdAt: '2023-07-15T11:30:00Z',
    avatar: '/placeholder.svg?height=40&width=40'
  }
]

// Computed
const filteredUsers = computed(() => {
  return users.value.filter(user => {
    const matchesSearch =
      filters.search === '' ||
      user.name.toLowerCase().includes(filters.search.toLowerCase()) ||
      user.email.toLowerCase().includes(filters.search.toLowerCase())
    const matchesRole = !filters.role || user.role === filters.role
    const matchesStatus = !filters.status || user.status === filters.status
    return matchesSearch && matchesRole && matchesStatus
  })
})

// Methods
const resetFilters = () => {
  filters.search = ''
  filters.role = ''
  filters.status = ''
}

const loadUsers = async () => {
  loading.value = true
  await new Promise(resolve => setTimeout(resolve, 500))
  users.value = mockUsers
  loading.value = false
}

const handleEdit = user => {
  selectedUser.value = { ...user }
  modalMode.value = 'edit'
  showAddModal.value = true
}

const handleDelete = user => {
  userToDelete.value = user
  showDeleteModal.value = true
}

const confirmDelete = () => {
  users.value = users.value.filter(u => u.id !== userToDelete.value.id)
  showDeleteModal.value = false
  userToDelete.value = null
}

const handleToggleStatus = user => {
  const index = users.value.findIndex(u => u.id === user.id)
  if (index !== -1) {
    users.value[index].status = users.value[index].status === 'active' ? 'inactive' : 'active'
  }
}

const handleSave = userData => {
  if (modalMode.value === 'edit') {
    const index = users.value.findIndex(u => u.id === userData.id)
    if (index !== -1) users.value[index] = { ...userData }
  } else {
    users.value.push({
      ...userData,
      id: Date.now(),
      createdAt: new Date().toISOString(),
      lastLogin: null
    })
  }
  closeModal()
}

const closeModal = () => {
  showAddModal.value = false
  selectedUser.value = null
  modalMode.value = 'add'
}

onMounted(loadUsers)
const currentPage = ref(1)
const itemsPerPage = 5

const paginatedUsers = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage
  const end = start + itemsPerPage
  return filteredUsers.value.slice(start, end)
})

const totalPages = computed(() => Math.ceil(filteredUsers.value.length / itemsPerPage))
const goToPage = (page) => {
  currentPage.value = page
}

const goToNextPage = () => {
  if (currentPage.value < totalPages.value) {
    currentPage.value++
  }
}

const goToPreviousPage = () => {
  if (currentPage.value > 1) {
    currentPage.value--
  }
}

</script>
