<template>
  <div>
    <HeroSection />
    <FeaturesSection />
    <HowltWorksSection />
    <StatsSection />
    <CtaSection />
  </div>
</template>

<script setup>
import CtaSection from '@/Components/HomePage/CtaSection.vue';
import FeaturesSection from '@/Components/HomePage/FeaturesSection.vue';
import HeroSection from '@/Components/HomePage/HeroSection.vue';
import HowltWorksSection from '@/Components/HomePage/HowltWorksSection.vue';
import StatsSection from '@/Components/HomePage/StatsSection.vue';
import LayoutPublic from '@/Layouts/LayoutPublic.vue';
defineOptions({ layout: LayoutPublic })


</script>
