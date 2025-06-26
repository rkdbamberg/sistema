<template>
  <InternalLayout>
    <div class="mb-4">
      <h1><i class="fa-solid fa-trash me-2"></i>Excluir Produto</h1>
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
        <div class="alert alert-warning mt-3">
          Tem certeza que deseja excluir este produto? Esta ação não poderá ser desfeita.
        </div>
        <button class="btn btn-danger w-100" @click="onDelete" :disabled="deleting">
          <i class="fa-solid fa-trash me-1"></i>
          Excluir
        </button>
        <div v-if="error" class="alert alert-danger mt-3">{{ error }}</div>
        <div v-if="success" class="alert alert-success mt-3">
          Produto excluído com sucesso!
          <router-link to="/produtos" class="btn btn-link">Voltar para lista</router-link>
        </div>
        <router-link v-if="!success" to="/produtos" class="btn btn-secondary mt-3 w-100">
          Cancelar
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
  name: 'ProdutosExcluir',
  components: { InternalLayout },
  data() {
    return {
      produto: null,
      loading: true,
      deleting: false,
      error: '',
      success: false
    }
  },
  methods: {
    async fetchProduto() {
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
    },
    async onDelete() {
      this.error = ''
      this.deleting = true
      const id = this.$route.params.id
      try {
        const response = await fetch(`http://localhost:8000/api/itens/${id}`, {
          method: 'DELETE',
          headers: {
            'Authorization': 'Bearer ' + localStorage.getItem('token')
          }
        })
        if (response.ok) {
          this.success = true
        } else {
          const data = await response.json()
          this.error = data.message || 'Erro ao excluir produto'
        }
      } catch (e) {
        this.error = 'Erro de conexão com o servidor'
      }
      this.deleting = false
    }
  },
  mounted() {
    document.title = 'Excluir Produto - Sistema'
    this.fetchProduto()
  }
}
</script>
