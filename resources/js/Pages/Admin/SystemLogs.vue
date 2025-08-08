<template>
  <div class="container mx-auto py-8 px-4">
    <h1 class="text-3xl font-bold text-gray-900 mb-1">System Logs</h1>
    <p class="text-gray-500 mb-6 text-sm">
      Monitor call failures, webhook issues, and model errors in real-time.
    </p>

    <!-- Tabs -->
    <nav class="border-b border-gray-200 mb-4">
      <ul class="flex space-x-8 text-sm font-medium text-gray-500">
        <li>
          <button
            @click="activeTab = 'all'"
            :class="tabClass('all')"
            class="pb-3 border-b-2"
          >
            All Logs
          </button>
        </li>
        <li>
          <button
            @click="activeTab = 'callFailure'"
            :class="tabClass('callFailure')"
            class="pb-3 border-b-2"
          >
            Call Failures
          </button>
        </li>
        <li>
          <button
            @click="activeTab = 'webhookIssue'"
            :class="tabClass('webhookIssue')"
            class="pb-3 border-b-2"
          >
            Webhook Issues
          </button>
        </li>
        <li>
          <button
            @click="activeTab = 'modelError'"
            :class="tabClass('modelError')"
            class="pb-3 border-b-2"
          >
            Model Errors
          </button>
        </li>
      </ul>
    </nav>

    <!-- Table -->
    <div class="bg-white shadow rounded-lg overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th
              scope="col"
              class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider"
            >
              TIMESTAMP
            </th>
            <th
              scope="col"
              class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider"
            >
              TYPE
            </th>
            <th
              scope="col"
              class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider"
            >
              DESCRIPTION
            </th>
            <th scope="col" class="relative px-6 py-3">
              <span class="sr-only">View Details</span>
            </th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <tr v-for="log in filteredLogs" :key="log.id">
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
              {{ log.timestamp }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span
                :class="typeBadgeClass(log.type)"
                class="inline-flex px-2 text-xs font-semibold leading-5 rounded-full"
              >
                {{ badgeText(log.type) }}
              </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
              {{ log.description }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
              <a href="#" @click.prevent="openModal(log)" class="text-blue-600 hover:text-blue-900">
                  View Details
              </a>

            </td>
          </tr>
          <tr v-if="filteredLogs.length === 0">
            <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">
              No logs found.
            </td>
          </tr>
        </tbody>
      </table>
      <div v-if="showModal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
  <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
    <h2 class="text-xl font-bold mb-4">Record Details</h2>
    <div class="mb-2">
      <span class="font-semibold">Time :</span>
      <span>{{ selectedLog.timestamp }}</span>
    </div>
    <div class="mb-2">
      <span class="font-semibold">Type :</span>
      <span>{{ badgeText(selectedLog.type) }}</span>
    </div>
    <div class="mb-4">
      <span class="font-semibold">Description:</span>
      <p class="text-gray-700">{{ selectedLog.description }}</p>
    </div>
    <div class="text-right">
      <button @click="closeModal" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
        Close
      </button>
    </div>
  </div>
</div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';

import LayoutAdmins from '@/Layouts/LayoutAdmins.vue';
defineOptions({layout : LayoutAdmins})
const logs = ref([
  {
    id: 1,
    timestamp: '2024-07-26 14:30:00',
    type: 'callFailure',
    description: "Failed to connect to the recipient's phone number.",
  },
  {
    id: 2,
    timestamp: '2024-07-26 14:25:00',
    type: 'webhookIssue',
    description: 'Error sending lead data to the CRM.',
  },
  {
    id: 3,
    timestamp: '2024-07-26 14:20:00',
    type: 'modelError',
    description: 'AI model encountered an unexpected error during lead qualification.',
  },
  {
    id: 4,
    timestamp: '2024-07-26 14:15:00',
    type: 'callFailure',
    description: "Recipient's phone number is invalid.",
  },
  {
    id: 5,
    timestamp: '2024-07-26 14:10:00',
    type: 'webhookIssue',
    description: 'CRM API returned an error.',
  },
  {
    id: 6,
    timestamp: '2024-07-26 14:05:00',
    type: 'modelError',
    description: 'AI model failed to process the lead data.',
  },
  {
    id: 7,
    timestamp: '2024-07-26 14:00:00',
    type: 'callFailure',
    description: 'Call was rejected by the recipient.',
  },
  {
    id: 8,
    timestamp: '2024-07-26 13:55:00',
    type: 'webhookIssue',
    description: 'Failed to authenticate with the CRM.',
  },
  {
    id: 9,
    timestamp: '2024-07-26 13:50:00',
    type: 'modelError',
    description: "AI model's response was invalid.",
  },
  {
    id: 10,
    timestamp: '2024-07-26 13:45:00',
    type: 'callFailure',
    description: 'Network error during the call.',
  },
]);

const activeTab = ref('all');

const filteredLogs = computed(() => {
  if (activeTab.value === 'all') return logs.value;
  return logs.value.filter(log => log.type === activeTab.value);
});

const typeBadgeClass = (type) => {
  switch (type) {
    case 'callFailure':
      return 'bg-red-200 text-red-800';
    case 'webhookIssue':
      return 'bg-yellow-200 text-yellow-800';
    case 'modelError':
      return 'bg-purple-200 text-purple-800';
    default:
      return 'bg-gray-200 text-gray-800';
  }
};

const badgeText = (type) => {
  switch (type) {
    case 'callFailure':
      return 'Call Failure';
    case 'webhookIssue':
      return 'Webhook Issue';
    case 'modelError':
      return 'Model Error';
    default:
      return 'Unknown';
  }
};

const tabClass = (tab) => {
  return activeTab.value === tab
    ? 'border-blue-600 text-blue-600'
    : 'border-transparent hover:text-gray-700 hover:border-gray-300';
};
const showModal = ref(false);
const selectedLog = ref(null);

const openModal = (log) => {
  selectedLog.value = log;
  showModal.value = true;
};

const closeModal = () => {
  showModal.value = false;
  selectedLog.value = null;
};
</script>


