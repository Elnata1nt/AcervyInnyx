<script setup lang="ts">
import { ref } from 'vue'
import { BookOpenIcon, UsersIcon, GlobeIcon, SparklesIcon } from 'lucide-vue-next'

const features = ref([
  {
    icon: BookOpenIcon,
    title: 'Vasta Coleção',
    description: 'Acesso a milhões de livros de todos os gêneros e épocas.'
  },
  {
    icon: UsersIcon,
    title: 'Comunidade Ativa',
    description: 'Conecte-se com leitores apaixonados e compartilhe suas descobertas.'
  },
  {
    icon: GlobeIcon,
    title: 'Acesso Global',
    description: 'Explore literaturas de todo o mundo, sem fronteiras.'
  },
  {
    icon: SparklesIcon,
    title: 'Recomendações Personalizadas',
    description: 'Descubra novos livros baseados em seus interesses e histórico de leitura.'
  }
])

const stats = ref([
  { number: '5M+', label: 'Livros' },
  { number: '1M+', label: 'Usuários' },
  { number: '100+', label: 'Países' },
  { number: '24/7', label: 'Suporte' }
])
</script>

<template>
  <div class="bg-gray-100  min-h-screen">
    <header class="bg-indigo-800 text-white py-16">
      <div class="container mx-auto px-4">
        <h1 class="text-4xl flex justify-center items-center md:text-5xl font-bold mb-4">Sobre a Acervy.by</h1>
        <p class="text-xl flex justify-center items-center md:text-2xl">Seu portal para o conhecimento infinito</p>
      </div>
    </header>

    <main class="container mx-auto px-4 py-16">
      <section class="mb-16">
        <h2 class="text-3xl font-bold mb-8 text-center">Nossa Missão</h2>
        <p class="text-lg text-gray-700 max-w-3xl mx-auto text-center">
          Na Acervy.by, nossa missão é democratizar o acesso ao conhecimento, 
          conectando leitores a um vasto acervo de livros de todos os tipos. 
          Acreditamos que cada livro abre uma nova porta para o aprendizado, 
          a imaginação e o crescimento pessoal.
        </p>
      </section>

      <section class="mb-16">
        <h2 class="text-3xl font-bold mb-8 text-center">Recursos</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
          <div v-for="feature in features" :key="feature.title" class="bg-white p-6 rounded-lg shadow-md">
            <component :is="feature.icon" class="w-12 h-12 text-indigo-600 mb-4" />
            <h3 class="text-xl font-semibold mb-2">{{ feature.title }}</h3>
            <p class="text-gray-600">{{ feature.description }}</p>
          </div>
        </div>
      </section>

      <section class="mb-16">
        <h2 class="text-3xl font-bold mb-8 text-center">Acervy.by em Números</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
          <div v-for="stat in stats" :key="stat.label" class="text-center">
            <p class="text-4xl font-bold text-indigo-600">{{ stat.number }}</p>
            <p class="text-xl text-gray-600">{{ stat.label }}</p>
          </div>
        </div>
      </section>

      <section>
        <h2 class="text-3xl font-bold mb-8 text-center">Junte-se a Nós</h2>
        <p class="text-lg text-gray-700 max-w-3xl mx-auto text-center mb-8">
          Faça parte da nossa comunidade global de leitores e exploradores do conhecimento. 
          Com a Acervy.by, você terá o mundo dos livros ao alcance dos seus dedos.
        </p>
        <div class="text-center">
          <a href="/auth" class="bg-indigo-600 text-white px-8 py-3 rounded-lg font-medium hover:bg-indigo-700 transition-colors duration-300">
            Comece sua jornada
          </a>
        </div>
      </section>
    </main>

    <footer class="bg-gray-800 text-white py-8">
      <div class="container mx-auto px-4 text-center">
        <p>&copy; 2023 Acervy.by. Todos os direitos reservados.</p>
      </div>
    </footer>
  </div>
</template>