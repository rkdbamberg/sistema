<template>
  <InternalLayout>
    <div class="mb-4">
      <h1>
        <i class="fa-solid fa-box-open me-2"></i>
        Detalhes do Produto
      </h1>
    </div>
    <div v-if="loading" class="text-center my-5">
      <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Carregando...</span>
      </div>
    </div>
    <div v-else-if="produto" class="card shadow-sm" style="max-width: 500px;">
      <div class="card-body">
        <h5 class="card-title">{{ produto.nome }}</h5>
        <p class="card-text"><strong>Descrição:</strong> {{ produto.descricao || 'Sem descrição.' }}</p>
        <p class="card-text"><strong>ID:</strong> {{ produto.id }}</p>
        <router-link to="/produtos" class="btn btn-secondary mt-3">
          <i class="fa-solid fa-arrow-left me-1"></i>
          Voltar
        </router-link>
      </div>
    </div>
    <div v-else class="alert alert-danger">
      Produto não encontrado.
      <router-link to="/produtos" class="btn btn-link">Voltar</router-link>
    </div>
  </InternalLayout>
</template>

<script>
import InternalLayout from '../../../layouts/InternalLayout.vue'

export default {
  name: 'ProdutosDetalhes',
  components: { InternalLayout },
  data() {
    return {
      produto: null,
      loading: true
    }
  },
  async mounted() {
    document.title = 'Detalhes do Produto - Sistema'
    const id = this.$route.params.id
    try {
      const response = await fetch(`http://localhost:8000/api/itens/${id}`, {
        headers: {
          'Authorization': 'Bearer ' + localStorage.getItem('token')
        }
      })
      if (response.ok) {
        this.produto = await response.json()
      }
    } catch (e) {
      this.produto = null
    }
    this.loading = false
  }
}
</script>
