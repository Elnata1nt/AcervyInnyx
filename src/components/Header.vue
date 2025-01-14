<script setup lang="ts">
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()
const isMenuOpen = ref(false)
const isVisible = ref(false)

const toggleMenu = () => {
  isMenuOpen.value = !isMenuOpen.value
}

const navigateToAuth = () => {
  router.push('/auth')
}

onMounted(() => {
  // Trigger header animation last
  setTimeout(() => {
    isVisible.value = true
  }, 1500)
})
</script>

<template>
  <header 
    class="fixed w-full z-50 bg-black/80 backdrop-blur-sm text-white transition-all duration-1000 ease-out transform"
    :class="[isVisible ? 'translate-y-0 opacity-100' : '-translate-y-full opacity-0']"
  >
    <div class="container mx-auto px-8">
      <div class="flex justify-between items-center h-16">
        <!-- Logo -->
        <div class="flex-shrink-0 px-8">
          <h1 class="text-2xl font-bold">Acervy.by</h1>
        </div>

        <!-- Desktop Menu -->
        <nav class="hidden md:flex items-center space-x-8">
          <a href="/" class="text-gray-300 hover:text-white transition-colors">Início</a>
          <a href="/about" class="text-gray-300 hover:text-white transition-colors">Sobre nos</a>
        </nav>

        <!-- Desktop Login Button -->
        <div class="hidden px-8 md:block">
          <button 
            @click="navigateToAuth"
            class="bg-white text-black hover:bg-white px-4 py-2 rounded-lg transition-colors"
          >
            Login
          </button>
        </div>

        <!-- Mobile Menu Button -->
        <button 
          class="md:hidden p-2 rounded-lg hover:bg-gray-800 focus:outline-none"
          @click="toggleMenu"
        >
          <svg 
            class="w-6 h-6" 
            fill="none" 
            stroke="currentColor" 
            viewBox="0 0 24 24"
          >
            <path 
              v-if="!isMenuOpen" 
              stroke-linecap="round" 
              stroke-linejoin="round" 
              stroke-width="2" 
              d="M4 6h16M4 12h16M4 18h16"
            />
            <path 
              v-else 
              stroke-linecap="round" 
              stroke-linejoin="round" 
              stroke-width="2" 
              d="M6 18L18 6M6 6l12 12"
            />
          </svg>
        </button>
      </div>

      <!-- Mobile Menu -->
      <div 
        v-show="isMenuOpen"
        class="md:hidden"
      >
        <div class="px-2 pt-2 pb-3 space-y-1">
          <a 
            href="#" 
            class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-800 transition-colors"
          >
            Início
          </a>
          <a 
            href="#" 
            class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-800 transition-colors"
          >
            Produtos
          </a>
          <a 
            href="#contato" 
            class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-800 transition-colors"
          >
            Contato
          </a>
          <button 
            @click="navigateToAuth"
            class="w-full text-left px-3 py-2 rounded-md text-base font-medium bg-blue-600 hover:bg-blue-700 transition-colors"
          >
            Login
          </button>
        </div>
      </div>
    </div>
  </header>
</template>