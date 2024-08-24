<script setup>
import { ref, defineEmits } from 'vue';

const emit = defineEmits(['update:modelValue']);

const query = ref('');

const emitSearch = () => {
  emit('update:modelValue', query.value);
};
</script>

<template>
  <div class="search-container mb-4">
    <div class="input-group">
      <span class="input-group-text">
        <i class='bx bx-search'></i>
      </span>
      <input 
        type="text" 
        class="form-control search-input" 
        placeholder="Pesquisar contato" 
        v-model="query" 
        @input="emitSearch"
      />
    </div>
    <a
      :href="route('contact.create')"
      class="btn btn-primary ms-2 btn-add-contact" 
      type="button">
      <i class='bx bx-plus'></i>
    </a>
  </div>
</template>

<script>
export default {
  name: 'SearchBar',
}
</script>

<style scoped>
.search-container {
  display: flex;
  align-items: center;
}

.input-group-text {
  background-color: #F3F3F3;
  border: none;
  border-radius: 6px 0 0 6px;
  padding: 8px 15px;
  font-size: 18px;
  color: #00000083;
}

.form-control {
  height: 55px;
  padding: 8px 0px;
  font-size: 16px;
  border-color: transparent;
  box-shadow: none;
  background-color: #F3F3F3;
  border-radius: 0 6px 6px 0;
  color: #808080c2;
  transition: border-color 0.3s linear;
}

.form-group>.form-control:focus {
  border-color: var(--primary);
}

.btn-add-contact {
  background-color: var(--primary);
  font-size: 24px;
  height: 45px;
  padding: 10px;
  border-radius: 100%;
  border: none;
  display: flex;
  align-items: center;
  justify-content: center;
}

.btn-add-contact:hover {
  background-color: var(--primary-dark);
}
</style>
