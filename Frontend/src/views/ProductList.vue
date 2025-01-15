<template>
  <div>
    <!-- Botão de Novo -->
    <button @click="showCreateForm = !showCreateForm" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
      Novo
    </button>

    <!-- Formulário de Criação -->
    <div v-if="showCreateForm" class="mt-6 p-4 border rounded-lg shadow-lg bg-white">
      <h2 class="text-xl font-bold mb-4">{{ isEditing ? 'Editar Produto' : 'Criar Novo Produto' }}</h2>

      <form @submit.prevent="handleCreate" class="space-y-4">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Nome</label>
          <input
            v-model="createForm.name"
            type="text"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            placeholder="Nome do produto"
            required
          />
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Descrição</label>
          <textarea
            v-model="createForm.description"
            rows="4"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            placeholder="Descrição do produto"
            required
          ></textarea>
        </div>

        <div class="grid grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Categoria</label>
            <select
              v-model="createForm.category"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              required
            >
              <option value="">Selecione uma categoria</option>
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
              required
            />
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Data de Validade</label>
            <input
              v-model="createForm.expiryDate"
              type="date"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              required
            />
          </div>
        </div>

        <div class="flex justify-end gap-4 mt-4">
          <button
            type="button"
            @click="showCreateForm = false"
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

    <!-- Lista de Produtos -->
    <div v-if="!showCreateForm" class="mt-6">
      <h2 class="text-xl font-bold mb-4">Lista de Produtos</h2>
      <ul class="space-y-4">
        <li v-for="(product, index) in filteredProducts" :key="index" class="p-4 border rounded-lg shadow-sm">
          <div>
            <h3 class="text-lg font-semibold">{{ product.name || 'Sem Nome' }}</h3>
            <p class="text-gray-600">{{ product.description || 'Sem Descrição' }}</p>
            <p class="text-gray-800">
              {{ getCategoryName(product.category) || 'Sem Categoria' }} | R$ {{ parseFloat(product.price).toFixed(2).replace('.', ',') }}
            </p>
            <!-- Botões Editar e Excluir -->
            <div class="mt-2 flex gap-4">
              <button @click="editProduct(product)" class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">
                Editar
              </button>
              <button @click="deleteProduct(product.id)" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                Excluir
              </button>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      showCreateForm: false,
      isEditing: false,
      createForm: {
        id: null,  // Adiciona o campo 'id' para identificar um produto existente ao editar
        name: "",
        description: "",
        category: "",
        price: 0,
        expiryDate: ""
      },
      categories: [],  // Agora as categorias serão carregadas do backend
      products: [],
      filteredProducts: []
    };
  },
  mounted() {
    this.loadProducts();
    this.loadCategories(); // Carrega as categorias no início
  },
  methods: {
    async loadProducts() {
      try {
        const response = await axios.get("http://127.0.0.1:8000/api/produtos");
        console.log("Resposta da API:", response.data);
        this.products = response.data;
        this.filteredProducts = this.products;
      } catch (error) {
        console.error("Erro ao carregar produtos:", error);
      }
    },
    async loadCategories() {
      try {
        const response = await axios.get("http://127.0.0.1:8000/api/categorias");
        this.categories = response.data;  // Supondo que a resposta contenha categorias
      } catch (error) {
        console.error("Erro ao carregar categorias:", error);
      }
    },

    async handleCreate() {
      if (!this.createForm.name || !this.createForm.description || !this.createForm.category || this.createForm.price <= 0) {
        alert('Por favor, preencha todos os campos.');
        return;
      }

      try {
        const response = this.isEditing
          ? await axios.put(`http://127.0.0.1:8000/api/produtos/${this.createForm.id}`, this.createForm)
          : await axios.post("http://127.0.0.1:8000/api/produtos", this.createForm);

        if (this.isEditing) {
          const index = this.products.findIndex(p => p.id === this.createForm.id);
          this.products[index] = response.data;  // Atualiza o produto editado
        } else {
          this.products.push(response.data);  // Adiciona o novo produto
        }

        this.filteredProducts = this.products;
        this.resetForm();
        this.showCreateForm = false;
      } catch (error) {
        console.error("Erro ao criar/editar produto:", error);
      }
    },

    resetForm() {
      this.createForm = {
        id: null,
        name: "",
        description: "",
        category: "",
        price: 0,
        expiryDate: ""
      };
      this.isEditing = false;
    },

    // Método para carregar os dados de um produto para edição
    editProduct(product) {
      this.createForm = {
        id: product.id,
        name: product.name || "",
        description: product.description || "",
        category: product.category || "",
        price: product.price || 0,
        expiryDate: product.expiryDate || ""
      };
      this.isEditing = true;
      this.showCreateForm = true;  // Exibe o formulário de criação com os dados do produto
    },

    async deleteProduct(productId) {
      try {
        await axios.delete(`http://127.0.0.1:8000/api/produtos/${productId}`);
        this.products = this.products.filter(p => p.id !== productId);
        this.filteredProducts = this.products;
      } catch (error) {
        console.error("Erro ao excluir produto:", error);
      }
    },

    getCategoryName(categoryId) {
      const category = this.categories.find(c => c.id === categoryId);
      return category ? category.name : 'Sem Categoria';
    }
  }
};
</script>
