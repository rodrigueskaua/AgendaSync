<template>
  <div class="container">
    <Navbar />
    
    <SearchBar v-model="search" />

    <ContactList :contacts="filteredContacts" />         
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import Navbar from '@/Components/Navbar.vue';
import SearchBar from '@/Components/SearchBar.vue';
import ContactList from '@/Components/ContactList.vue';

const props = defineProps({
  contacts: Array
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
