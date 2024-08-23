<template>
  <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
    <div class="col" v-for="contact in contacts" :key="contact.id">
      <ContactCard
        :contactName="contact.name"
        :contactDetails="contact.email ? contact.email : contact.phone"
        :contactId="contact.id"
      />
    </div>
  </div>
</template>

<script setup>
import ContactCard from '@/Components/ContactCard.vue';
const props = defineProps({
  contacts: {
    type: Array,
    default: () => [],
  },
});

</script>
