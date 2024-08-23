<script setup>
import { ref, onMounted, computed } from 'vue';
import { useForm } from '@inertiajs/vue3';
import Navbar from '@/Components/Navbar.vue';
import InputField from '@/Components/InputField.vue';

const props = defineProps({
  contact: {
    type: Object,
    default: () => ({
      id: null,
      name: '',
      email: '',
      phone: '',
      address: '',
    }),
  },
});

const isEditing = computed(() => !!props.contact);

const contact = useForm({
  id: props.contact?.id || '',
  name: props.contact?.name || '',
  email: props.contact?.email || '',
  phone: props.contact?.phone || '',
  address: props.contact?.address || ''
});

const loading = ref(false);
const errors = ref({});

const submitForm = () => {
  loading.value = true;

  if (isEditing.value) {
    contact.put(route('contact.update', {id: contact.id,}), {
      onSuccess: () => {
        errors.value = {};
        loading.value = false;
      },
      onError: (validationErrors) => {
        errors.value = validationErrors;
        loading.value = false;
      },
    });
  } else {
    contact.post(route('contact.create'), {
      onSuccess: () => {
        errors.value = {};
        loading.value = false;
      },
      onError: (validationErrors) => {
        errors.value = validationErrors;
        loading.value = false;
      },
    });
  }
};
</script>

<template>
  <div class="container">
    <Navbar />

    <div class="card-contact">
      <div class="card-contact-header">
        <div class="brand text-center">
          <h3>{{ isEditing ? 'Editar Contato' : 'Criar Novo Contato' }}</h3>
        </div>
      </div>
      <div class="contact-register">
        <form class="form" @submit.prevent="submitForm">
          <InputField
            label="Nome"
            type="text"
            name="name"
            placeholder="Digite o Nome do Contato"
            v-model="contact.name"
            :errorMessage="errors.name"
            :invalid="!!errors.name"
            required />

          <InputField
            label="E-mail"
            type="email"
            name="email"
            placeholder="Digite o E-mail do Contato"
            v-model="contact.email"
            :errorMessage="errors.email"
            :invalid="!!errors.email"
            required />

          <InputField
            label="Telefone"
            type="tel"
            name="phone"
            placeholder="Digite o Telefone do Contato"
            v-model="contact.phone"
            :errorMessage="errors.phone"
            :invalid="!!errors.phone" />

          <InputField
            label="Endereço"
            type="text"
            name="address"
            placeholder="Digite o Endereço do Contato"
            v-model="contact.address"
            :errorMessage="errors.address"
            :invalid="!!errors.address" />

          <div class="form-buttons">
            <button type="submit" class="btn-save w-100" :disabled="loading">
              <span v-if="loading">Salvando...</span>
              <span v-else>Salvar Contato</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import Navbar from '@/Components/Navbar.vue';
import InputField from '@/Components/InputField.vue';
</script>

<style scoped>
.card-contact {
  width: 100%;
  max-width: 500px;
  border-radius: 12px;
  background: #FFFFFF;
  border: 1.5px solid rgba(67, 67, 67, 0.15);
  box-shadow: -1px -1px 30px rgba(0, 0, 0, 0.089);
  padding: 30px;
  margin: 0 auto;
}

.card-contact-header {
  margin-bottom: 20px;
}

.card-contact-header .brand {
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
}

.card-contact-header .brand h3 {
  color: var(--black);
  font-size: 32px;
}

.card-contact .form {
  margin-top: 20px;
}

.form-buttons {
  display: flex;
  margin-top: 1rem;
}

.btn-save{
  width: 48%;
  height: 45px;
  border-radius: 8px;
  padding: 12px 0;
  font-weight: 500;
  color: var(--white);
  outline: none;
  border: none;
  transition: var(--transition-btn);
}

.btn-save {
  background-color: var(--primary);
}

.btn-save:hover {
  background-color: var(--primary-dark);
}

@media (max-width: 768px) {
  .card-contact {
    padding: 20px;
  }

  .btn-save {
    height: 40px;
    font-size: 13px;
    padding: 8px 0;
  }
  
  .card-contact-header .brand h3 {
    font-size: 24px;
  }
}

@media (max-width: 410px) {
  .card-contact-header .brand h3 {
    font-size: 20px;
  }
}
</style>
