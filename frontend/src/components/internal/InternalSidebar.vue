<template>
  <div>
    <!--b-button v-b-toggle.sidebar-1>Toggle Sidebar</b-button-->
    <!--b-sidebar id="sidebar-1" title="Sidebar" shadow>
      <div class="px-3 py-2">
        <p>
          Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis
          in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.
        </p>
        <b-img src="https://picsum.photos/500/500/?image=54" fluid thumbnail></b-img>
      </div>
    </b-sidebar-->

    <aside class="bg-light border-end p-3" style="width: 220px; min-height: 100vh;">
      <nav>
        <ul class="nav flex-column">
          <li class="nav-item mb-2">
            <router-link to="/dashboard" class="nav-link d-flex align-items-center">
              <i class="fa-solid fa-gauge me-2"></i>
              Dashboard
            </router-link>
          </li>
          <li class="nav-item mb-2">
            <router-link to="/produtos" class="nav-link d-flex align-items-center">
              <i class="fa-solid fa-boxes-stacked me-2"></i>
              Produtos
            </router-link>
          </li>
          <li class="nav-item mb-2">
            <router-link to="/outra-pagina" class="nav-link d-flex align-items-center">
              <i class="fa-solid fa-file-lines me-2"></i>
              Outra Página
            </router-link>
          </li>
        </ul>
      </nav>
    </aside>
  </div>
</template>

<script>
export default {
  name: 'InternalSidebar'
}
</script>
