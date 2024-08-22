<template>
  <div v-if="message" class="error-message">
    {{ message }}
  </div>
</template>

<script setup>
const props = defineProps({
  message: {
    type: String,
    default: ''
  }
});
</script>

<style scoped>
.error-message {
  color: #f44336;
  font-size: 0.875em;
  margin-top: 0.25rem;
}
</style>
