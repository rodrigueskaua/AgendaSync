<!-- resources/js/Pages/Test.vue -->
<template>
  <div class="container mt-5">
    <h1 class="text-center">Tela de Teste</h1>
    <p class="text-center">Se o Bootstrap estiver funcionando, o botão abaixo deve ter um estilo Bootstrap.</p>
    <TestButton />
  </div>
</template>

<script>
import TestButton from '../Components/TestButton.vue';

export default {
  components: {
    TestButton
  }
};
</script>

<style scoped>
/* Adicione estilos específicos da página aqui, se necessário */
</style>
