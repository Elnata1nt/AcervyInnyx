# **Acervy - Sistema de Gerenciamento de Livros**

**Acervy** é um sistema web desenvolvido com **Vue 3** e **TypeScript**, projetado para facilitar o gerenciamento de produtos. Ele oferece autenticação segura, interface responsiva e funcionalidades completas para cadastro, listagem e gestão eficiente de produtos.

## 🚀 **Funcionalidades Principais**

### 🔐 **Autenticação**
- Registro de novos usuários com validação de:
  - **Nome**, **email** e **senha**.
- Login seguro com **email** e **senha**.
- Logout para encerrar sessões de forma protegida.

### 📦 **Gestão de Produtos**
- Cadastro de produtos com validações:
  - **Nome**: máximo de 50 caracteres.
  - **Descrição**: máximo de 200 caracteres.
  - **Preço**: obrigatório e deve ser positivo.
  - **Data de validade**: deve ser uma data futura.
  - **Upload de imagens**: com renomeação automática.
  - **Categorização**: organização eficiente por categorias.
- Listagem de produtos cadastrados, com design intuitivo.

### 🖥️ **Interface**
- Design responsivo para **desktop** e **mobile**.
- Navegação intuitiva com **sidebar**.
- Menu de produtos organizado em **dropdowns**.
- Feedback visual para interações do usuário.

---

## 🛠️ **Stack Tecnológica**
- **Vue.js 3** com Composition API.
- **TypeScript** para tipagem estática.
- **Vue Router** para navegação entre páginas.
- **Tailwind CSS** para estilização moderna.
- **Vite** como bundler para desenvolvimento rápido.

---

## ⚙️ **Configuração do Projeto**

Para executar o projeto localmente, siga as etapas abaixo:

```bash
# Instalar as dependências
npm install

# Iniciar o servidor de desenvolvimento
npm run dev
