<template>
  <InternalLayout>
    <div class="mb-4">
      <h1><i class="fa-solid fa-pen me-2"></i>Editar Produto</h1>
    </div>
    <form v-if="loaded" @submit.prevent="onSubmit" class="card card-body shadow-sm" style="max-width: 500px;">
      <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input
          type="text"
          id="nome"
          v-model="nome"
          class="form-control"
          required
        />
      </div>
      <div class="mb-3">
        <label for="descricao" class="form-label">Descrição</label>
        <textarea
          id="descricao"
          v-model="descricao"
          class="form-control"
          rows="3"
        ></textarea>
      </div>
      <div class="mb-3">
        <label for="preco" class="form-label">Preço</label>
        <input
          type="number"
          id="preco"
          v-model="preco"
          class="form-control"
          step="0.01"
          required
        />
      </div>
      <div class="mb-3">
        <label for="quantidade" class="form-label">Quantidade</label>
        <input
          type="number"
          id="quantidade"
          v-model="quantidade"
          class="form-control"
          required
        />
      </div>
      <div class="mb-3">
        <label for="categoria" class="form-label">Categoria</label>
        <input
          type="text"
          id="categoria"
          v-model="categoria"
          class="form-control"
          required
        />
      </div>
      <div class="d-flex justify-content-end gap-2">
        <button type="submit" class="btn btn-success">
          <i class="fa-solid fa-check me-1"></i>
          Salvar
        </button>
        <button type="button" class="btn btn-secondary" @click="$router.go(-1)">
          <i class="fa-solid fa-arrow-left me-1"></i>
          Voltar
        </button>
      </div>
      <div v-if="error" class="alert alert-danger mt-3">{{ error }}</div>
      <div v-if="success" class="alert alert-success mt-3">Produto atualizado com sucesso!</div>
    </form>
    <div v-else class="text-center my-5">
      <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Carregando...</span>
      </div>
    </div>
  </InternalLayout>
</template>

<script>
import InternalLayout from '../../../layouts/InternalLayout.vue'

export default {
  name: 'ProdutosEditar',
  components: { InternalLayout },
  data() {
    return {
      nome: '',
      descricao: '',
      preco: 0,
      quantidade: 0,
      categoria: '',
      error: '',
      success: false,
      loaded: false
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
          const produto = await response.json()
          this.nome = produto.nome
          this.descricao = produto.descricao
          this.preco = produto.preco || 0
          this.quantidade = produto.quantidade || 0
          this.categoria = produto.categoria || ''
        } else {
          this.error = 'Produto não encontrado.'
        }
      } catch (e) {
        this.error = 'Erro ao buscar produto.'
      }
      this.loaded = true
    },
    async onSubmit() {
      this.error = ''
      this.success = false
      const id = this.$route.params.id
      try {
        const response = await fetch(`http://localhost:8000/api/itens/${id}`, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + localStorage.getItem('token')
          },
          body: JSON.stringify({
            nome: this.nome,
            descricao: this.descricao,
            preco: this.preco,
            quantidade: this.quantidade,
            categoria: this.categoria
          })
        })
        if (!response.ok) {
          const data = await response.json()
          this.error = data.message || 'Erro ao atualizar produto'
        } else {
          this.success = true
        }
      } catch (e) {
        this.error = 'Erro de conexão com o servidor'
      }
    }
  },
  mounted() {
    document.title = 'Editar Produto - Sistema'
    this.fetchProduto()
  }
}
</script>
