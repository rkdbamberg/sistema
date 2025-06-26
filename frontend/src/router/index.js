import { createRouter, createWebHistory } from 'vue-router'
import Home from '../pages/external/Home.vue'
import Login from '../pages/external/Login.vue'
import Register from '../pages/external/Register.vue'
import Dashboard from '../pages/internal/Dashboard.vue'
import OutraPagina from '../pages/internal/OutraPagina.vue'
import ProdutosIndex from '../pages/internal/produtos/Index.vue'
import ProdutosCadastrar from '../pages/internal/produtos/Cadastrar.vue'
import ProdutosDetalhes from '../pages/internal/produtos/Detalhes.vue'
import ProdutosEditar from '../pages/internal/produtos/Editar.vue'
import ProdutosExcluir from '../pages/internal/produtos/Excluir.vue'

const routes = [
  { path: '/', component: Home, meta: { title: 'Home - Sistema' } },
  { path: '/login', component: Login, meta: { title: 'Login - Sistema' } },
  { path: '/register', component: Register, meta: { title: 'Registrar - Sistema' } },
  { path: '/dashboard', component: Dashboard, meta: { title: 'Dashboard - Sistema', requiresAuth: true } },
  { path: '/outra-pagina', component: OutraPagina, meta: { title: 'Outra Página - Sistema', requiresAuth: true } },
  { path: '/produtos', component: ProdutosIndex, meta: { title: 'Produtos - Sistema', requiresAuth: true } },
  { path: '/produtos-cadastrar', component: ProdutosCadastrar, meta: { title: 'Cadastrar Produto - Sistema', requiresAuth: true } },
  { path: '/produtos-editar/:id', component: ProdutosEditar, meta: { title: 'Editar Produto - Sistema', requiresAuth: true } },
  { path: '/produtos-excluir/:id', component: ProdutosExcluir, meta: { title: 'Excluir Produto - Sistema', requiresAuth: true } },
  { path: '/produtos-detalhar/:id', component: ProdutosDetalhes, meta: { title: 'Detalhes do Produto - Sistema', requiresAuth: true } },
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

// Atualiza o title após cada navegação
router.afterEach((to) => {
  document.title = to.meta.title || 'Sistema'
})

router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth) {
    const token = localStorage.getItem('token')
    if (!token) {
      return next('/login')
    }
  }
  next()
})

// Exemplo de fetch autenticado
fetch('http://localhost:8000/api/itens', {
  headers: {
    'Authorization': 'Bearer ' + localStorage.getItem('token')
  }
})

export default router
