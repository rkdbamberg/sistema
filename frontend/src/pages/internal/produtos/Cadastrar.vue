<template>
  <InternalLayout>
    <div class="mb-4">
      <h1><i class="fa-solid fa-plus me-2"></i>Cadastrar Produto</h1>
    </div>
    <form @submit.prevent="onSubmit" class="card card-body shadow-sm" style="max-width: 500px;">
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
      <div v-if="success" class="alert alert-success mt-3">Produto cadastrado com sucesso!</div>
    </form>
  </InternalLayout>
</template>

<script>
import InternalLayout from '../../../layouts/InternalLayout.vue'

export default {
  name: 'ProdutosCadastrar',
  components: { InternalLayout },
  data() {
    return {
      nome: '',
      descricao: '',
      preco: 0,
      quantidade: 0,
      categoria: '',
      error: '',
      success: false
    }
  },
  methods: {
    async onSubmit() {
      this.error = ''
      this.success = false
      try {
        const response = await fetch('http://localhost:8000/api/itens', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + localStorage.getItem('token')
          },
          body: JSON.stringify({
            nome: this.nome,
            descricao: this.descricao,
            preco: parseFloat(this.preco),
            quantidade: parseInt(this.quantidade),
            categoria: this.categoria
          })
        })
        if (!response.ok) {
          const data = await response.json()
          this.error = data.message || 'Erro ao cadastrar produto'
        } else {
          this.success = true
          this.nome = ''
          this.descricao = ''
          this.preco = 0
          this.quantidade = 0
          this.categoria = ''
        }
      } catch (e) {
        this.error = 'Erro de conexão com o servidor'
      }
    }
  },
  mounted() {
    document.title = 'Cadastrar Produto - Sistema'
  }
}
</script>
