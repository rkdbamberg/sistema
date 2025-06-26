<template>
  <header class="bg-primary text-white p-3">
    <div class="container-fluid d-flex align-items-center justify-content-between">
      <!-- Esquerda: Logo -->
      <router-link to="/dashboard" class="d-flex align-items-center text-white text-decoration-none">
        <img src="@/assets/img/logo.png" alt="Logo" style="height: 36px;" class="me-2" />
        <span class="fw-bold">Sistema</span>
      </router-link>
      <!-- Centro: Espaço vazio (pode adicionar título se quiser) -->
      <div></div>
      <!-- Direita: Usuário e Sair -->
      <div class="d-flex align-items-center gap-3">
        <button class="btn btn-info btn-sm" @click="showUserDetails">
            <i class="fa-solid fa-user me-1"></i> Usuário
        </button>
        <button class="btn btn-danger btn-sm" @click="logout">
          <i class="fa-solid fa-right-from-bracket me-1"></i> Sair
        </button>
      </div>
    </div>
  </header>

  <Modal v-if="isModalVisible" @close="closeModal">
    <template v-slot:header>
      <h5 class="modal-title">Detalhes do Usuário</h5>
    </template>
    <template v-slot:body>
      <div v-if="user">
        <p><strong>Nome:</strong> {{ user.name }}</p>
        <p><strong>Email:</strong> {{ user.email }}</p>
        </div>
      <div v-else class="text-center">
        <div class="spinner-border text-primary" role="status">
          <span class="visually-hidden">Carregando...</span>
        </div>
      </div>
      <div v-if="error" class="alert alert-danger mt-3">{{ error }}</div>
    </template>
    <template v-slot:footer>
      <button type="button" class="btn btn-secondary" @click="closeModal">Fechar</button>
    </template>
  </Modal>  
</template>

<script>
import Modal from '../Modal.vue';

export default {
  name: 'InternalHeader',
  components: {
    Modal
  },
  data() {
    return {
      isModalVisible: false,
      user: null, // Para armazenar os dados do usuário
      error: ''
    };
  },
  methods: {
    logout() {
      localStorage.removeItem('token');
      localStorage.removeItem('user'); 

      this.$router.push('/login');

    },
    showUserDetails() {
        this.isModalVisible = true;
        this.error = '';

        const userData = localStorage.getItem('user');
        console.log('Dados do usuário no localStorage (string):', userData); // AQUI!

        if (userData) {
            try {
            this.user = JSON.parse(userData);
            console.log('Dados do usuário parseados:', this.user); // AQUI!
            } catch (e) {
            console.error("Erro ao fazer parse dos dados do usuário do localStorage:", e);
            this.user = null;
            this.error = 'Erro ao carregar dados locais do usuário.';
            }
        } else {
            console.log('Nenhum dado do usuário encontrado no localStorage.'); // AQUI!
            this.user = null;
            this.error = 'Dados do usuário não encontrados na sessão. Por favor, faça login novamente.';
        }
    },
    closeModal() {
      this.isModalVisible = false;
      this.user = null; // Limpa os dados do usuário ao fechar o modal
      this.error = '';
    }
  }
};
</script>
