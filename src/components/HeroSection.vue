<script setup lang="ts">
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()
const isVisible = ref(false)
const isButtonVisible = ref(false)

const navigateToAuth = () => {
  router.push('/auth')
}

onMounted(() => {
  // Trigger the hero section animation
  setTimeout(() => {
    isVisible.value = true
  }, 100)

  // Trigger the button animation after hero section
  setTimeout(() => {
    isButtonVisible.value = true
  }, 800)
})
</script>

<template>
  <section class="relative h-screen bg-indigo-800 text-white flex items-center justify-center overflow-hidden">
    <!-- Sparkles Background -->
    <div class="sparkles-container absolute inset-0">
      <div v-for="n in 20" :key="n" class="sparkle" :style="{
        left: `${Math.random() * 100}%`,
        top: `${Math.random() * 100}%`,
        animationDelay: `${Math.random() * 3}s`,
        animationDuration: `${2 + Math.random() * 3}s`
      }"></div>
    </div>
    
    <div 
      class="absolute inset-0 bg-gradient-to-b from-transparent to-black/50"
      :class="{ 'animate-fade-in': isVisible }"
    ></div>
    
    <div class="container mx-auto px-4 text-center relative z-10">
      <div 
        class="transform transition-all duration-1000 ease-out"
        :class="[isVisible ? 'translate-y-0 opacity-100' : 'translate-y-16 opacity-0']"
      >
        <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight">
          Seu portal para o<br />
          conhecimento infinito
        </h1>
        
        <p class="text-lg md:text-xl text-gray-300 max-w-3xl mx-auto mb-8 leading-relaxed">
          Descubra milhões de livros, materiais de pesquisa e recursos digitais. Junte-se à nossa comunidade de leitores e
          aprendizes ao longo da vida.
        </p>
      </div>
      
      <button 
        @click="navigateToAuth"
        class="bg-white text-black px-8 py-3 rounded-lg font-medium hover:bg-gray-100 transition-all duration-500 ease-out transform"
        :class="[isButtonVisible ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0']"
      >
        <div class="flex items-center space-x-2">
          <span>Comece agora</span>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
          </svg>
        </div>
      </button>
    </div>
  </section>
</template>

<style scoped>
.animate-fade-in {
  animation: fadeIn 1s ease-out forwards;
}

@keyframes fadeIn {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}

.sparkles-container {
  pointer-events: none;
}

.sparkle {
  position: absolute;
  width: 4px;
  height: 4px;
  background: white;
  border-radius: 50%;
  animation: sparkle-animation ease-in-out infinite;
  opacity: 0;
}

@keyframes sparkle-animation {
  0% {
    transform: scale(0);
    opacity: 0;
  }
  50% {
    transform: scale(1);
    opacity: 0.8;
  }
  100% {
    transform: scale(0);
    opacity: 0;
  }
}
</style>