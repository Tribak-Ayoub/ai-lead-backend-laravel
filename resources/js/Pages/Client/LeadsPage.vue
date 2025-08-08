
<template>

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-4 sm:mb-0">Leads</h1>
        <!-- ❌ Removed old button here -->
      </div>

  
    <!-- Sidebar -->
    

    <!-- Main content area -->
    <div class="flex-1 flex flex-col">
      

      <main class="flex-1 p-4 sm:p-6 overflow-y-auto">
        <div class="max-w-7xl mx-auto">
          <!-- Page header -->
          

          <!-- Search and filters -->
          <SearchBar 
            v-model="searchQuery"
            placeholder="Search leads..."
            button-text="Add Lead"
            @add-new="handleAddLead"
          />

          <!-- Leads table -->
          <LeadsTable 
            :leads="paginatedLeads"
            @edit="handleEditLead"
            @delete="handleDeleteLead"
            @detail="handleDetail"

          />

          <!-- Pagination -->
          <Pagination 
            :current-page="currentPage"
            :total-pages="totalPages"
            :total-items="filteredLeads.length"
            :items-per-page="itemsPerPage"
            @previous="previousPage"
            @next="nextPage"
            @go-to-page="goToPage"
          />
        </div>
      
      </main>
    </div>
</template>


<script setup>
import { ref, computed, watch } from 'vue'
import SidebarLink from '@/Components/Layout/SidebarLink.vue'
import SearchBar from '@/Components/Layout/SearchBare.vue'
import LeadsTable from '@/Components/Layout/LeadsTablee.vue'
import Pagination from '@/Components/Layout/Pagination.vue'

import LayoutClient from '@/Layouts/LayoutClient.vue'
defineOptions({layout : LayoutClient})


// State
const sidebarOpen = ref(false)
const searchQuery = ref('')
const currentPage = ref(1)
const itemsPerPage = 10

// User data
const currentUser = ref({
  name: 'John Doe',
  avatar: '/placeholder.svg?height=32&width=32'
})

// Navigation items
const navigationItems = ref([
  { name: 'Dashboard', href: '#dashboard', current: false },
  { name: 'Leads', href: '#leads', current: true },
  { name: 'Contacts', href: '#contacts', current: false },
  { name: 'Deals', href: '#deals', current: false },
  { name: 'Reports', href: '#reports', current: false },
])

// Mock leads data
const leads = ref([
  { id: 1, name: 'Alice Johnson', email: 'alice@example.com', phone: '+1 (555) 123-4567', status: 'New'  },
  { id: 2, name: 'Bob Smith', email: 'bob@example.com', phone: '+1 (555) 234-5678', status: 'Qualified'  },
  { id: 3, name: 'Carol Davis', email: 'carol@example.com', phone: '+1 (555) 345-6789', status: 'Contacted'  },
  { id: 4, name: 'David Wilson', email: 'david@example.com', phone: '+1 (555) 456-7890', status: 'New' },
  { id: 5, name: 'Eva Brown', email: 'eva@example.com', phone: '+1 (555) 567-8901', status: 'Qualified' },
  { id: 6, name: 'Frank Miller', email: 'frank@example.com', phone: '+1 (555) 678-9012', status: 'Lost' },
  { id: 7, name: 'Grace Lee', email: 'grace@example.com', phone: '+1 (555) 789-0123', status: 'Contacted' },
  { id: 8, name: 'Henry Taylor', email: 'henry@example.com', phone: '+1 (555) 890-1234', status: 'New' },
  { id: 9, name: 'Ivy Chen', email: 'ivy@example.com', phone: '+1 (555) 901-2345', status: 'Qualified' },
  { id: 10, name: 'Jack Anderson', email: 'jack@example.com', phone: '+1 (555) 012-3456', status: 'Contacted'},
  { id: 11, name: 'Kate Williams', email: 'kate@example.com', phone: '+1 (555) 123-4567', status: 'New'},
  { id: 12, name: 'Liam Garcia', email: 'liam@example.com', phone: '+1 (555) 234-5678', status: 'Lost' },
])

// Computed properties
const filteredLeads = computed(() => {
  if (!searchQuery.value) return leads.value
  return leads.value.filter(lead => 
    lead.name.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
    lead.email.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
    lead.company.toLowerCase().includes(searchQuery.value.toLowerCase())
  )
})

const totalPages = computed(() => Math.ceil(filteredLeads.value.length / itemsPerPage))

const paginatedLeads = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage
  const end = start + itemsPerPage
  return filteredLeads.value.slice(start, end)
})

// Methods
const handleNavigation = (item) => {
  // Update navigation state
  navigationItems.value.forEach(nav => nav.current = nav.name === item.name)
  console.log('Navigate to:', item.name)
}

const handleAddLead = () => {
  console.log('Add new lead')
  // Implement add lead functionality
}

const handleEditLead = (lead) => {
  console.log('Edit lead:', lead)
  // Implement edit functionality
}

const handleDetail = (lead) => {
  console.log('Detail lead:', lead)
  // Navigate to static details page
  window.location.href = '/leads/details'
}


const handleDeleteLead = (leadId) => {
  if (confirm('Are you sure you want to delete this lead?')) {
    leads.value = leads.value.filter(lead => lead.id !== leadId)
  }
}

const previousPage = () => {
  if (currentPage.value > 1) {
    currentPage.value--
  }
}

const nextPage = () => {
  if (currentPage.value < totalPages.value) {
    currentPage.value++
  }
}

const goToPage = (page) => {
  currentPage.value = page
}

// Watch for search changes to reset pagination
watch(searchQuery, () => {
  currentPage.value = 1
})
</script>