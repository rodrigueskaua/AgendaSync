<template>
  <div class="container">
    <Navbar />

    <SearchBar v-model="search" />

    <Notification
      v-if="successMessage"
      :message="notificationMessage"
      :icon="notificationIcon" />

      <div v-if="filteredContacts.length === 0" class="alert alert-info">
        <h4>Bem-vindo!</h4>
        <p>Parece que você ainda não tem contatos cadastrados.</p>
      </div>
      
      <div v-if="filteredContacts.length === 0" class="alert alert-info">
        <p>Você pode adicionar novos contatos clicando no botão "Adicionar Contato" ao lado do campo de busca ou acessando o menu e selecionando "Criar Contato".</p>
      </div>

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

const notificationMessage = ref('');
const notificationIcon = ref('bx bx-info-circle');

function showNotification(message, icon = 'bx bx-info-circle') {
  notificationMessage.value = message;
  notificationIcon.value = icon;
  setTimeout(() => {
    notificationMessage.value = '';
  }, 5000);
}

onMounted(() => {
  if (props.successMessage) {
    showNotification(props.successMessage, 'bx bx-check-circle');
  }
});
</script>

<style scoped></style>
