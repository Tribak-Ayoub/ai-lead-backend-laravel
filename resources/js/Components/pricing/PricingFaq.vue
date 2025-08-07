<template>
  <section class="py-20 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">
          Frequently Asked Questions
        </h2>
        <p class="text-xl text-slate-600">
          Everything you need to know about our pricing and plans.
        </p>
      </div>
      
      <div class="space-y-6">
        <FaqItem 
          v-for="faq in faqs" 
          :key="faq.question"
          :question="faq.question"
          :answer="faq.answer"
        />
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref } from 'vue'
import FaqItem from './Faqltem.vue'

const faqs = ref([
  {
    question: 'Can I change my plan at any time?',
    answer: 'Yes, you can upgrade or downgrade your plan at any time. Changes take effect immediately, and we\'ll prorate any billing differences.'
  },
  {
    question: 'What happens if I exceed my call limit?',
    answer: 'If you exceed your monthly call limit, we\'ll notify you and you can either upgrade your plan or purchase additional call credits at $0.50 per call.'
  },
  {
    question: 'Do you offer a free trial?',
    answer: 'Yes! We offer a 14-day free trial with full access to Professional plan features. No credit card required to start.'
  },
  {
    question: 'Can I cancel my subscription anytime?',
    answer: 'Absolutely. You can cancel your subscription at any time with no cancellation fees. You\'ll continue to have access until the end of your billing period.'
  },
  {
    question: 'What CRM platforms do you integrate with?',
    answer: 'We integrate with popular CRM platforms including Salesforce, HubSpot, Pipedrive, Zoho, and many others. Enterprise plans include custom integrations.'
  },
  {
    question: 'Is my data secure?',
    answer: 'Yes, we take security seriously. All data is encrypted in transit and at rest, and we\'re SOC 2 Type II compliant. We never share your data with third parties.'
  },
  {
    question: 'Do you offer custom enterprise solutions?',
    answer: 'Yes, we offer custom solutions for large enterprises including on-premise deployment, custom AI models, and dedicated support. Contact our sales team for details.'
  }
])
</script>