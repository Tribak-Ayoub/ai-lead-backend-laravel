<template>
  <LayoutPublic>
    <!-- Page Header -->
    <div class="text-center mb-12">
      <h1 class="text-4xl font-bold text-gray-900 sm:text-5xl mb-4 mt-5 ">
        Choose Your Plan
      </h1>
      <p class="text-xl text-gray-600 max-w-2xl mx-auto">
        Pick the plan that fits your needs. Upgrade or downgrade at any time.
      </p>
    </div>

    <ProgressBar />

    <!-- Pricing Cards Grid -->
    <div class="flex justify-center gap-10 flex-wrap  max-w-6xl  mx-auto">
      <Pricingplan
        v-for="plan in plans"
        :key="plan.id"
        v-bind="plan"
        :selected="selectedPlanId === plan.id"
        @select="handleSelect"
      />
    </div>

    <!-- Additional Info -->
    <div class="text-center mt-12 mb-4">
      <p class="text-gray-600 mb-2">
        All plans include a 14-day free trial. No credit card required.
      </p>
      <p class="text-sm text-gray-500">
        Questions? 
        <a href="#" class="text-blue-600 hover:text-blue-500 underline">
          Contact our sales team
        </a>
      </p>
    </div>
  </LayoutPublic>
</template>

<script setup>
import { ref } from 'vue'
import Pricingplan from '../components/Plan/Pricingplan.vue'
import ProgressBar from '../components/Plan/ProgressBar.vue'
import LayoutPublic from '../layout/LayoutPublic.vue'
import { useRouter } from 'vue-router'

const plans = ref([
  {
    id: 1,
    title: 'Basic',
    price: '$9',
    period: '/mo',
    description: 'Perfect for individuals getting started',
    features: [
      'Up to 5 projects',
      '10GB storage',
      'Email support',
      'Basic analytics',
      'SSL certificate'
    ],
    buttonText: 'Select Basic',
    isPopular: false,
    planType: 'basic'
  },
  {
    id: 2,
    title: 'Pro',
    price: '$29',
    period: '/mo',
    description: 'Best for growing businesses',
    features: [
      'Unlimited projects',
      '100GB storage',
      'Priority support',
      'Advanced analytics',
      'SSL certificate',
      'Custom domain',
      'Team collaboration',
      'API access'
    ],
    buttonText: 'Select Pro',
    isPopular: true,
    planType: 'pro'
  },
  {
    id: 3,
    title: 'Enterprise',
    price: 'Contact us',
    period: '',
    description: 'For large organizations with custom needs',
    features: [
      'Everything in Pro',
      'Unlimited storage',
      '24/7 phone support',
      'Custom integrations',
      'SLA guarantee',
      'Dedicated account manager',
      'Advanced security',
      'Custom contracts'
    ],
    buttonText: 'Contact Sales',
    isPopular: false,
    planType: 'enterprise'
  }
])
const router = useRouter()

const selectedPlanId = ref(null)

function handleSelect(selectedPlan) {
  selectedPlanId.value = selectedPlan.id
    router.push('/paiment')

}
</script>
