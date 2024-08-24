<template>
  <div class="container">
    <Navbar />

    <SearchBar v-model="search" />

    <Notification
      v-if="successMessage"
      :message="successMessage"
      icon="bx bx-check-circle"
      class="persistent-alert"
    />

    <Notification
      v-if="contacts.length === 0 && !successMessage"
      message="Parece que você ainda não tem contatos cadastrados."
      icon="bx bx-info-circle"
      class="persistent-alert"
    />

    <Notification
      v-if="contacts.length === 0 && !successMessage"
      message="Você pode adicionar novos contatos clicando no botão 'Adicionar Contato' ao lado do campo de busca ou acessando o menu e selecionando 'Criar Contato'."
      icon="bx bx-info-circle"
      class="persistent-alert"
    />

    <ContactList v-if="filteredContacts.length > 0" :contacts="filteredContacts" />
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import Navbar from '@/Components/Navbar.vue';
import SearchBar from '@/Components/SearchBar.vue';
import ContactList from '@/Components/ContactList.vue';
import Notification from '@/Components/Notification.vue';

const props = defineProps({
  contacts: Array,
  successMessage: String
});

const search = ref('');

const filteredContacts = computed(() => {
  if (!search.value) {
    return props.contacts;
  }
  return props.contacts.filter(contact =>
    contact.name.toLowerCase().includes(search.value.toLowerCase()) ||
    contact.email.toLowerCase().includes(search.value.toLowerCase())
  );
});

</script>

<style scoped>
</style>
