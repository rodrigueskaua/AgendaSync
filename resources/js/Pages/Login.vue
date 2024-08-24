<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const user = useForm({
  email: '',
  password: '',
});

const errors = ref({});

const login = () => {
  user.post(route('user.login'), {
    onSuccess: () => {
      errors.value = {};
    },
    onError: (validationErrors) => {
      errors.value = validationErrors;
    },
  });
};
</script>

<template>
  <div class="container d-flex justify-content-center align-items-sm-center align-items-start vh-100 mt-sm-0 mt-3">
    <div class="card-login-register card-login">
      <div class="brand mb-4 d-flex justify-content-center align-items-center">
        <h3>AgendaSync</h3>
      </div>

      <form @submit.prevent="login" method="post" class="form">
        <InputField
          id="email"
          label="Email"
          type="email"
          v-model="user.email"
          :errorMessage="errors.email"
          :invalid="!!errors.email"
          placeholder="Digite seu Email"
          required />
        <InputField
          id="password"
          label="Senha"
          type="password"
          v-model="user.password"
          :errorMessage="errors.password"
          :invalid="!!errors.password"
          placeholder="Digite sua Senha"
          required />

        <div class="form-buttons mt-4 mb-4">
          <button type="submit" class="btn-login">Login</button>
          <div class="divider">
            <hr>
          </div>
          <a :href="route('login.google')" class="btn-google d-flex justify-content-center align-items-center">
            <GoogleIcon/>
          </a>
        </div>
      </form>

      <div class="sign-up text-center">
        <p>Não possui uma conta? <a :href="route('register')">Cadastre-se</a></p>
      </div>
    </div>
  </div>
</template>

<script>
import InputField from '@/Components/InputField.vue';
import GoogleIcon from '@/Components/GoogleIcon.vue';
</script>

<style scoped>
.card-login-register {
  width: 500px;
  border-radius: 20px;
  background: var(--card-background);
  border: var(--card-border);
  box-shadow: -1px -1px 30px rgba(0, 0, 0, 0.25);
}

.card-login {
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

.form>div>.forgot-password>a {
  color: var(--primary-dark);
  font-size: 15px;
  font-weight: 300;
  text-decoration: none;
  transition: var(--transition-text);
}

.form>div>.forgot-password>a:hover {
  color: var(--primary);
}

.card-login .form-buttons {
  margin-top: 15px;
}

.form-buttons>.btn-login,
.form-buttons>.btn-google,
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

.form-buttons>.divider {
  background-color: var(--hr-divider);
  margin: 20px 0px;
}

.form-buttons>.btn-google {
  background: var(--black);
  font-size: 14px;
  -webkit-appearance: button;
  -moz-appearance: button;
  appearance: button;
  text-decoration: none;
}

.form-buttons>.btn-google>img {
  margin-right: 5px;
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

  .card-login {
    padding: 30px 20px;
  }

  .form>.form-buttons>button {
    height: 40px;
    font-size: 13px;
    padding: 8px 0px;
  }

  .form>.form-buttons>.btn-google {
    font-size: 12px;
  }

  .card-login-register>.sign-up>p,
  .sign-in>p,
  .card-login-register>.sign-up>a,
  .sign-in a {
    font-size: 13px;
  }
}

@media (max-width: 410px) {
  .card-login-register>.brand>img {
    width: 30px;
  }

  .card-login-register>.brand>h3 {
    font-size: 24px;
  }
}
</style>
