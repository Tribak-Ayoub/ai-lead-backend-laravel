<template>
  <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50/30 to-indigo-50/20 p-4 sm:p-6 lg:p-8">
    <div class="max-w-6xl mx-auto">
      <!-- Support Page Header -->
      <div class="text-center mb-12">
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold bg-gradient-to-r from-gray-900 via-blue-900 to-indigo-900 bg-clip-text text-transparent mb-4">
          Support Center
        </h1>
        <p class="text-lg sm:text-xl text-gray-600 font-medium max-w-3xl mx-auto">
          Get help with your campaigns, find answers to common questions, or contact our support team
        </p>
      </div>

      <!-- Quick Actions -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
        <div class="group bg-white/80 backdrop-blur-xl border border-white/20 rounded-2xl p-6 hover:shadow-xl transition-all duration-300 cursor-pointer">
          <div class="flex items-center mb-4">
            <div class="p-3 bg-blue-100 rounded-xl group-hover:bg-blue-200 transition-colors duration-300">
              <MessageCircleIcon class="h-6 w-6 text-blue-600" />
            </div>
            <h3 class="ml-4 text-lg font-semibold text-gray-900">Live Chat</h3>
          </div>
          <p class="text-gray-600 text-sm">Get instant help from our support team</p>
          <div class="mt-4 flex items-center text-blue-600 text-sm font-medium">
            Start Chat <ArrowRightIcon class="ml-2 h-4 w-4 group-hover:translate-x-1 transition-transform duration-200" />
          </div>
        </div>

        <div class="group bg-white/80 backdrop-blur-xl border border-white/20 rounded-2xl p-6 hover:shadow-xl transition-all duration-300 cursor-pointer">
          <div class="flex items-center mb-4">
            <div class="p-3 bg-green-100 rounded-xl group-hover:bg-green-200 transition-colors duration-300">
              <MailIcon class="h-6 w-6 text-green-600" />
            </div>
            <h3 class="ml-4 text-lg font-semibold text-gray-900">Email Support</h3>
          </div>
          <p class="text-gray-600 text-sm">Send us a detailed message</p>
          <div class="mt-4 flex items-center text-green-600 text-sm font-medium">
            Send Email <ArrowRightIcon class="ml-2 h-4 w-4 group-hover:translate-x-1 transition-transform duration-200" />
          </div>
        </div>

        <div class="group bg-white/80 backdrop-blur-xl border border-white/20 rounded-2xl p-6 hover:shadow-xl transition-all duration-300 cursor-pointer">
          <div class="flex items-center mb-4">
            <div class="p-3 bg-purple-100 rounded-xl group-hover:bg-purple-200 transition-colors duration-300">
              <PhoneIcon class="h-6 w-6 text-purple-600" />
            </div>
            <h3 class="ml-4 text-lg font-semibold text-gray-900">Phone Support</h3>
          </div>
          <p class="text-gray-600 text-sm">Call us for urgent issues</p>
          <div class="mt-4 flex items-center text-purple-600 text-sm font-medium">
            Call Now <ArrowRightIcon class="ml-2 h-4 w-4 group-hover:translate-x-1 transition-transform duration-200" />
          </div>
        </div>
      </div>

      <!-- Search Knowledge Base -->
      <div class="bg-white/80 backdrop-blur-xl border border-white/20 rounded-2xl p-6 sm:p-8 mb-12">
        <div class="text-center mb-8">
          <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-4">Search Knowledge Base</h2>
          <p class="text-gray-600">Find answers to common questions and learn how to use our platform</p>
        </div>

        <div class="max-w-2xl mx-auto">
          <div class="relative group">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-500/20 to-indigo-500/20 rounded-xl opacity-0 group-focus-within:opacity-100 transition-opacity duration-300 blur-sm"></div>
            <div class="relative bg-gray-50/50 border border-gray-200/50 rounded-xl focus-within:border-blue-400/50 focus-within:bg-white transition-all duration-300">
              <SearchIcon class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 h-5 w-5 group-focus-within:text-blue-500 transition-colors duration-200" />
              <input
                type="text"
                placeholder="Search for help articles, guides, and FAQs..."
                v-model="searchQuery"
                class="w-full pl-12 pr-4 py-4 bg-transparent text-gray-900 placeholder-gray-500 focus:outline-none text-base font-medium"
              />
              <button class="absolute right-2 top-1/2 transform -translate-y-1/2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 text-sm font-medium">
                Search
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Popular Articles -->
      <div class="mb-12">
        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-8 text-center">Popular Help Articles</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <div v-for="article in popularArticles" :key="article.id" class="group bg-white/80 backdrop-blur-xl border border-white/20 rounded-2xl p-6 hover:shadow-xl transition-all duration-300 cursor-pointer">
            <div class="flex items-start mb-4">
              <div class="p-2 bg-blue-100 rounded-lg group-hover:bg-blue-200 transition-colors duration-300">
                <component :is="article.icon" class="h-5 w-5 text-blue-600" />
              </div>
              <div class="ml-4 flex-1">
                <h3 class="font-semibold text-gray-900 group-hover:text-blue-900 transition-colors duration-200 mb-2">{{ article.title }}</h3>
                <p class="text-gray-600 text-sm">{{ article.description }}</p>
              </div>
            </div>
            <div class="flex items-center justify-between text-sm">
              <span class="text-gray-500">{{ article.readTime }} min read</span>
              <div class="flex items-center text-blue-600 font-medium">
                Read More <ArrowRightIcon class="ml-1 h-4 w-4 group-hover:translate-x-1 transition-transform duration-200" />
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- FAQ Section -->
      <div class="bg-white/80 backdrop-blur-xl border border-white/20 rounded-2xl p-6 sm:p-8 mb-12">
        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-8 text-center">Frequently Asked Questions</h2>
        <div class="max-w-4xl mx-auto space-y-4">
          <div v-for="faq in faqs" :key="faq.id" class="border border-gray-200/50 rounded-xl overflow-hidden">
            <button
              @click="toggleFaq(faq.id)"
              class="w-full px-6 py-4 text-left bg-gray-50/50 hover:bg-gray-100/50 transition-colors duration-200 flex items-center justify-between"
            >
              <span class="font-semibold text-gray-900">{{ faq.question }}</span>
              <ChevronDownIcon 
                :class="{ 'rotate-180': faq.isOpen }" 
                class="h-5 w-5 text-gray-500 transition-transform duration-200" 
              />
            </button>
            <transition
              enter-active-class="transition-all duration-300 ease-out"
              enter-from-class="opacity-0 max-h-0"
              enter-to-class="opacity-100 max-h-96"
              leave-active-class="transition-all duration-200 ease-in"
              leave-from-class="opacity-100 max-h-96"
              leave-to-class="opacity-0 max-h-0"
            >
              <div v-if="faq.isOpen" class="px-6 py-4 bg-white border-t border-gray-200/50 overflow-hidden">
                <p class="text-gray-600">{{ faq.answer }}</p>
              </div>
            </transition>
          </div>
        </div>
      </div>

      <!-- Contact Form -->
      <div class="bg-white/80 backdrop-blur-xl border border-white/20 rounded-2xl p-6 sm:p-8">
        <div class="text-center mb-8">
          <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-4">Still Need Help?</h2>
          <p class="text-gray-600">Send us a message and we'll get back to you as soon as possible</p>
        </div>

        <form @submit.prevent="submitContactForm" class="max-w-2xl mx-auto space-y-6">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div class="space-y-2">
              <label class="block text-sm font-semibold text-gray-700">Name</label>
              <input
                v-model="contactForm.name"
                type="text"
                required
                placeholder="Your full name"
                class="w-full px-4 py-3 bg-gray-50/50 border border-gray-200/50 rounded-xl focus:border-blue-400 focus:bg-white focus:ring-2 focus:ring-blue-400/20 outline-none transition-all duration-200 text-sm font-medium"
              />
            </div>
            <div class="space-y-2">
              <label class="block text-sm font-semibold text-gray-700">Email</label>
              <input
                v-model="contactForm.email"
                type="email"
                required
                placeholder="your@email.com"
                class="w-full px-4 py-3 bg-gray-50/50 border border-gray-200/50 rounded-xl focus:border-blue-400 focus:bg-white focus:ring-2 focus:ring-blue-400/20 outline-none transition-all duration-200 text-sm font-medium"
              />
            </div>
          </div>

          <div class="space-y-2">
            <label class="block text-sm font-semibold text-gray-700">Subject</label>
            <select
              v-model="contactForm.subject"
              required
              class="w-full px-4 py-3 bg-gray-50/50 border border-gray-200/50 rounded-xl focus:border-blue-400 focus:bg-white focus:ring-2 focus:ring-blue-400/20 outline-none transition-all duration-200 text-sm font-medium"
            >
              <option value="">Select a subject</option>
              <option value="technical">Technical Issue</option>
              <option value="billing">Billing Question</option>
              <option value="feature">Feature Request</option>
              <option value="general">General Inquiry</option>
            </select>
          </div>

          <div class="space-y-2">
            <label class="block text-sm font-semibold text-gray-700">Message</label>
            <textarea
              v-model="contactForm.message"
              required
              rows="5"
              placeholder="Describe your issue or question in detail..."
              class="w-full px-4 py-3 bg-gray-50/50 border border-gray-200/50 rounded-xl focus:border-blue-400 focus:bg-white focus:ring-2 focus:ring-blue-400/20 outline-none transition-all duration-200 text-sm font-medium resize-none"
            ></textarea>
          </div>

          <div class="flex items-center">
            <input
              v-model="contactForm.newsletter"
              type="checkbox"
              id="newsletter"
              class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
            />
            <label for="newsletter" class="ml-3 text-sm text-gray-600">
              Subscribe to our newsletter for updates and tips
            </label>
          </div>

          <button
            type="submit"
            class="w-full px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200"
          >
            Send Message
          </button>
        </form>
      </div>

      <!-- Support Hours -->
      <div class="mt-12 text-center">
        <div class="bg-white/60 backdrop-blur-xl border border-white/20 rounded-2xl p-6 inline-block">
          <h3 class="font-semibold text-gray-900 mb-2">Support Hours</h3>
          <p class="text-gray-600 text-sm">Monday - Friday: 9:00 AM - 6:00 PM EST</p>
          <p class="text-gray-600 text-sm">Weekend: 10:00 AM - 4:00 PM EST</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { 
  Search as SearchIcon,
  MessageCircle as MessageCircleIcon,
  Mail as MailIcon,
  Phone as PhoneIcon,
  ArrowRight as ArrowRightIcon,
  ChevronDown as ChevronDownIcon,
  BookOpen as BookOpenIcon,
  Settings as SettingsIcon,
  CreditCard as CreditCardIcon,
  Users as UsersIcon,
  BarChart as BarChartIcon,
  Shield as ShieldIcon
} from 'lucide-vue-next'

import LayoutClient from '@/Layouts/LayoutClient.vue'
defineOptions({layout : LayoutClient})

// Reactive data
const searchQuery = ref('')
const contactForm = ref({
  name: '',
  email: '',
  subject: '',
  message: '',
  newsletter: false
})

const popularArticles = ref([
  {
    id: 1,
    title: 'Getting Started with Campaigns',
    description: 'Learn how to create and manage your first marketing campaign',
    readTime: 5,
    icon: BookOpenIcon
  },
  {
    id: 2,
    title: 'Campaign Settings & Configuration',
    description: 'Understand all the settings and options available for campaigns',
    readTime: 8,
    icon: SettingsIcon
  },
  {
    id: 3,
    title: 'Billing & Subscription Management',
    description: 'Manage your subscription, billing, and payment methods',
    readTime: 4,
    icon: CreditCardIcon
  },
  {
    id: 4,
    title: 'Team Management & Permissions',
    description: 'Add team members and manage their access levels',
    readTime: 6,
    icon: UsersIcon
  },
  {
    id: 5,
    title: 'Analytics & Reporting',
    description: 'Track performance and generate detailed reports',
    readTime: 7,
    icon: BarChartIcon
  },
  {
    id: 6,
    title: 'Security & Privacy Settings',
    description: 'Keep your account and data secure with proper settings',
    readTime: 5,
    icon: ShieldIcon
  }
])

const faqs = ref([
  {
    id: 1,
    question: 'How do I create a new campaign?',
    answer: 'To create a new campaign, click the "New Campaign" button in the top right corner of the campaigns page. Fill in the required information including campaign name, target audience, and settings. Once completed, click "Create Campaign" to launch it.',
    isOpen: false
  },
  {
    id: 2,
    question: 'Can I pause or stop a campaign?',
    answer: 'Yes, you can pause or stop any campaign at any time. Simply go to your campaigns list, find the campaign you want to modify, and click the pause button. You can resume it later or permanently stop it if needed.',
    isOpen: false
  },
  {
    id: 3,
    question: 'How do I track campaign performance?',
    answer: 'Campaign performance can be tracked through the analytics dashboard. You can view metrics like conversion rates, leads qualified, and other key performance indicators. Reports can be generated for specific time periods.',
    isOpen: false
  },
  {
    id: 4,
    question: 'What payment methods do you accept?',
    answer: 'We accept all major credit cards (Visa, MasterCard, American Express), PayPal, and bank transfers for enterprise accounts. All payments are processed securely through our encrypted payment system.',
    isOpen: false
  },
  {
    id: 5,
    question: 'How do I add team members to my account?',
    answer: 'To add team members, go to Settings > Team Management. Click "Invite Member" and enter their email address. You can assign different permission levels based on their role in your organization.',
    isOpen: false
  },
  {
    id: 6,
    question: 'Is there a mobile app available?',
    answer: 'Currently, we offer a fully responsive web application that works great on mobile devices. A dedicated mobile app is in development and will be available soon for both iOS and Android platforms.',
    isOpen: false
  }
])

// Methods
const toggleFaq = (id) => {
  const faq = faqs.value.find(f => f.id === id)
  if (faq) {
    faq.isOpen = !faq.isOpen
  }
}

const submitContactForm = () => {
  // Handle form submission
  console.log('Contact form submitted:', contactForm.value)
  alert('Thank you for your message! We\'ll get back to you soon.')
  
  // Reset form
  contactForm.value = {
    name: '',
    email: '',
    subject: '',
    message: '',
    newsletter: false
  }
}
</script>