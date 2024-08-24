<template>
  <div class="form-group mb-3">
    <label :for="id">{{ label }}</label><br>
    <input
      :id="id"
      :type="type"
      :value="modelValue"
      @input="updateValue($event.target.value)"
      :class="['form-control', { 'is-invalid': invalid }]"
      :placeholder="placeholder"
      :required="required"
      :autocomplete="autocomplete"
    />
    <ErrorMessage :message="errorMessage[0]" v-if="errorMessage" />
  </div>
</template>

<script setup>
import { defineProps, defineEmits } from 'vue';
import ErrorMessage from '@/Components/ErrorMessage.vue';

const props = defineProps({
  id: String,
  label: String,
  type: {
    type: String,
    default: 'text',
  },
  modelValue: String,
  placeholder: String,
  required: {
    type: Boolean,
    default: false,
  },
  autocomplete: {
    type: String,
    default: 'off',
  },
  invalid: {
    type: Boolean,
    default: false,
  },
  errorMessage: Array
});

const emit = defineEmits(['update:modelValue']);

function updateValue(value) {
  emit('update:modelValue', value);
}
</script>

<style scoped>
.form-group>label {
  color: var(--black);
  font-size: 16px;
  font-weight: 400;
  margin-bottom: 5px;
}

.form-group>.input-icon {
  position: absolute;
  z-index: 2;
  height: 2rem;
  line-height: 3rem;
  margin-left: 8px;
  text-align: center;
  color: var(--white);
  font-size: 20px;
  transition: color 0.3s ease-in-out;
}

.form-group>.form-control {
  height: 55px;
  padding: 8px 8px 8px 16px;
  font-size: 16px;
  border-color: transparent;
  box-shadow: none;
  background-color: var(--input-background);
  border-radius: 6px;
  color: var(--input-color);
  transition: border-color 0.3s linear;
}

.form-group>.form-control:focus {
  border-color: var(--primary);
}

.form-group>.form-control:focus-within .input-icon {
  color: var(--primary);
}

.form-group>.form-control::placeholder {
  color: var(--gray);
}

.form-group>.alert {
  background-color: var(--primary-dark);
  color: var(--black);
  font-size: 14px;
  padding: .4rem .4rem;
  border: none;
  border-radius: 0;
}

.form-check>.form-check-label {
  color: var(--black);
  font-size: 12px;
  font-weight: 300;
}

.form-check>.form-check-input:checked {
  background-color: var(--primary);
  border: none;
}

.is-invalid {
  border-color: var(--is-invalid-color)!important;
}

</style>
