<template>
 
    <div class="bg-gray-50 min-h-screen p-8">
      <!-- Header -->
      <div class="flex justify-between items-center mb-6">
        <div>
          <h1 class="text-2xl font-bold text-gray-900">Plans & Pricing</h1>
          <p class="text-gray-600 mt-1">Manage your subscription plans and pricing details.</p>
        </div>
        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
          + Create New Plan
        </button>
      </div>

      <!-- Table -->
      <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-100 text-sm text-gray-700 uppercase">
            <tr>
              <th class="px-6 py-4 text-left">Plan Name</th>
              <th class="px-6 py-4 text-left">Description</th>
              <th class="px-6 py-4 text-left">Price</th>
              <th class="px-6 py-4 text-left">Features</th>
              <th class="px-6 py-4 text-left">Status</th>
              <th class="px-6 py-4 text-left">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200">
            <tr v-for="plan in plans" :key="plan.name" class="hover:bg-gray-50">
              <td class="px-6 py-4 font-medium text-gray-900">{{ plan.name }}</td>
              <td class="px-6 py-4 text-gray-700">{{ plan.description }}</td>
              <td class="px-6 py-4 text-gray-700">{{ plan.price }}</td>
              <td class="px-6 py-4 text-gray-700">{{ plan.features }}</td>
              <td class="px-6 py-4">
                <span
                  class="px-3 py-1 rounded-full text-xs font-semibold"
                  :class="getStatusClass(plan.status)"
                >
                  {{ plan.status }}
                </span>
              </td>
              <td class="px-6 py-4">
                <div class="flex items-center space-x-4 text-gray-500">
                     <!-- Edit -->
                  <button @click="editPlan(plan)" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <Edit class="w-5 h-5" />
                  </button>
                  
                   <!-- Delete -->
                  <button @click="deletePlan(plan)" class="text-red-400 hover:text-red-600">
                    <Trash2 class="w-5 h-5" />
                  </button>

                  <!-- View -->
                  <button @click="viewPlan(plan)" class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400" title="View">
                    <Eye class="w-5 h-5" />
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
</template>

<script setup>
import { Edit, Eye, Pen, Trash2 } from 'lucide-vue-next'
import LayoutAdmins from '@/Layouts/LayoutAdmins.vue';

defineOptions({layout : LayoutAdmins})
const plans = [
  {
    name: 'Basic Plan',
    description: 'Ideal for small businesses starting with lead qualification.',
    price: '$49/month',
    features: 'Up to 500 leads/month, Basic reporting',
    status: 'Active',
  },
  {
    name: 'Pro Plan',
    description: 'For growing businesses needing more advanced features.',
    price: '$99/month',
    features: 'Up to 2000 leads/month, Advanced reporting, Integrations',
    status: 'Active',
  },
  {
    name: 'Enterprise Plan',
    description: 'Customizable plan for large organizations with high volume needs.',
    price: 'Contact us',
    features: 'Unlimited leads, Custom features, Dedicated support',
    status: 'Custom',
  },
]

function getStatusClass(status) {
  if (status === 'Active') return 'bg-green-100 text-green-700'
  if (status === 'Custom') return 'bg-blue-100 text-blue-700'
  return 'bg-gray-100 text-gray-700'
}

// Dummy methods
function viewPlan(plan) {
  alert(`Viewing ${plan.name}`)
}

function editPlan(plan) {
  alert(`Editing ${plan.name}`)
}

function deletePlan(plan) {
  if (confirm(`Are you sure you want to delete ${plan.name}?`)) {
    alert(`${plan.name} deleted`)
  }
}
</script>
