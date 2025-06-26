<template>
  <InternalLayout>
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h1><i class="fa-solid fa-boxes-stacked me-2"></i>Produtos</h1>
      <div class="d-flex gap-2">
        <router-link to="/produtos-cadastrar" class="btn btn-primary">
          <i class="fa-solid fa-plus me-1"></i> Novo Produto
        </router-link>
        <button class="btn btn-success" @click="fetchProdutos">
          <i class="fa-solid fa-arrows-rotate me-1"></i> Atualizar
        </button>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-bordered table-hover align-middle">
        <thead class="table-light">
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="produto in produtos" :key="produto.id">
            <td>{{ produto.id }}</td>
            <td>{{ produto.nome }}</td>
            <td>{{ produto.descricao }}</td>
            <td>
              <router-link :to="`/produtos-editar/${produto.id}`" class="btn btn-sm btn-primary me-2">
                <i class="fa-solid fa-pen"></i>
              </router-link>
              <router-link :to="`/produtos-excluir/${produto.id}`" class="btn btn-sm btn-danger">
                <i class="fa-solid fa-trash"></i>
              </router-link>
            </td>
          </tr>
          <tr v-if="produtos.length === 0">
            <td colspan="4" class="text-center">Nenhum produto encontrado.</td>
          </tr>
        </tbody>
      </table>
    </div>
  </InternalLayout>
</template>

<script>
import InternalLayout from '../../../layouts/InternalLayout.vue'

export default {
  name: 'ProdutosIndex',
  components: { InternalLayout },
  data() {
    return {
      produtos: []
    }
  },
  methods: {
    async fetchProdutos() {
      try {
        const response = await fetch('http://localhost:8000/api/itens', {
          headers: {
            'Authorization': 'Bearer ' + localStorage.getItem('token')
          }
        })
        if (response.ok) {
          this.produtos = await response.json()
        } else {
          this.produtos = []
        }
      } catch (e) {
        this.produtos = []
      }
    }
  },
  mounted() {
    document.title = 'Produtos - Sistema'
    this.fetchProdutos()
  }
}
</script>
