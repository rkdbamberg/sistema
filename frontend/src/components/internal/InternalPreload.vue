<template>
  <div v-if="loading" class="preload">
    <!-- Exemplo de preload -->
    <div class="spinner-border text-primary" role="status">
      <span class="visually-hidden">Carregando...</span>
    </div>
  </div>
</template>

<script>
export default {
  name: 'InternalPreload',
  data() {
    return {
      loading: false // Altere para true para testar o preload
    }
  }
}
</script>

<style>
.preload {
  position: fixed;
  top: 0; left: 0; right: 0; bottom: 0;
  background: rgba(255,255,255,0.7);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 9999;
}
</style>
