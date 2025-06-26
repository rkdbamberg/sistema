<template>
  <ExternalLayout>
    <h1>Registrar Novo Usuário</h1>
    <form @submit.prevent="onSubmit" class="mt-4" autocomplete="off">
      <div class="mb-3">
        <label for="name" class="form-label">Nome</label>
        <input
          type="text"
          id="name"
          v-model="name"
          class="form-control"
          required
        />
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">E-mail</label>
        <input
          type="email"
          id="email"
          v-model="email"
          class="form-control"
          required
        />
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Senha</label>
        <input
          type="password"
          id="password"
          v-model="password"
          class="form-control"
          required
        />
      </div>
      <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirme a Senha</label>
        <input
          type="password"
          id="password_confirmation"
          v-model="password_confirmation"
          class="form-control"
          required
        />
      </div>
      <button type="submit" class="btn btn-success w-100">
        <i class="fa-solid fa-user-plus me-1"></i>
        Registrar
      </button>
      <div v-if="error" class="alert alert-danger mt-3">{{ error }}</div>
      <div v-if="success" class="alert alert-success mt-3">Usuário registrado com sucesso!</div>
    </form>
    <div class="text-center mt-3">
      <router-link to="/login">Já tem conta? Faça login</router-link>
    </div>
  </ExternalLayout>
</template>

<script>
import ExternalLayout from '../../layouts/ExternalLayout.vue'

export default {
  name: 'Register',
  components: { ExternalLayout },
  data() {
    return {
      name: '',
      email: '',
      password: '',
      password_confirmation: '',
      error: '',
      success: false
    }
  },
  methods: {
    async onSubmit() {
      this.error = ''
      this.success = false
      try {
        const response = await fetch('http://localhost:8000/api/register', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({
            name: this.name,
            email: this.email,
            password: this.password,
            password_confirmation: this.password_confirmation
          })
        })
        if (!response.ok) {
          const data = await response.json()
          this.error = data.message || 'Erro ao registrar usuário'
        } else {
          this.success = true
          this.name = ''
          this.email = ''
          this.password = ''
          this.password_confirmation = ''
        }
      } catch (e) {
        this.error = 'Erro de conexão com o servidor'
      }
    }
  },
  mounted() {
    document.title = 'Registrar - Sistema'
  }
}
</script>
