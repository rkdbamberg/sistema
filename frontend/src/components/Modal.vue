<template>
  <transition name="modal-fade">
    <div class="modal-backdrop" @click="close">
      <div class="modal" role="dialog" aria-labelledby="modalTitle" aria-describedby="modalDescription" @click.stop>
        <header class="modal-header">
          <slot name="header">
            <h5 class="modal-title" id="modalTitle">Modal Title</h5>
          </slot>
          <button type="button" class="btn-close" @click="close" aria-label="Close modal">
          </button>
        </header>

        <section class="modal-body" id="modalDescription">
          <slot name="body">
            I'm the default body!
          </slot>
        </section>

        <footer class="modal-footer">
          <slot name="footer">
            <button type="button" class="btn btn-secondary" @click="close" aria-label="Close modal">
              Fechar
            </button>
          </slot>
        </footer>
      </div>
    </div>
  </transition>
</template>

<script>
export default {
  name: 'Modal',
  methods: {
    close() {
      this.$emit('close'); // Emite um evento para o componente pai fechar o modal
    }
  }
};
</script>

<style scoped>
.modal-backdrop {
  position: fixed; /* Fixa o modal na viewport */
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background-color: rgba(0, 0, 0, 0.3); /* Fundo escurecido */
  
  /* PROPRIEDADES PARA CENTRALIZAR COM FLEXBOX */
  display: flex; /* Transforma em container flex */
  justify-content: center; /* Centraliza horizontalmente o conteúdo (o modal) */
  align-items: center; /* Centraliza verticalmente o conteúdo (o modal) */
  
  z-index: 1050; /* Garante que o modal fique acima de outros elementos */
}

.modal {
  background: #FFFFFF;
  box-shadow: 2px 2px 20px 1px;
  overflow-x: auto; /* Adiciona rolagem se o conteúdo exceder */
  display: flex;
  flex-direction: column;
  width: 90%; /* Ajuste a largura conforme necessário */
  max-width: 500px; /* Largura máxima */
  border-radius: 0.3rem; /* Border-radius do Bootstrap */
}

.modal-header,
.modal-footer {
  padding: 15px;
  display: flex;
  /* Corrigindo a flex-direction para o header para manter elementos na linha */
  /* e adicionando um gap para espaçamento entre elementos do cabeçalho */
  gap: 10px; /* Espaço entre os elementos, se houver mais de um */
}

.modal-header {
  position: relative;
  border-bottom: 1px solid #eeeeee;
  color: #4AAE9B; /* Cor do título */
  justify-content: space-between; /* Alinha o título à esquerda e o botão de fechar à direita */
  align-items: center;
}

.modal-footer {
  border-top: 1px solid #eeeeee;
  /* Mudando para row, já que você geralmente quer botões lado a lado no rodapé */
  flex-direction: row; 
  justify-content: flex-end; /* Alinha os botões à direita no rodapé */
  gap: 10px; /* Espaço entre os botões do rodapé */
}

.modal-body {
  position: relative;
  padding: 20px 10px;
  flex-grow: 1; /* Permite que o corpo ocupe o espaço restante */
}

.btn-close {
  /* No cabeçalho com justify-content: space-between, o absolute não é estritamente necessário,
     mas se você quiser um posicionamento exato, pode manter. */
  /* position: absolute; */ 
  /* top: 15px; */
  /* right: 15px; */
  border: none;
  font-size: 20px;
  padding: 10px;
  cursor: pointer;
  font-weight: bold;
  background: transparent;
}

/* Transições (opcional, mas melhora a UX) */
.modal-fade-enter-active,
.modal-fade-leave-active {
  transition: opacity .5s ease;
}

.modal-fade-enter-from, /* Vue 3 usa enter-from/leave-to */
.modal-fade-leave-to {
  opacity: 0;
}
</style>