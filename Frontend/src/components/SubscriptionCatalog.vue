<script setup lang="ts">
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()
const isVisible = ref(false)

const plans = [
  {
    id: 1,
    name: 'Básico',
    price: 'R$ 49,90',
    period: '/mês',
    features: [
      'Até 50 produtos',
      'Suporte por email',
      'Relatórios básicos',
      'Integração com 1 marketplace'
    ],
    highlight: false,
    cta: 'Começar Agora'
  },
  {
    id: 2,
    name: 'Profissional',
    price: 'R$ 99,90',
    period: '/mês',
    features: [
      'Até 200 produtos',
      'Suporte prioritário',
      'Relatórios avançados',
      'Integração com 3 marketplaces',
      'API de integração',
      'Personalização de marca'
    ],
    highlight: true,
    cta: 'Escolher Profissional'
  },
  {
    id: 3,
    name: 'Enterprise',
    price: 'R$ 199,90',
    period: '/mês',
    features: [
      'Produtos ilimitados',
      'Suporte 24/7',
      'Relatórios personalizados',
      'Integrações ilimitadas',
      'API dedicada',
      'Personalização completa',
      'Gerente de conta dedicado'
    ],
    highlight: false,
    cta: 'Falar com Vendas'
  }
]

const handleSubscribe = (planId: number) => {
  router.push('/auth')
}

onMounted(() => {
  const observer = new IntersectionObserver(
    (entries) => {
      if (entries[0].isIntersecting) {
        isVisible.value = true
        observer.disconnect()
      }
    },
    { threshold: 0.2 }
  )

  const element = document.querySelector('.subscription-section')
  if (element) observer.observe(element)
})
</script>

<template>
  <section class="subscription-section py-16 bg-black text-white">
    <div class="container mx-auto px-8">
      <!-- Section Header -->
      <div 
        class="max-w-3xl mx-auto text-center mb-12 transform transition-all duration-1000"
        :class="[isVisible ? 'translate-y-0 opacity-100' : 'translate-y-16 opacity-0']"
      >
        <h2 class="text-3xl md:text-4xl font-bold mb-4">
          Escolha o Plano Ideal para Seu Negócio
        </h2>
        <p class="text-gray-400 text-lg">
          Soluções flexíveis que crescem junto com sua empresa
        </p>
      </div>

      <!-- Plans Grid -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
        <div 
          v-for="(plan, index) in plans" 
          :key="plan.id"
          class="relative transform transition-all duration-1000"
          :class="[
            isVisible ? 'translate-y-0 opacity-100' : 'translate-y-16 opacity-0',
            { 'delay-200': index === 1, 'delay-400': index === 2 }
          ]"
        >
          <!-- Plan Card -->
          <div 
            class="h-full bg-gray-800 rounded-2xl p-8 flex flex-col"
            :class="{ 'ring-2 ring-blue-500 scale-105': plan.highlight }"
          >
            <!-- Popular Badge -->
            <div 
              v-if="plan.highlight" 
              class="absolute -top-4 left-1/2 transform -translate-x-1/2"
            >
              <span class="bg-blue-500 text-white px-4 py-1 rounded-full text-sm font-medium">
                Mais Popular
              </span>
            </div>

            <!-- Plan Header -->
            <div class="mb-8">
              <h3 class="text-2xl font-bold mb-2">{{ plan.name }}</h3>
              <div class="flex items-baseline">
                <span class="text-4xl font-bold">{{ plan.price }}</span>
                <span class="text-gray-400 ml-2">{{ plan.period }}</span>
              </div>
            </div>

            <!-- Features List -->
            <ul class="space-y-4 mb-8 flex-grow">
              <li 
                v-for="feature in plan.features" 
                :key="feature"
                class="flex items-center text-gray-300"
              >
                <svg 
                  class="w-5 h-5 text-green-400 mr-3" 
                  fill="none" 
                  stroke="currentColor" 
                  viewBox="0 0 24 24"
                >
                  <path 
                    stroke-linecap="round" 
                    stroke-linejoin="round" 
                    stroke-width="2" 
                    d="M5 13l4 4L19 7"
                  />
                </svg>
                {{ feature }}
              </li>
            </ul>

            <!-- CTA Button -->
            <button
              @click="handleSubscribe(plan.id)"
              class="w-full py-3 px-6 rounded-lg font-medium transition-colors"
              :class="plan.highlight ? 
                'bg-blue-500 hover:bg-blue-600 text-white' : 
                'bg-gray-700 hover:bg-gray-600 text-white'"
            >
              {{ plan.cta }}
            </button>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
.delay-200 {
  transition-delay: 200ms;
}

.delay-400 {
  transition-delay: 400ms;
}
</style>