import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'
import Auth from '../views/Auth.vue'
import Sidebar from '../views/Sidebar.vue'
import DashboardHome from '../views/SystemHome.vue'
import ProductList from '../views/ProductList.vue'
import ProductForm from '../views/ProductForm.vue'
import Help from '../views/Help.vue'
import About from '../views/About.vue'

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home
    },
    {
      path: '/about',
      name: 'about',
      component: About
    },
    {
      path: '/auth',
      name: 'auth',
      component: Auth
    },
    {
      path: '/dashboard',
      component: Sidebar,
      children: [
        {
          path: '',
          name: 'dashboard',
          component: DashboardHome
        },
        {
          path: 'products',
          name: 'products',
          component: ProductList
        },
        {
          path: 'products/new',
          name: 'new-product',
          component: ProductForm
        },
        {
          path: 'help',
          name: 'help',
          component: Help
        }
      ]
    }
  ]
})

export default router