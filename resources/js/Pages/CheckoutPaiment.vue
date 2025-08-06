<template>
    <ProgressBar :step="2" />

    <div class="w-full max-w-lg mx-auto mt-5 mb-8 bg-white p-6 sm:p-8 rounded-xl shadow-lg px-5 sm:px-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-2 text-center">Checkout</h2>
        <p class="text-center text-gray-600 mb-4 text-sm sm:text-base">Step 2 of 3: Payment Information</p>

        <form @submit.prevent="handlePayment" class="space-y-4 sm:space-y-6">
            <!-- Cardholder Name -->
            <div>
                <label class="block text-gray-700 mb-1 text-sm" for="cardholderName">Cardholder Name</label>
                <input id="cardholderName" v-model="cardholderName" type="text" placeholder="John Doe"
                    @input="clearError('cardholderName')" :class="inputClass(errors.cardholderName)"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2" />
                <p v-if="errors.cardholderName" class="text-sm text-red-600 mt-1">{{ errors.cardholderName }}</p>
            </div>

            <!-- Card Number -->
            <div>
                <label class="block text-gray-700 mb-1 text-sm" for="cardNumber">Card Number</label>
                <input id="cardNumber" v-model="cardNumber" type="text" inputmode="numeric"
                    placeholder="•••• •••• •••• ••••" maxlength="19" @input="onCardNumberInput"
                    :class="inputClass(errors.cardNumber)"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2" />
                <p v-if="errors.cardNumber" class="text-sm text-red-600 mt-1">{{ errors.cardNumber }}</p>
            </div>

            <!-- Expiry & CVC -->
            <div class="flex flex-col sm:flex-row sm:space-x-4 space-y-4 sm:space-y-0">
                <div class="flex-1">
                    <label class="block text-gray-700 mb-1 text-sm" for="expiryDate">Expiry Date</label>
                    <input id="expiryDate" v-model="expiryDate" type="text" placeholder="MM / YY" maxlength="7"
                        @input="clearError('expiryDate')" :class="inputClass(errors.expiryDate)"
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2" />
                    <p v-if="errors.expiryDate" class="text-sm text-red-600 mt-1">{{ errors.expiryDate }}</p>
                </div>

                <div class="w-full sm:w-24">
                    <label class="block text-gray-700 mb-1 text-sm" for="cvc">CVC</label>
                    <input id="cvc" v-model="cvc" type="text" inputmode="numeric" placeholder="123" maxlength="4"
                        @input="onCVCInput" :class="inputClass(errors.cvc)"
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2" />
                    <p v-if="errors.cvc" class="text-sm text-red-600 mt-1">{{ errors.cvc }}</p>
                </div>
            </div>

            <!-- Billing Address -->
            <div>
                <label class="block text-gray-700 mb-1 text-sm" for="billingAddress">Billing Address</label>
                <input id="billingAddress" v-model="billingAddress" type="text" placeholder="123 Main St"
                    @input="clearError('billingAddress')" :class="inputClass(errors.billingAddress)"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2" />
                <p v-if="errors.billingAddress" class="text-sm text-red-600 mt-1">{{ errors.billingAddress }}</p>
            </div>

            <!-- City / State / Zip -->
            <div class="flex flex-col sm:flex-row sm:space-x-4 space-y-4 sm:space-y-0">
                <div class="flex-1">
                    <label class="block text-gray-700 mb-1 text-sm" for="city">City</label>
                    <input id="city" v-model="city" type="text" placeholder="Anytown" @input="clearError('city')"
                        :class="inputClass(errors.city)"
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2" />
                    <p v-if="errors.city" class="text-sm text-red-600 mt-1">{{ errors.city }}</p>
                </div>

                <div class="w-full sm:w-24">
                    <label class="block text-gray-700 mb-1 text-sm" for="state">State</label>
                    <input id="state" v-model="state" type="text" placeholder="CA" @input="clearError('state')"
                        :class="inputClass(errors.state)"
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2" />
                    <p v-if="errors.state" class="text-sm text-red-600 mt-1">{{ errors.state }}</p>
                </div>

                <div class="w-full sm:w-24">
                    <label class="block text-gray-700 mb-1 text-sm" for="zipCode">Zip Code</label>
                    <input id="zipCode" v-model="zipCode" type="text" inputmode="numeric" placeholder="12345"
                        maxlength="10" @input="onZipCodeInput" :class="inputClass(errors.zipCode)"
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2" />
                    <p v-if="errors.zipCode" class="text-sm text-red-600 mt-1">{{ errors.zipCode }}</p>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" :disabled="isLoading" @click="handeleselect"
                class="w-full bg-blue-600 text-white font-semibold py-3 rounded-md hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed transition text-center">
                <span v-if="isLoading">Processing Payment...</span>
                <span v-else>Save & Continue</span>
            </button>

            <!-- Messages -->
            <p v-if="error" class="mt-4 text-center text-red-600 font-medium text-sm">❌ {{ error }}</p>
            <p v-if="isPaid" class="mt-4 text-center text-green-600 font-semibold text-sm">✅ Payment Successful!
                Thank you for your purchase.</p>

            <!-- Retour -->
            <div class="text-center mt-4">
                <button @click="goBackToPlans" type="button"
                    class="text-sm text-indigo-600 hover:underline font-medium">
                    ⬅️ Retour aux plans
                </button>
            </div>
        </form>
    </div>
</template>


<script setup>
import { ref } from 'vue'
import { router } from '@inertiajs/vue3';
import LayoutPublic from '@/Layouts/LayoutPublic.vue';
import ProgressBar from '@/Components/Plan/ProgressBar.vue';
defineOptions({ layout: LayoutPublic })

const cardholderName = ref('')
const cardNumber = ref('')
const expiryDate = ref('')
const cvc = ref('')
const billingAddress = ref('')
const city = ref('')
const state = ref('')
const zipCode = ref('')

const isLoading = ref(false)
const error = ref(null)
const isPaid = ref(false)

const errors = ref({
    cardholderName: '',
    cardNumber: '',
    expiryDate: '',
    cvc: '',
    billingAddress: '',
    city: '',
    state: '',
    zipCode: ''
})

const inputClass = (fieldError) => [
    'w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2',
    fieldError ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 focus:ring-indigo-500'
]

const handlePayment = async () => {
    error.value = null
    isPaid.value = false
    Object.keys(errors.value).forEach(key => errors.value[key] = '')

    let hasError = false

    if (!cardholderName.value) errors.value.cardholderName = 'Cardholder name is required.', hasError = true
    if (!cardNumber.value) errors.value.cardNumber = 'Card number is required.', hasError = true
    if (!expiryDate.value) errors.value.expiryDate = 'Expiry date is required.', hasError = true
    if (!cvc.value) errors.value.cvc = 'CVC is required.', hasError = true
    if (!billingAddress.value) errors.value.billingAddress = 'Billing address is required.', hasError = true
    if (!city.value) errors.value.city = 'City is required.', hasError = true
    if (!state.value) errors.value.state = 'State is required.', hasError = true
    if (!zipCode.value) errors.value.zipCode = 'Zip code is required.', hasError = true

    if (hasError) return

    isLoading.value = true
    try {
        await new Promise(resolve => setTimeout(resolve, 2000))
        isPaid.value = true
    } catch (e) {
        error.value = 'Payment failed. Please try again.'
    } finally {
        isLoading.value = false
    }
}

const clearError = (field) => {
    if (errors.value[field]) {
        errors.value[field] = ''
    }
}

const onCardNumberInput = () => {
    cardNumber.value = cardNumber.value.replace(/\D/g, '')
    if (cardNumber.value.length > 0) errors.value.cardNumber = ''
}

const onCVCInput = () => {
    cvc.value = cvc.value.replace(/\D/g, '')
    if (cvc.value.length > 0) errors.value.cvc = ''
}

const onZipCodeInput = () => {
    zipCode.value = zipCode.value.replace(/\D/g, '')
    if (zipCode.value.length > 0) errors.value.zipCode = ''
}

const goBackToPlans = () => {
    router.visit('/plans')
}
const handeleselect = () => {
    router.visit('/checkoutConfirmation')

}
</script>
