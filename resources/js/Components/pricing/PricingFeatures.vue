<template>
  <section class="py-20 bg-gradient-to-br from-slate-50 to-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">
          Compare All Features
        </h2>
        <p class="text-xl text-slate-600 max-w-2xl mx-auto">
          See exactly what's included in each plan to make the best choice for your business.
        </p>
      </div>
      
      <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="overflow-x-auto">
          <table class="w-full">
            <thead class="bg-slate-50">
              <tr>
                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Features</th>
                <th class="px-6 py-4 text-center text-sm font-semibold text-slate-900">Starter</th>
                <th class="px-6 py-4 text-center text-sm font-semibold text-slate-900 bg-blue-50">Professional</th>
                <th class="px-6 py-4 text-center text-sm font-semibold text-slate-900">Enterprise</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
              <tr v-for="feature in featureComparison" :key="feature.name" class="hover:bg-slate-50">
                <td class="px-6 py-4 text-sm font-medium text-slate-900">{{ feature.name }}</td>
                <td class="px-6 py-4 text-center">
                  <FeatureCheck :included="feature.starter" :value="feature.starterValue" />
                </td>
                <td class="px-6 py-4 text-center bg-blue-50/50">
                  <FeatureCheck :included="feature.professional" :value="feature.professionalValue" />
                </td>
                <td class="px-6 py-4 text-center">
                  <FeatureCheck :included="feature.enterprise" :value="feature.enterpriseValue" />
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref } from 'vue'
import FeatureCheck from './FeatureCheck.vue'

const featureComparison = ref([
  {
    name: 'Monthly calls',
    starter: true,
    starterValue: '100',
    professional: true,
    professionalValue: '500',
    enterprise: true,
    enterpriseValue: 'Unlimited'
  },
  {
    name: 'Real-time AI analysis',
    starter: true,
    professional: true,
    enterprise: true
  },
  {
    name: 'Lead scoring',
    starter: true,
    starterValue: 'Basic',
    professional: true,
    professionalValue: 'Smart',
    enterprise: true,
    enterpriseValue: 'Advanced'
  },
  {
    name: 'CRM integrations',
    starter: true,
    starterValue: '1',
    professional: true,
    professionalValue: '3',
    enterprise: true,
    enterpriseValue: 'Unlimited'
  },
  {
    name: 'Sentiment analysis',
    starter: false,
    professional: true,
    enterprise: true
  },
  {
    name: 'Custom qualification criteria',
    starter: false,
    professional: true,
    enterprise: true
  },
  {
    name: 'API access',
    starter: false,
    professional: false,
    enterprise: true
  },
  {
    name: 'White-label options',
    starter: false,
    professional: false,
    enterprise: true
  },
  {
    name: 'Support',
    starter: true,
    starterValue: 'Email',
    professional: true,
    professionalValue: 'Priority',
    enterprise: true,
    enterpriseValue: 'Dedicated manager'
  }
])
</script>