<script setup lang="ts">
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { useProducts } from '../composables/useProducts'

const router = useRouter()
const { addProduct } = useProducts()

const productName = ref('')
const price = ref(0)
const description = ref('')
const expiryDate = ref('')
const category = ref('')
const imageFile = ref<File | null>(null)
const customFileName = ref('')

const categories = [
  'Romance',
  'Drama',
  'Ação',
  'Terror',
  'Fantasia',
  'Religioso',
  'Outros'
]

const handleImageChange = (event: Event) => {
  const input = event.target as HTMLInputElement
  if (input.files && input.files[0]) {
    imageFile.value = input.files[0]
    customFileName.value = imageFile.value.name
  }
}

// const getCurrentDate = () => {
//   const today = new Date()
//   return today.toISOString().split('T')[0]
// }

const handleSubmit = async (event: Event) => {
  event.preventDefault()

  let imageUrl = ''
  if (imageFile.value) {
    const reader = new FileReader()
    imageUrl = await new Promise((resolve) => {
      reader.onload = (e) => resolve(e.target?.result as string)
      reader.readAsDataURL(imageFile.value!)
    })
  }

  addProduct({
    name: productName.value,
    price: price.value,
    description: description.value,
    expiryDate: expiryDate.value,
    category: category.value,
    image: imageUrl
  })

  router.push('/dashboard/products')
}
</script>

<template>
  <div>
    <h1 class="text-2xl font-bold mb-6">Cadastrar Produto</h1>
    <div class="bg-white rounded-lg shadow-sm p-6">
      <form @submit="handleSubmit" class="space-y-6">
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
            Nome do Produto
          </label>
          <input id="name" v-model="productName" type="text" maxlength="50" required
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            placeholder="Nome do produto (máx. 50 caracteres)" />
          <p class="text-sm text-gray-500 mt-1">
            {{ productName.length }}/50 caracteres
          </p>
        </div>

        <div>
          <label for="price" class="block text-sm font-medium text-gray-700 mb-1">
            Preço
          </label>
          <input id="price" v-model="price" type="number" min="0" step="0.01" required
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            placeholder="0.00" />
        </div>

        <div>
          <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
            Descrição
          </label>
          <textarea id="description" v-model="description" rows="4" maxlength="200" required
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            placeholder="Descrição do produto (máx. 200 caracteres)"></textarea>
          <p class="text-sm text-gray-500 mt-1">
            {{ description.length }}/200 caracteres
          </p>
        </div>

        <!-- <div>
          <label for="expiry" class="block text-sm font-medium text-gray-700 mb-1">
            Data de Validade
          </label>
          <input id="expiry" v-model="expiryDate" type="date" :min="getCurrentDate()" required
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
        </div> -->

        <div>
          <label for="category" class="block text-sm font-medium text-gray-700 mb-1">
            Categoria
          </label>
          <select id="category" v-model="category" required
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <option value="" disabled>Selecione uma categoria</option>
            <option v-for="cat in categories" :key="cat" :value="cat">
              {{ cat }}
            </option>
          </select>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">
            Imagem do Produto
          </label>
          <div class="space-y-2">
            <input type="file" accept="image/*" @change="handleImageChange"
              class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
              required />
            <div v-if="imageFile" class="flex items-center space-x-2">
              <input v-model="customFileName" type="text"
                class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Nome personalizado do arquivo" />
              <span class="text-sm text-gray-500">
                {{ imageFile.type.split('/')[1] }}
              </span>
            </div>
          </div>
        </div>

        <button type="submit"
          class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors">
          Cadastrar Produto
        </button>
      </form>
    </div>
  </div>
</template>