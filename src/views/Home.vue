<script setup lang="ts">
import Header from '../components/Header.vue'
import HeroSection from '../components/HeroSection.vue'
import ParallaxCarousel from '../components/ParallaxCarousel.vue'
import ProductSearch from '../components/ProductSearch.vue'
import SubscriptionCatalog from '../components/SubscriptionCatalog.vue'
import Footer from '../components/Footer.vue'
</script>

<template>
  <Header />
  <main>
    <HeroSection />
    <ParallaxCarousel />
  </main>
  <Footer />
</template>