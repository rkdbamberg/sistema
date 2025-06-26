<template>
  <ExternalLayout>
    <div class="row justify-content-center align-items-center">
        <div class="col-6 border bg-dark shadow-sm p-4 text-center">
            <img :src="require('@/assets/img/logo2.jpeg')" class="image" alt="Logo do Sistema" />
        </div>
    </div>
    <div class="row justify-content-center align-items-center">
        <div class="card col-6 text-center">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Login do Sistema</p>
                <form @submit.prevent="onSubmit" class="mt-4" autocomplete="off">
                    <div class="input-group mb-3">
                        <input type="email"
                            id="email"
                            v-model="email"
                            placeholder="Email"
                            class="form-control"
                            required>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password"
                            id="password"
                            v-model="password"
                            placeholder="Password"
                            class="form-control"
                            required>
                    </div>

                    <div class="row text-center">
                        <div class="col-12 mb-3">
                            <button type="submit" class="btn btn-primary w-100">
                            <i class="fa-solid fa-right-to-bracket me-1"></i>
                            Entrar
                            </button>
                        </div>
                    </div>
                    <div v-if="error" class="alert alert-danger mt-3">{{ error }}</div>
                </form>
            </div>
        </div>
    </div>
</ExternalLayout>
</template>

<script>
import ExternalLayout from '../../layouts/ExternalLayout.vue'

export default {
  name: 'Login',
  components: { ExternalLayout },
  data() {
    return {
      email: '',
      password: '',
      error: ''
    }
  },
  methods: {
    async onSubmit() {
      this.error = ''
      try {
        const response = await fetch('http://localhost:8000/api/login', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({
            email: this.email,
            password: this.password
          })
        })
        const data = await response.json()
        if (!response.ok) {
          this.error = data.message || 'E-mail ou senha inválidos'
        } else {
          // Salva o token no localStorage
          localStorage.setItem('token', data.token)
          localStorage.setItem('user', JSON.stringify(data.user));
          // Redireciona para o dashboard
          this.$router.push('/dashboard')
        }
      } catch (e) {
        this.error = 'Erro de conexão com o servidor'
      }
    }
  },
  mounted() {
    document.title = 'Login - Sistema'
  }
}
</script>
