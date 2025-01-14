import { ref, computed, watch } from 'vue'

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

const PRODUCTS_KEY = 'products'
const PAGE_SIZE = 5

export function useProducts() {
  const products = ref<Product[]>(JSON.parse(localStorage.getItem(PRODUCTS_KEY) || '[]'))
  const currentPage = ref(1)
  const searchTerm = ref('')
  const selectedCategory = ref('')
  const maxPrice = ref<number | null>(null)

  watch(products, (newProducts) => {
    localStorage.setItem(PRODUCTS_KEY, JSON.stringify(newProducts))
  }, { deep: true })

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

  const addProduct = (product: Omit<Product, 'id' | 'createdAt'>) => {
    const newProduct = {
      ...product,
      id: crypto.randomUUID(),
      createdAt: new Date().toISOString()
    }
    products.value.push(newProduct)
  }

  const updateProduct = (id: string, updatedProduct: Partial<Product>) => {
    const index = products.value.findIndex(p => p.id === id)
    if (index !== -1) {
      products.value[index] = { ...products.value[index], ...updatedProduct }
    }
  }

  const deleteProduct = (id: string) => {
    products.value = products.value.filter(p => p.id !== id)
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