<template>
  <div>
    <button @click="openCreateModal" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Novo</button>

    <div v-if="isModalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
      <div class="bg-white rounded-lg p-8 shadow-lg w-1/2 max-w-3xl">
        <button @click="closeModal" class="absolute top-4 right-4 text-gray-500">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
          </svg>
        </button>

        <h2 class="text-xl font-bold mb-6">{{ isEditing ? 'Editar Produto' : isCreating ? 'Novo Produto' : 'Produto' }}</h2>

        <!-- Formulário de Criação -->
        <form v-if="isCreating" @submit.prevent="handleCreate" class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nome</label>
            <input
              v-model="createForm.name"
              type="text"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              placeholder="Nome do produto"
            />
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Descrição</label>
            <textarea
              v-model="createForm.description"
              rows="4"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              placeholder="Descrição do produto"
            ></textarea>
          </div>

          <div class="grid grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Categoria</label>
              <select
                v-model="createForm.category"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              >
              <option v-for="category in categories" :key="category.id" :value="category.id">
                {{ category.name }}
              </option>


              </select>
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Preço</label>
              <input
                v-model="createForm.price"
                type="number"
                min="0"
                step="0.01"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                placeholder="R$ 0,00"
              />
            </div>

            <!-- <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Data de Validade</label>
              <input
                v-model="createForm.expiryDate"
                type="date"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              />
            </div> -->
          </div>

          <div class="flex justify-end gap-4 mt-4">
            <button
              type="button"
              @click="closeModal"
              class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300"
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

<script>
import axios from 'axios';

export default {
  data() {
    return {
      isModalOpen: false,
      isEditing: false,
      isCreating: false,
      createForm: {
        name: '',
        description: '',
        category: '',
        price: 0,
        expiryDate: ''
      },
      categories: []
    };
  },
  mounted() {
    this.fetchCategories();
  },
  methods: {
    openCreateModal() {
      this.isCreating = true;
      this.isEditing = false;
      this.createForm = { name: '', description: '', category: '', price: 0, expiryDate: '' };
      this.isModalOpen = true;
    },
    closeModal() {
      this.isModalOpen = false;
    },
    fetchCategories() {
      axios.get('http://127.0.0.1:8000/api/categorias')
        .then(response => {
          this.categories = response.data;
        })
        .catch(error => {
          console.error('Erro ao carregar categorias:', error);
        });
    },
    handleCreate() {
      if (!this.createForm.name || !this.createForm.category || !this.createForm.price) {
        alert("Por favor, preencha todos os campos obrigatórios.");
        return;
      }

      const productData = {
          name: this.createForm.name,
          description: this.createForm.description,
          category_id: this.createForm.category_id,
          price: this.createForm.price,
          expiry_date: this.createForm.expiryDate
        };


      console.log("Enviando dados do produto: ", productData);

      axios.post('http://127.0.0.1:8000/api/produtos', productData)
        .then(response => {
          console.log('Produto criado com sucesso:', response.data);
          this.closeModal();
        })
        .catch(error => {
          console.error('Erro ao criar produto:', error);
          alert('Ocorreu um erro ao criar o produto. Verifique o console para mais detalhes.');
        });
    }
  }
};
</script>

<style scoped>
/* Estilos adicionais para o modal e formulário podem ser adicionados aqui */
</style>
