<template>
  
  <!-- <div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100"> -->
    <!-- <DashboardHeader /> -->
    <!-- <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8"> -->
      <DashboardStats />
      <div class="grid lg:grid-cols-3 gap-8 mt-8">
        <div class="lg:col-span-2 space-y-8">
          <DashboardCharts />
          <RecentCalls />
        </div>
        <div class="space-y-8">
          <QuickLinks />
          <LeadInsights />
        </div>
      </div>
    <!-- </div> -->
  <!-- </div> -->

</template>

<script setup>
import LayoutClient from '@/Layouts/LayoutClient.vue'
import DashboardStats from '@/Components/ClientDashboard/DashboardStats.vue'
import DashboardCharts from '@/Components/ClientDashboard/DashboardCharts.vue'
import RecentCalls from '@/Components/ClientDashboard/RecentCalls.vue'
import QuickLinks from '@/Components/ClientDashboard/QuickLinks.vue'
import LeadInsights from '@/Components/ClientDashboard/LeadInsights.vue'

defineOptions({layout : LayoutClient})

// SEO Meta

</script>