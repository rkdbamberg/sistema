<template>
  <div>
    <InternalHeader />
    <div class="d-flex">
      <InternalSidebar />
      <main class="flex-fill p-3">
        <slot />
      </main>
    </div>
    <InternalFooter />
    <InternalPreload />
  </div>
</template>

<script>
import InternalHeader from '../components/internal/InternalHeader.vue'
import InternalSidebar from '../components/internal/InternalSidebar.vue'
import InternalFooter from '../components/internal/InternalFooter.vue'
import InternalPreload from '../components/internal/InternalPreload.vue'

export default {
  name: 'InternalLayout',
  components: {
    InternalHeader,
    InternalSidebar,
    InternalFooter,
    InternalPreload
  },
  meta: {
    title: 'Área Interna - Sistema'
  }
}
</script>
