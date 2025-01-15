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
        listar e gerenciar produtos de maneira eficiente. O sistema é projetado com foco em escalabilidade, 
        segurança e usabilidade. Inclui autenticação robusta, manipulação de dados com validações complexas 
        e uma interface responsiva para melhorar a experiência do usuário.
      </p>
    </section>

    <!-- Features Section -->
    <section class="space-y-4">
      <h2 class="text-xl font-semibold">Funcionalidades</h2>
      <div class="space-y-4">
        <div>
          <h3 class="text-lg font-medium">Autenticação</h3>
          <ul class="list-disc list-inside text-gray-600 ml-4">
            <li>Registro de novos usuários com validações detalhadas</li>
            <li>Login com proteção contra ataques de força bruta</li>
            <li>Logout seguro com invalidação de sessão</li>
          </ul>
        </div>

        <div>
          <h3 class="text-lg font-medium">Gestão de Produtos</h3>
          <ul class="list-disc list-inside text-gray-600 ml-4">
            <li>Cadastro com validações rigorosas:
              <ul class="list-disc list-inside ml-4">
                <li>Nome: limite de 50 caracteres</li>
                <li>Descrição: até 200 caracteres</li>
                <li>Preço: valor positivo obrigatório</li>
                <li>Validade: data futura obrigatória</li>
                <li>Upload de imagens com renomeação para evitar conflitos</li>
                <li>Classificação em categorias predefinidas</li>
              </ul>
            </li>
            <li>Listagem detalhada com filtros e paginação</li>
          </ul>
        </div>

        <div>
          <h3 class="text-lg font-medium">Interface</h3>
          <ul class="list-disc list-inside text-gray-600 ml-4">
            <li>Design responsivo para compatibilidade entre dispositivos</li>
            <li>Sidebar com navegação dinâmica</li>
            <li>Menus organizados para facilitar o acesso</li>
            <li>Feedback visual imediato para ações do usuário</li>
          </ul>
        </div>
      </div>
    </section>

    <!-- Technical Stack -->
    <section class="space-y-4">
      <h2 class="text-xl font-semibold">Stack Tecnológica</h2>
      <ul class="list-disc list-inside text-gray-600 ml-4">
        <li>Vue.js 3 com Composition API para construção de interfaces dinâmicas</li>
        <li>TypeScript para garantir segurança de tipos</li>
        <li>Vue Router para gerenciamento de rotas</li>
        <li>Tailwind CSS para estilização modular e eficiente</li>
        <li>Vite para build rápida e otimizada</li>
        <li>Laravel como backend para APIs RESTful e lógica de negócios</li>
        <li>XAMPP para configuração local do ambiente Laravel</li>
      </ul>
    </section>

    <!-- Why XAMPP -->
    <section class="space-y-4">
      <h2 class="text-xl font-semibold">Por que usar XAMPP?</h2>
      <p class="text-gray-600">
        O uso do XAMPP no desenvolvimento com Laravel é recomendado para simplificar a configuração local do ambiente. 
        Ele inclui o Apache, MySQL e PHP pré-configurados, reduzindo a necessidade de configurações manuais. Isso 
        acelera o início do desenvolvimento, especialmente em projetos que dependem de um banco de dados robusto 
        e um servidor confiável para testes locais.
      </p>
      <ul class="list-disc list-inside text-gray-600 ml-4">
        <li>Fácil instalação e configuração</li>
        <li>Ambiente completo para desenvolvimento local</li>
        <li>Compatibilidade com Laravel e suporte a bibliotecas modernas</li>
        <li>Ideal para testes e depuração antes da implantação</li>
      </ul>
    </section>
  </div>
</template>
