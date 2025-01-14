<script setup lang="ts">
</script>

<template>
  <div class="space-y-8">
    <h1 class="text-2xl font-bold">Documentação do Projeto</h1>

    <!-- Overview Section -->
    <section class="space-y-4">
      <h2 class="text-xl font-semibold">Visão Geral</h2>
      <p class="text-gray-600">
        Este projeto é um sistema de gerenciamento de produtos que permite aos usuários cadastrar,
        listar e gerenciar produtos de forma eficiente. O sistema inclui autenticação de usuários
        e uma interface responsiva.
      </p>
    </section>

    <!-- Features Section -->
    <section class="space-y-4">
      <h2 class="text-xl font-semibold">Funcionalidades</h2>
      <div class="space-y-4">
        <div>
          <h3 class="text-lg font-medium">Autenticação</h3>
          <ul class="list-disc list-inside text-gray-600 ml-4">
            <li>Registro de novos usuários com nome, email e senha</li>
            <li>Login com email e senha</li>
            <li>Logout seguro</li>
          </ul>
        </div>

        <div>
          <h3 class="text-lg font-medium">Gestão de Produtos</h3>
          <ul class="list-disc list-inside text-gray-600 ml-4">
            <li>Cadastro de produtos com validações:
              <ul class="list-disc list-inside ml-4">
                <li>Nome com máximo de 50 caracteres</li>
                <li>Descrição com máximo de 200 caracteres</li>
                <li>Valor positivo obrigatório</li>
                <li>Data de validade futura</li>
                <li>Upload e renomeação de imagens</li>
                <li>Categorização dos produtos</li>
              </ul>
            </li>
            <li>Listagem de produtos cadastrados</li>
          </ul>
        </div>

        <div>
          <h3 class="text-lg font-medium">Interface</h3>
          <ul class="list-disc list-inside text-gray-600 ml-4">
            <li>Design responsivo para desktop e mobile</li>
            <li>Sidebar com navegação intuitiva</li>
            <li>Menu de produtos organizado em dropdown</li>
            <li>Feedback visual para interações do usuário</li>
          </ul>
        </div>
      </div>
    </section>

    <!-- Technical Stack -->
    <section class="space-y-4">
      <h2 class="text-xl font-semibold">Stack Tecnológica</h2>
      <ul class="list-disc list-inside text-gray-600 ml-4">
        <li>Vue.js 3 com Composition API</li>
        <li>TypeScript para tipagem estática</li>
        <li>Vue Router para navegação</li>
        <li>Tailwind CSS para estilização</li>
        <li>Vite como bundler</li>
      </ul>
    </section>
  </div>
</template>