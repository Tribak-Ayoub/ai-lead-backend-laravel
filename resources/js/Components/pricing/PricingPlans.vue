<template>
  <section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid lg:grid-cols-3 gap-8">
        <PricingCard 
          v-for="plan in plans" 
          :key="plan.name"
          :plan="plan"
          :is-yearly="isYearly"
          :is-popular="plan.popular"
        />
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref } from 'vue'
import PricingCard from './PricingCard.vue'

const isYearly = ref(false)

const plans = ref([
  {
    name: 'Starter',
    description: 'Perfect for small businesses getting started with AI lead qualification',
    monthlyPrice: 49,
    yearlyPrice: 39,
    features: [
      'Up to 100 calls per month',
      'Real-time AI analysis',
      'Basic lead scoring',
      'Email support',
      'CRM integration (1 platform)',
      'Basic analytics dashboard'
    ],
    buttonText: 'Start Free Trial',
    popular: false
  },
  {
    name: 'Professional',
    description: 'Ideal for growing businesses with higher call volumes',
    monthlyPrice: 149,
    yearlyPrice: 119,
    features: [
      'Up to 500 calls per month',
      'Advanced AI analysis',
      'Smart lead scoring',
      'Priority support',
      'CRM integration (3 platforms)',
      'Advanced analytics & reporting',
      'Sentiment analysis',
      'Custom qualification criteria'
    ],
    buttonText: 'Start Free Trial',
    popular: true
  },
  {
    name: 'Enterprise',
    description: 'For large organizations with custom requirements',
    monthlyPrice: 399,
    yearlyPrice: 319,
    features: [
      'Unlimited calls',
      'Custom AI models',
      'Advanced lead scoring',
      'Dedicated support manager',
      'Unlimited CRM integrations',
      'Custom analytics & reporting',
      'Advanced sentiment analysis',
      'Custom qualification workflows',
      'API access',
      'White-label options'
    ],
    buttonText: 'Contact Sales',
    popular: false
  }
])
</script>