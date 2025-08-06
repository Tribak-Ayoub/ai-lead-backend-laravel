<template>
  <div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100">
    <AppNavigation />
    <main>
      <slot />
    </main>
    <AppFooter />
  </div>
</template>

<script setup>
import AppFooter from '@/Components/Layout/AppFooter.vue';
import AppNavigation from '@/Components/Layout/AppNavigation.vue';

</script>
