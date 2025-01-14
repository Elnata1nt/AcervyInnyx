<script setup lang="ts">
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import backgroundImage from '../assets/back.jpg'

const router = useRouter()
const isLogin = ref(false)
const email = ref('')
const password = ref('')
const passwordConfirmation = ref('')
const name = ref('')
const error = ref('')

const toggleForm = () => {
  isLogin.value = !isLogin.value
  email.value = ''
  password.value = ''
  passwordConfirmation.value = ''
  name.value = ''
  error.value = ''
}

const handleSubmit = async () => {
  try {
    error.value = ''
    
    if (!isLogin.value && password.value !== passwordConfirmation.value) {
      throw new Error('As senhas não coincidem')
    }

    // For demo purposes, directly navigate to dashboard
    router.push('/dashboard')
  } catch (err: any) {
    error.value = err.message || 'Ocorreu um erro. Tente novamente.'
  }
}
</script>

<template>
  <div class="flex h-screen">
    <!-- Image side -->
    <div class="hidden md:flex md:w-1/2 bg-cover bg-center items-center justify-center" :style="{ backgroundImage: `url(${backgroundImage})` }">
      <p class="text-white text-9xl font-bold">Acervy.by</p>
    </div>

    <!-- Form side -->
    <div class="w-full md:w-1/2 bg-black flex items-center justify-center p-4">
      <div class="bg-white rounded-lg shadow-md w-full max-w-md p-8">
        <h2 class="text-3xl font-bold text-center mb-8">
          {{ isLogin ? 'Login' : 'Criar Conta' }}
        </h2>

        <!-- Error Message -->
        <div v-if="error" class="mb-6 p-4 bg-red-50 border border-red-200 text-red-600 rounded-lg">
          {{ error }}
        </div>

        <form @submit.prevent="handleSubmit" class="space-y-6">
          <!-- Name field (only for sign up) -->
          <div v-if="!isLogin">
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
              Nome
            </label>
            <input
              id="name"
              v-model="name"
              type="text"
              required
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              placeholder="Seu nome completo"
            />
          </div>

          <!-- Email field -->
          <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
              Email
            </label>
            <input
              id="email"
              v-model="email"
              type="email"
              required
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              placeholder="seu@email.com"
            />
          </div>

          <!-- Password field -->
          <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
              Senha
            </label>
            <input
              id="password"
              v-model="password"
              type="password"
              required
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              placeholder="••••••••"
            />
          </div>

          <!-- Password Confirmation (only for sign up) -->
          <div v-if="!isLogin">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
              Confirmar Senha
            </label>
            <input
              id="password_confirmation"
              v-model="passwordConfirmation"
              type="password"
              required
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              placeholder="••••••••"
            />
          </div>

          <!-- Submit button -->
          <button
            type="submit"
            class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors flex items-center justify-center"
          >
            {{ isLogin ? 'Entrar' : 'Criar conta' }}
          </button>

          <!-- Toggle form type -->
          <p class="text-center text-sm text-gray-600">
            {{ isLogin ? 'Não tem uma conta?' : 'Já tem uma conta?' }}
            <button
              type="button"
              @click="toggleForm"
              class="text-blue-600 hover:text-blue-700 font-medium"
            >
              {{ isLogin ? 'Criar conta' : 'Fazer login' }}
            </button>
          </p>
        </form>
      </div>
    </div>
  </div>
</template>