<script setup lang="ts">
import { ref, onMounted, onUnmounted } from 'vue'

const slides = [
  {
    id: 1,
    title: 'Eletrônicos',
    description: 'Descubra as últimas novidades em tecnologia',
    image: 'https://images.unsplash.com/photo-1498049794561-7780e7231661?auto=format&fit=crop&q=80&w=1000',
    color: 'from-blue-500'
  },
  {
    id: 2,
    title: 'Moda',
    description: 'Estilo e conforto para todos os momentos',
    image: 'https://images.unsplash.com/photo-1445205170230-053b83016050?auto=format&fit=crop&q=80&w=1000',
    color: 'from-purple-500'
  },
  {
    id: 3,
    title: 'Acessórios',
    description: 'Complemente seu visual com nossa coleção',
    image: 'https://images.unsplash.com/photo-1506152983158-b4a74a01c721?auto=format&fit=crop&q=80&w=1000',
    color: 'from-pink-500'
  }
]

const currentSlide = ref(0)
const isAnimating = ref(false)
const mouseX = ref(0)
const parallaxOffset = ref(0)
const isVisible = ref(false)

const nextSlide = () => {
  if (isAnimating.value) return
  isAnimating.value = true
  currentSlide.value = (currentSlide.value + 1) % slides.length
  setTimeout(() => {
    isAnimating.value = false
  }, 500)
}

const prevSlide = () => {
  if (isAnimating.value) return
  isAnimating.value = true
  currentSlide.value = currentSlide.value === 0 ? slides.length - 1 : currentSlide.value - 1
  setTimeout(() => {
    isAnimating.value = false
  }, 500)
}

const handleMouseMove = (e: MouseEvent) => {
  const rect = (e.currentTarget as HTMLElement).getBoundingClientRect()
  const x = e.clientX - rect.left
  mouseX.value = (x / rect.width) * 2 - 1
  parallaxOffset.value = mouseX.value * 30
}

let autoplayInterval: number

const startAutoplay = () => {
  autoplayInterval = setInterval(nextSlide, 5000)
}

const stopAutoplay = () => {
  clearInterval(autoplayInterval)
}

onMounted(() => {
  startAutoplay()
  
  const observer = new IntersectionObserver(
    (entries) => {
      if (entries[0].isIntersecting) {
        isVisible.value = true
        observer.disconnect()
      }
    },
    { threshold: 0.2 }
  )

  const element = document.querySelector('.carousel-section')
  if (element) observer.observe(element)
})

onUnmounted(() => {
  stopAutoplay()
})
</script>

<template>
  <section 
    class="carousel-section relative h-[500px] overflow-hidden bg-black transform transition-all duration-1000"
    :class="[isVisible ? 'translate-y-0 opacity-100' : 'translate-y-16 opacity-0']"
    @mousemove="handleMouseMove"
    @mouseenter="stopAutoplay"
    @mouseleave="startAutoplay"
  >
    <!-- Slides -->
    <div class="relative h-full">
      <transition-group name="slide">
        <div 
          v-for="(slide, index) in slides" 
          :key="slide.id"
          v-show="currentSlide === index"
          class="absolute inset-0"
        >
          <!-- Background Image with Parallax -->
          <div 
            class="absolute inset-0 bg-cover bg-center transition-transform duration-300"
            :style="{
              backgroundImage: `url(${slide.image})`,
              transform: `translateX(${parallaxOffset}px) scale(1.1)`,
            }"
          >
            <div :class="`absolute inset-0 bg-gradient-to-r ${slide.color} to-transparent opacity-60`"></div>
          </div>

          <!-- Content -->
          <div class="relative h-full flex items-center">
            <div class="container mx-auto px-4">
              <div class="max-w-xl px-8">
                <h2 class="text-4xl md:text-5xl px-8 font-bold text-white mb-4">
                  {{ slide.title }}
                </h2>
                <p class="text-xl px-8 text-white/90 mb-8">
                  {{ slide.description }}
                </p>
                <div class="px-8">
                <button class="bg-white text-black px-8 py-3 rounded-lg font-medium hover:bg-gray-100 transition-colors">
                  Explorar
                </button></div>
              </div>
            </div>
          </div>
        </div>
      </transition-group>
    </div>

    <!-- Navigation Buttons -->
    <div class="absolute inset-y-0 left-0 flex items-center">
      <button 
        @click="prevSlide"
        class="bg-black/30 hover:bg-black/50 text-white p-3 transition-colors"
      >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
      </button>
    </div>
    <div class="absolute inset-y-0 right-0 flex items-center">
      <button 
        @click="nextSlide"
        class="bg-black/30 hover:bg-black/50 text-white p-3 transition-colors"
      >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
      </button>
    </div>

    <!-- Slide Indicators -->
    <div class="absolute bottom-4 left-0 right-0 flex justify-center space-x-2">
      <button
        v-for="(slide, index) in slides"
        :key="slide.id"
        @click="currentSlide = index"
        class="w-3 h-3 rounded-full transition-colors"
        :class="currentSlide === index ? 'bg-white' : 'bg-white/50 hover:bg-white/75'"
      ></button>
    </div>
  </section>
</template>

<style scoped>
.slide-enter-active,
.slide-leave-active {
  transition: opacity 0.5s ease;
}

.slide-enter-from,
.slide-leave-to {
  opacity: 0;
}

.slide-enter-to,
.slide-leave-from {
  opacity: 1;
}
</style>