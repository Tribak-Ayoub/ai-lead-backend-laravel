<template>
  <LayoutPublic>
    <ProgressBar />

    <div class="w-full min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
      <div class="max-w-3xl mx-auto">
        <!-- Confirmation Title -->
        <ConfirmationHeader :order-number="orderData.orderNumber" />

        <!-- Content Section -->
        <div class="space-y-6 mt-8">
          <OrderSummaryCard :order="orderData" />
          <DeliveryInfoCard :delivery="orderData.delivery" />
          <EmailNotification :email="orderData.customerEmail" />
          <ActionButtons
            @track-order="handleTrackOrder"
            @continue-shopping="handleContinueShopping"
          />
        </div>

        <!-- Support -->
        <div class="mt-10">
          <SupportFooter />
        </div>
      </div>
    </div>
  </LayoutPublic>
</template>

<script>
import AppHeader from '@/components/layout/AppHeader.vue'
import ConfirmationHeader from '@/components/Confirmation/ConfirmationHeader.vue'
import OrderSummaryCard from '@/components/Confirmation/OrderSummaryCard.vue'
import DeliveryInfoCard from '@/components/Confirmation/DeliveryInfoCard.vue'
import EmailNotification from '@/components/Confirmation/EmailNotification.vue'
import ActionButtons from '@/components/Confirmation/ActionButtons.vue'
import SupportFooter from '@/components/Confirmation/SupportFooter.vue'
import LayoutPublic from '../layout/LayoutPublic.vue'
import ProgressBar from '@/components/Plan/ProgressBar.vue'

export default {
  name: 'CheckoutConfirmation',
  components: {
    AppHeader,
    ConfirmationHeader,
    OrderSummaryCard,
    DeliveryInfoCard,
    EmailNotification,
    ActionButtons,
    SupportFooter,
    LayoutPublic,
    ProgressBar
  },
  data() {
    return {
      orderData: {
        orderNumber: 'ORD-2024-001234',
        date: new Date().toLocaleDateString('en-US', {
          year: 'numeric',
          month: 'long',
          day: 'numeric'
        }),
        total: 149.99,
        customerEmail: 'customer@example.com',
        delivery: {
          address: {
            name: 'John Doe',
            street: '123 Main Street',
            city: 'New York',
            state: 'NY',
            zip: '10001'
          },
          estimatedDate: '3-5 business days'
        }
      }
    }
  },
  methods: {
    handleTrackOrder() {
      this.$router.push(`/orders/${this.orderData.orderNumber}`)
    },
    handleContinueShopping() {
      this.$router.push('/')
    }
  }
}
</script>

<style scoped>
/* You can add custom styles if needed */
</style>
