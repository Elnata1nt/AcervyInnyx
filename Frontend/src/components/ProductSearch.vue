<script setup lang="ts">
import { ref, onMounted } from 'vue'

const searchTerm = ref('')
const selectedCategory = ref('')
const maxPrice = ref<number | null>(null)
const isVisible = ref(false)
const isFormVisible = ref(false)
const isButtonVisible = ref(false)

const categories = [
  'Romance',
  'Drama',
  'Ação',
  'Terror',
  'Fantasia',
  'Religioso',
  'Outros'
]

const handleSearch = () => {
  console.log('Searching for:', {
    searchTerm: searchTerm.value,
    category: selectedCategory.value,
    maxPrice: maxPrice.value
  })
}

onMounted(() => {
  const observer = new IntersectionObserver(
    (entries) => {
      if (entries[0].isIntersecting) {
        isVisible.value = true
        
        // Sequenced animations
        setTimeout(() => {
          isFormVisible.value = true
        }, 500)
        
        setTimeout(() => {
          isButtonVisible.value = true
        }, 1000)
        
        observer.disconnect()
      }
    },
    { threshold: 0.2 }
  )

  const element = document.querySelector('.search-section')
  if (element) observer.observe(element)
})
</script>

<template>
  <section class="search-section py-16 bg-gray-100">
    <div class="container mx-auto px-4">
      <div class="max-w-4xl mx-auto">
        <h2 
          class="text-3xl font-bold text-center mb-8 transform transition-all duration-1000"
          :class="[isVisible ? 'translate-y-0 opacity-100' : 'translate-y-16 opacity-0']"
        >
          Encontre o Produto Ideal
        </h2>
        
        <div class="bg-white rounded-lg shadow-lg p-6">
          <div 
            class="grid grid-cols-1 md:grid-cols-3 gap-6 transform transition-all duration-1000"
            :class="[isFormVisible ? 'translate-y-0 opacity-100' : 'translate-y-16 opacity-0']"
          >
            <!-- Search Term -->
            <div>
              <label for="search" class="block text-sm font-medium text-gray-700 mb-1">
                Nome do Produto
              </label>
              <input
                id="search"
                v-model="searchTerm"
                type="text"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Digite o nome do produto"
              />
            </div>

            <!-- Category -->
            <div>
              <label for="category" class="block text-sm font-medium text-gray-700 mb-1">
                Categoria
              </label>
              <select
                id="category"
                v-model="selectedCategory"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              >
                <option value="">Todas as categorias</option>
                <option v-for="category in categories" :key="category" :value="category">
                  {{ category }}
                </option>
              </select>
            </div>

            <!-- Max Price -->
            <div>
              <label for="price" class="block text-sm font-medium text-gray-700 mb-1">
                Preço Máximo
              </label>
              <input
                id="price"
                v-model="maxPrice"
                type="number"
                min="0"
                step="0.01"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                placeholder="R$ 0,00"
              />
            </div>
          </div>

          <!-- Search Button and Results Preview -->
          <div 
            class="mt-6 space-y-6 transform transition-all duration-1000"
            :class="[isButtonVisible ? 'translate-y-0 opacity-100' : 'translate-y-16 opacity-0']"
          >
            <button
              @click="handleSearch"
              class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors flex items-center justify-center space-x-2"
            >
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
              </svg>
              <span>Buscar Produtos</span>
            </button>

            <!-- Results Preview -->
            <div class="text-center text-gray-500">
              <p>Encontre produtos por nome, categoria ou faixa de preço.</p>
              <p class="text-sm">Resultados aparecerão aqui após a busca.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>