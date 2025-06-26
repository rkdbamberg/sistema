<template>
  <div class="external-layout min-vh-100 d-flex flex-column">
    <header class="bg-light py-3 shadow-sm">
      <div class="container d-flex align-items-center justify-content-between">
        <span class="fs-4 fw-bold">
          <i class="fa-solid fa-gauge-high text-primary me-2"></i>
          Sistema Externo
        </span>
        <div class="d-flex gap-2">
          <router-link to="/login" class="btn btn-outline-primary">
            <i class="fa-solid fa-right-to-bracket me-1"></i>
            Login
          </router-link>
          <router-link to="/register" class="btn btn-success">
            <i class="fa-solid fa-user-plus me-1"></i>
            Registrar
          </router-link>
        </div>
      </div>
    </header>
    <main class="flex-fill d-flex align-items-center justify-content-center">
      <div class="container">
        <slot />
      </div>
    </main>
    <footer class="bg-light text-center py-3 mt-auto border-top">
      <small>&copy; 2024 Sistema. Todos os direitos reservados.</small>
    </footer>
  </div>
</template>

<script>
export default {
  name: 'ExternalLayout',
    meta: {
    title: 'Sistema Vue - Ricardo'
  }

}
</script>

<style scoped>
.external-layout {
  background: #f8fafc;
}
</style>
