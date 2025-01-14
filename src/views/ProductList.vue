<script setup lang="ts">
import { ref } from 'vue'
import { useProducts } from '../composables/useProducts'
import type { Product } from '../composables/useProducts'

const {
  paginatedProducts,
  totalPages,
  currentPage,
  searchTerm,
  selectedCategory,
  maxPrice,
  updateProduct,
  deleteProduct
} = useProducts()

const categories = [
  'Eletrônicos',
  'Roupas',
  'Alimentos',
  'Bebidas',
  'Cosméticos',
  'Livros',
  'Outros'
]

const selectedProduct = ref<Product | null>(null)
const isModalOpen = ref(false)
const isEditing = ref(false)
const editForm = ref<Partial<Product>>({})

const handleSearch = () => {
  currentPage.value = 1
}

const formatDate = (date: string) => {
  const d = new Date(date)
  d.setMinutes(d.getMinutes() + d.getTimezoneOffset())
  return d.toLocaleDateString()
}

const formatPrice = (price: number) => {
  return price.toLocaleString('pt-BR', {
    style: 'currency',
    currency: 'BRL'
  })
}

const openModal = (product: Product, edit = false) => {
  selectedProduct.value = product
  isEditing.value = edit
  if (edit) {
    editForm.value = { ...product }
    const date = new Date(product.expiryDate)
    date.setMinutes(date.getMinutes() + date.getTimezoneOffset())
    editForm.value.expiryDate = date.toISOString().split('T')[0]
  }
  isModalOpen.value = true
}

const closeModal = () => {
  isModalOpen.value = false
  selectedProduct.value = null
  isEditing.value = false
  editForm.value = {}
}

const handleUpdate = () => {
  if (selectedProduct.value && editForm.value) {
    updateProduct(selectedProduct.value.id, editForm.value)
    closeModal()
  }
}

const handleDelete = (id: string) => {
  if (confirm('Tem certeza que deseja excluir este produto?')) {
    deleteProduct(id)
    closeModal()
  }
}

const goToPage = (page: number) => {
  if (page >= 1 && page <= totalPages.value) {
    currentPage.value = page
  }
}
</script>

<template>
  <div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
      <h1 class="text-2xl font-bold">Lista de Produtos</h1>
      <router-link
        to="/dashboard/products/new"
        class="inline-flex items-center space-x-2 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors"
      >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
        </svg>
        <span>Novo Produto</span>
      </router-link>
    </div>

    <!-- Search Filters -->
    <div class="bg-white rounded-lg shadow-sm p-6">
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
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
            @input="handleSearch"
          />
        </div>

        <div>
          <label for="category" class="block text-sm font-medium text-gray-700 mb-1">
            Categoria
          </label>
          <select
            id="category"
            v-model="selectedCategory"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            @change="handleSearch"
          >
            <option value="">Todas as categorias</option>
            <option v-for="category in categories" :key="category" :value="category">
              {{ category }}
            </option>
          </select>
        </div>

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
            @input="handleSearch"
          />
        </div>
      </div>
    </div>

    <!-- Products Table -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Produto
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Categoria
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Preço
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Validade
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Ações
              </th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr v-for="product in paginatedProducts" :key="product.id">
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="h-10 w-10 flex-shrink-0">
                    <img :src="product.image" class="h-10 w-10 rounded-full object-cover" />
                  </div>
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">{{ product.name }}</div>
                    <div v-if="product.description.length > 50" class="mt-1">
                      <button
                        @click="openModal(product)"
                        class="text-sm text-blue-600 hover:text-blue-700"
                      >
                        Ver descrição
                      </button>
                    </div>
                    <div v-else class="text-sm text-gray-500">{{ product.description }}</div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                  {{ product.category }}
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                {{ formatPrice(product.price) }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                {{ formatDate(product.expiryDate) }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                <div class="flex space-x-2">
                  <button
                    @click="openModal(product, true)"
                    class="text-blue-600 hover:text-blue-700"
                  >
                    Editar
                  </button>
                  <button
                    @click="handleDelete(product.id)"
                    class="text-red-600 hover:text-red-700"
                  >
                    Excluir
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <div v-if="paginatedProducts.length === 0" class="p-4 text-center text-gray-500">
        Nenhum produto encontrado.
      </div>

      <!-- Pagination -->
      <div v-if="totalPages > 1" class="px-6 py-4 flex justify-center items-center space-x-2">
        <button
          @click="goToPage(currentPage - 1)"
          :disabled="currentPage === 1"
          class="px-3 py-1 rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200 disabled:opacity-50 disabled:cursor-not-allowed"
        >
          Anterior
        </button>

        <template v-for="pageNum in totalPages" :key="pageNum">
          <!-- Show first page -->
          <button
            v-if="pageNum === 1"
            @click="goToPage(pageNum)"
            class="px-3 py-1 rounded-md"
            :class="currentPage === pageNum ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
          >
            {{ pageNum }}
          </button>

          <!-- Show ellipsis for skipped pages after first page -->
          <span
            v-if="pageNum === 2 && currentPage > 4"
            class="px-2"
          >
            ...
          </span>

          <!-- Show current page and surrounding pages -->
          <button
            v-if="pageNum >= currentPage - 1 && pageNum <= currentPage + 1 && pageNum !== 1 && pageNum !== totalPages"
            @click="goToPage(pageNum)"
            class="px-3 py-1 rounded-md"
            :class="currentPage === pageNum ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
          >
            {{ pageNum }}
          </button>

          <!-- Show ellipsis for skipped pages before last page -->
          <span
            v-if="pageNum === totalPages - 1 && currentPage < totalPages - 3"
            class="px-2"
          >
            ...
          </span>

          <!-- Show last page -->
          <button
            v-if="pageNum === totalPages"
            @click="goToPage(pageNum)"
            class="px-3 py-1 rounded-md"
            :class="currentPage === pageNum ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
          >
            {{ pageNum }}
          </button>
        </template>

        <button
          @click="goToPage(currentPage + 1)"
          :disabled="currentPage === totalPages"
          class="px-3 py-1 rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200 disabled:opacity-50 disabled:cursor-not-allowed"
        >
          Próxima
        </button>
      </div>
    </div>

    <!-- Product Modal -->
    <div v-if="isModalOpen" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
      <div class="bg-white rounded-lg max-w-2xl w-full p-6">
        <div class="flex justify-between items-start mb-4">
          <h3 class="text-xl font-bold">
            {{ isEditing ? 'Editar Produto' : selectedProduct?.name }}
          </h3>
          <button @click="closeModal" class="text-gray-500 hover:text-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>

        <!-- View Mode -->
        <div v-if="!isEditing && selectedProduct" class="space-y-4">
          <div class="flex items-start space-x-4">
            <img :src="selectedProduct.image" class="w-24 h-24 rounded-lg object-cover" />
            <div>
              <h4 class="font-medium">{{ selectedProduct.name }}</h4>
              <p class="text-gray-600 mt-2">{{ selectedProduct.description }}</p>
            </div>
          </div>
          <div class="grid grid-cols-2 gap-4">
            <div>
              <p class="text-sm text-gray-500">Categoria</p>
              <p class="font-medium">{{ selectedProduct.category }}</p>
            </div>
            <div>
              <p class="text-sm text-gray-500">Preço</p>
              <p class="font-medium">{{ formatPrice(selectedProduct.price) }}</p>
            </div>
            <div>
              <p class="text-sm text-gray-500">Data de Validade</p>
              <p class="font-medium">{{ formatDate(selectedProduct.expiryDate) }}</p>
            </div>
          </div>
        </div>

        <!-- Edit Mode -->
        <form v-else-if="isEditing" @submit.prevent="handleUpdate" class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nome</label>
            <input
              v-model="editForm.name"
              type="text"
              required
              maxlength="50"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            />
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Descrição</label>
            <textarea
              v-model="editForm.description"
              required
              maxlength="200"
              rows="3"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            ></textarea>
          </div>

          <div class="grid grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Categoria</label>
              <select
                v-model="editForm.category"
                required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              >
                <option v-for="category in categories" :key="category" :value="category">
                  {{ category }}
                </option>
              </select>
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Preço</label>
              <input
                v-model="editForm.price"
                type="number"
                required
                min="0"
                step="0.01"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              />
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Data de Validade</label>
              <input
                v-model="editForm.expiryDate"
                type="date"
                required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              />
            </div>
          </div>

          <div class="flex justify-end space-x-2">
            <button
              type="button"
              @click="closeModal"
              class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50"
            >
              Cancelar
            </button>
            <button
              type="submit"
              class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700"
            >
              Salvar
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>