<script setup lang="ts">
import { useProducts } from '../composables/useProducts'

const { products } = useProducts()
</script>

<template>
  <div>
    <h1 class="text-2xl font-bold mb-6">Dashboard</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <div class="bg-white p-6 rounded-lg shadow-sm">
        <h2 class="text-lg font-semibold mb-2">Total de Produtos</h2>
        <p class="text-3xl font-bold">{{ products.length }}</p>
      </div>
    </div>
  </div>
</template>