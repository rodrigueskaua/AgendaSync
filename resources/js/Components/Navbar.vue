<template>
  <nav class="navbar bg-body-tertiary fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">AgendaSync</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav">
            <NavLink :href="route('home')" text="Home" icon="bx-home" />
            <NavLink :href="route('contact.create')" text="Criar Contato" icon="bx-folder-plus" />
            <NavLink :href="route('user.index')" text="Perfil" icon="bx-user" />
            <DarkModeToggle />
            <NavLink :href="route('user.logout')" text="Sair | Logout" icon="bx-log-out-circle" />
          </ul>
        </div>
      </div>
    </div>
  </nav>
  
  <div class="content-spacer"></div>
</template>

<script setup>
import NavLink from '@/Components/NavLink.vue';
import DarkModeToggle from '@/Components/DarkModeToggle.vue';

</script>

<style scoped>
.navbar{
  border-bottom: var(--card-border)
}

.navbar .navbar-brand {
  color: var(--black);
}

.navbar .navbar-toggler {
  border-color: transparent!important; 
}

.content-spacer{
  margin-top: 90px;
}
</style>
