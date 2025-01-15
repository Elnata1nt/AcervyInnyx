import { ref, computed, watch, onMounted } from 'vue'
import axios from 'axios'

export interface Product {
  id: string
  name: string
  price: number
  description: string
  expiryDate: string
  category: string
  image: string
  createdAt: string
}

const PAGE_SIZE = 5
const API_URL = 'http://127.0.0.1:8000/api/produtos'

export function useProducts() {
  const products = ref<Product[]>([])
  const currentPage = ref(1)
  const searchTerm = ref('')
  const selectedCategory = ref('')
  const maxPrice = ref<number | null>(null)

  const loadProducts = async () => {
    try {
      const response = await axios.get(API_URL)
      products.value = response.data
    } catch (error) {
      console.error('Erro ao carregar produtos:', error)
    }
  }

  onMounted(() => {
    loadProducts()
  })

  const filteredProducts = computed(() => {
    return products.value.filter(product => {
      const matchesSearch = product.name.toLowerCase().includes(searchTerm.value.toLowerCase())
      const matchesCategory = !selectedCategory.value || product.category === selectedCategory.value
      const matchesPrice = !maxPrice.value || product.price <= maxPrice.value
      return matchesSearch && matchesCategory && matchesPrice
    })
  })

  const totalPages = computed(() => Math.ceil(filteredProducts.value.length / PAGE_SIZE))

  const paginatedProducts = computed(() => {
    const start = (currentPage.value - 1) * PAGE_SIZE
    const end = start + PAGE_SIZE
    return filteredProducts.value.slice(start, end)
  })

  const addProduct = async (product: Omit<Product, 'id' | 'createdAt'>) => {
    try {
      const response = await axios.post(API_URL, product)
      products.value.push(response.data)
    } catch (error) {
      console.error('Erro ao adicionar produto:', error)
    }
  }

  const updateProduct = async (id: string, updatedProduct: Partial<Product>) => {
    try {
      const response = await axios.put(`${API_URL}/${id}`, updatedProduct)
      const index = products.value.findIndex(p => p.id === id)
      if (index !== -1) {
        products.value[index] = { ...products.value[index], ...response.data }
      }
    } catch (error) {
      console.error('Erro ao atualizar produto:', error)
    }
  }

  const deleteProduct = async (id: string) => {
    try {
      await axios.delete(`${API_URL}/${id}`)
      products.value = products.value.filter(p => p.id !== id)
    } catch (error) {
      console.error('Erro ao excluir produto:', error)
    }
  }

  return {
    products,
    currentPage,
    searchTerm,
    selectedCategory,
    maxPrice,
    filteredProducts,
    paginatedProducts,
    totalPages,
    addProduct,
    updateProduct,
    deleteProduct
  }
}
