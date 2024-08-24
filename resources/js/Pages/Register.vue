<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref,computed } from 'vue';

const props = defineProps({
  user: {
    type: Object,
    default: () => ({
      id: null,
      name: '',
      email: '',
      password: '',
      password_confirmation: ''
    }),
  },
});

console.log(props.user)

const user = useForm({
  id: props.user?.id || '',
  name: props.user?.name || '',
  email: props.user?.email || '',
  password: '',
  password_confirmation: '',
});
const loading = ref(false);
const errors = ref({});

const isEditing = computed(() => props.user.id !== undefined && props.user.id !== null);

const submitForm = () => {
  loading.value = true;

  if (isEditing.value) {
    user.put(route('user.update', { id: user.id }), {
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
    user.post(route('user.create'), {
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
  <div class="container d-flex justify-content-center align-items-sm-center align-items-start vh-100 mt-sm-0 mt-3">
    <div class="card-login-register card-register">
      <div class="brand mb-4 d-flex justify-content-center align-items-center">
        <h3>{{ isEditing ? 'Editar Usuário' : 'AgendaSync' }}</h3>
      </div>
  
      <form class="form" @submit.prevent="submitForm" method="post">
        <InputField
          label="Nome"
          type="text"
          name="name"
          placeholder="Digite seu Nome"
          v-model="user.name"
          :errorMessage="errors.name"
          :invalid="!!errors.name"
          required
        />
  
        <InputField
          label="Email"
          type="email"
          name="email"
          placeholder="Digite seu Email"
          v-model="user.email"
          :errorMessage="errors.email"
          :invalid="!!errors.email"
          required
        />
  
        <InputField
          label="Senha"
          type="password"
          name="password"
          placeholder="Digite sua Senha"
          v-model="user.password"
          :errorMessage="errors.password"
          :invalid="!!errors.password"
          required
        />
  
        <InputField
          label="Confirme sua senha"
          type="password"
          name="password_confirmation"
          placeholder="Digite sua Senha novamente"
          v-model="user.password_confirmation"
          :errorMessage="errors.password_confirmation"
          :invalid="!!errors.password_confirmation"
          required
        />
  
        <div class="form-buttons mb-4">
          <button type="submit" class="btn-register">{{ isEditing ? 'Editar' : 'Cadastre-se' }}</button>
        </div>
      </form>
  
      <div v-if="!isEditing" class="sign-in text-center">
        <p>Já possui uma conta? <a :href="route('login')">Faça Login</a></p>
      </div>
    </div>
  </div>
  </template>
  
  
<script>
import InputField from '@/Components/InputField.vue';
import { useForm } from '@inertiajs/vue3';

export default {
  name: 'Register',
  components: {
    InputField,
  }
};
</script>

<style scoped>
.card-login-register {
  width: 500px;
  border-radius: 20px;
  background: var(--card-background);
  border: var(--card-border);
  box-shadow: -1px -1px 30px rgba(0, 0, 0, 0.25);
}

.card-register {
  padding: 50px 40px;
}

.card-login-register>div {
  width: 100%;
}

.card-login-register>.brand>img {
  width: 40px;
  margin-right: 8px;
}

.card-login-register>.brand>h3 {
  color: var(--black);
  font-size: 32px;
}

.card-login-register>.form {
  margin-top: 40px;
  width: 100%;
}

.form-buttons>.btn-register {
  width: 100%;
  height: 45px;
  border-radius: 8px;
  padding: 12px 0px;
  font-weight: 500;
  color: var(--white);
  outline: none;
  border: none;
  transition: var(--transition-btn);
}

.form-buttons>.btn-login,
.form-buttons>.btn-register {
  background-color: var(--primary);
  font-size: 15px;
}

.form-buttons>.btn-login:hover,
.form-buttons>.btn-register:hover {
  transition: var(--transition-btn);
  background-color: var(--primary-dark);
}

.form-buttons>.btn-google:hover {
  transition: var(--transition-btn);
  opacity: 0.8;
}

.card-login-register>.sign-up>p,
a,
.sign-in>p,
a {
  font-size: 14px;
  margin: 0;
}

.card-login-register>.sign-up>p,
.sign-in>p {
  color: var(--black);
}

.card-login-register>.sign-up>a,
.sign-in a {
  color: var(--primary);
  transition: var(--transition-text);
}

.card-login-register>.sign-up>a:hover,
.sign-in a:hover {
  color: var(--primary-dark);
}

@media (max-width: 768px) {
  .card-register {
    padding: 30px 20px;
  }

  .form>.form-buttons>button {
    height: 40px;
    font-size: 13px;
    padding: 8px 0px;
  }
  
  .card-login-register>.sign-up>p,
  .sign-in>p,
  .card-login-register>.sign-up>a,
  .sign-in a {
    font-size: 13px;
  }
}

@media (max-width: 410px) {
  .card-login-register>.brand>h3 {
    font-size: 24px;
  }
}
</style>
  