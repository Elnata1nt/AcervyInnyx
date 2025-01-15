<script setup lang="ts">
import { ref, onMounted, onUnmounted } from 'vue'
import { useRouter } from 'vue-router'

const isSidebarOpen = ref(false)
const isProductsOpen = ref(false)
const router = useRouter()

const toggleSidebar = () => {
  isSidebarOpen.value = !isSidebarOpen.value
}

const toggleProducts = () => {
  isProductsOpen.value = !isProductsOpen.value
}

const closeSidebar = () => {
  isSidebarOpen.value = false
}

const handleLogout = () => {
  router.push('/')
}

const handleClickOutside = (event: MouseEvent) => {
  const sidebar = document.getElementById('sidebar')
  const toggleButton = document.getElementById('toggle-sidebar')
  
  if (sidebar && 
      !sidebar.contains(event.target as Node) && 
      toggleButton && 
      !toggleButton.contains(event.target as Node)) {
    closeSidebar()
  }
}

onMounted(() => {
  document.addEventListener('click', handleClickOutside)
})

onUnmounted(() => {
  document.removeEventListener('click', handleClickOutside)
})
</script>

<template>
  <div class="min-h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside
      id="sidebar"
      :class="`${
        isSidebarOpen ? 'translate-x-0' : '-translate-x-full'
      } md:translate-x-0 fixed inset-y-0 left-0 z-50 w-64 bg-black text-white transition-transform duration-300 ease-in-out flex flex-col`"
    >
      <!-- Logo -->
      <div class="p-4 border-b border-gray-800 flex justify-between items-center">
        <h1 class="text-xl font-bold">Acervy.by</h1>
        <div class="bg-indigo-500 text-white text-xs px-2 py-1 rounded">Pro</div>
        <button
          @click="closeSidebar"
          class="md:hidden p-2 rounded-lg hover:bg-gray-800 transition-colors"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-6 w-6"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M6 18L18 6M6 6l12 12"
            />
          </svg>
        </button>
      </div>

      <!-- Navigation -->
      <nav class="flex-1 p-4">
        <ul class="space-y-2">
          <!-- Dashboard -->
          <li>
            <router-link
              to="/dashboard"
              class="flex items-center space-x-2 p-2 rounded-lg hover:bg-gray-800 transition-colors"
              active-class="bg-gray-800"
            >
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" />
              </svg>
              <span>Dashboard</span>
            </router-link>
          </li>

          <!-- Products Dropdown -->
          <li>
            <button
              @click="toggleProducts"
              class="flex items-center justify-between w-full p-2 rounded-lg hover:bg-gray-800 transition-colors"
              :class="{ 'bg-gray-800': isProductsOpen }"
            >
              <div class="flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                  <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
                </svg>
                <span>Produtos</span>
              </div>
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-4 w-4 transition-transform"
                :class="{ 'rotate-180': isProductsOpen }"
                viewBox="0 0 20 20"
                fill="currentColor"
              >
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
              </svg>
            </button>
            
            <!-- Products Submenu -->
            <ul
              v-show="isProductsOpen"
              class="mt-2 ml-4 space-y-2 border-l border-gray-800"
            >
              <li>
                <router-link
                  to="/dashboard/products/new"
                  class="flex items-center space-x-2 p-2 rounded-lg hover:bg-gray-800 transition-colors border-l-2 border-transparent hover:border-blue-500"
                  active-class="border-blue-500 bg-gray-800"
                >
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                  </svg>
                  <span>Cadastrar</span>
                </router-link>
              </li>
              <li>
                <router-link
                  to="/dashboard/products"
                  class="flex items-center space-x-2 p-2 rounded-lg hover:bg-gray-800 transition-colors border-l-2 border-transparent hover:border-blue-500"
                  active-class="border-blue-500 bg-gray-800"
                >
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
                  </svg>
                  <span>Listar</span>
                </router-link>
              </li>
            </ul>
          </li>

          <!-- Help Section -->
          <li>
            <router-link
              to="/dashboard/help"
              class="flex items-center space-x-2 p-2 rounded-lg hover:bg-gray-800 transition-colors"
              active-class="bg-gray-800"
            >
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide w-4 h-4 lucide-file-code">
  <path d="M10 12.5 8 15l2 2.5"/>
  <path d="m14 12.5 2 2.5-2 2.5"/>
  <path d="M14 2v4a2 2 0 0 0 2 2h4"/>
  <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7z"/></svg>
              <span>Documentação</span>
            </router-link>
          </li>
        </ul>
      </nav>

      <!-- Logout Button -->
      <div class="p-4 border-t border-gray-800">
        <button
          @click="handleLogout"
          class="flex items-center space-x-2 w-full p-2 rounded-lg hover:bg-gray-800 transition-colors text-red-400 hover:text-red-300"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd" />
          </svg>
          <span>Sair</span>
        </button>
      </div>
    </aside>

    <!-- Main Content -->
    <div class="md:ml-64 min-h-screen flex flex-col">
      <!-- Top Bar -->
      <header class="bg-gray-100 shadow-sm fixed top-0 right-0 left-0 md:hidden z-40">
        <div class="flex items-center justify-between p-4">
          <button
            id="toggle-sidebar"
            @click="toggleSidebar"
            class="md:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-6 w-6"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16"
              />
            </svg>
          </button>
        </div>
      </header>

      <!-- Page Content -->
      <main class="flex-grow p-6 mt-16">
        <router-view />
      </main>

      <!-- Footer -->
      <footer class="bg-white border-t border-gray-200 py-4 px-6">
        <div class="text-center text-gray-600">
          <p>&copy; {{ new Date().getFullYear() }} Elnatan Correa. Todos os direitos reservados.</p>
        </div>
      </footer>
    </div>
  </div>
</template>