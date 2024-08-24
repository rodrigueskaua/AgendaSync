<template>
  <div class="container">
    <Navbar />

    <div class="user-info-container">
      <div class="user-info">
        <div class="user-icon">
          <span>{{ getInitials(contact.name) }}</span>
        </div>
        <h5 class="user-name">{{ contact.name }}</h5>
      </div>
    </div>

    <ButtonContainer :buttons="buttons" />
    
    <div v-if="showAlert" class="alert alert-info alert-dismissible fade show" role="alert">
      <strong>Atenção!</strong> {{ alertMessage }}
      <button type="button" class="btn-close" aria-label="Close" @click="showAlert = false"></button>
    </div>

    <div class="info-container">
      <h6 class="info-title">Informações Pessoais</h6>
      <div class="info-details">
        <div class="info-item">
          <span class="info-label">E-mail</span>
          <span class="info-value">{{ contact.email }}</span>
        </div>
        <div class="info-item">
          <span class="info-label">Telefone</span>
          <span class="info-value">{{ contact.phone }}</span>
        </div>
        <div class="info-item">
          <span class="info-label">Endereço</span>
          <span class="info-value">{{ contact.address }}</span>
        </div>
      </div>
      <div class="status-info">
        <p>{{ `Adicionado à agenda em ${new Date(contact.created_at).toLocaleDateString('pt-BR', { day: '2-digit', month: '2-digit', year: 'numeric',})}` }}</p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Inertia } from '@inertiajs/inertia';
import Navbar from '@/Components/Navbar.vue';
import ButtonContainer from '@/Components/ButtonContainer.vue';

const buttons = [
  {
    icon: 'bx bx-phone',
    text: 'Ligar',
    buttonClass: 'btn btn-primary',
    onClick: () => { callUser(); }
  },
  {
    icon: 'bx bx-envelope',
    text: 'Email',
    buttonClass: 'btn btn-primary',
    onClick: () => { emailUser(); }
  },
  {
    icon: 'bx bx-edit',
    text: 'Editar',
    buttonClass: 'btn btn-outline-primary',
    onClick: () => { editUser() }
  },
  {
    icon: 'bx bx-trash',
    text: 'Apagar',
    buttonClass: 'btn btn-outline-danger',
    onClick: () => { deleteUser() }
  }
];

import { ref, defineProps, onMounted } from 'vue';
import Swal from 'sweetalert2';

const props = defineProps({
  contact: {
    type: Object,
    default: () => ({
      name: 'Nome não preenchido',
      email: 'Email não preenchido',
      phone: 'Telefone não preenchido',
      address: 'Endereço não preenchido',
      created_at: new Date().toISOString(),
    }),
  },
});

const contact = ref(props.contact);

const showAlert = ref(false);
const alertMessage = ref('');

function getInitials(name) {
  const nameParts = name.split(' ');
  if (nameParts.length === 1) {
    return nameParts[0].charAt(0).toUpperCase();
  }
  return nameParts[0].charAt(0).toUpperCase() + nameParts[1].charAt(0).toUpperCase();
}


function showTemporaryAlert(message) {
  alertMessage.value = message;
  showAlert.value = true;
  setTimeout(() => {
    showAlert.value = false;
  }, 7000);
}

function callUser() {
  showTemporaryAlert('O botão "Ligar" pode não funcionar em alguns navegadores. Em dispositivos móveis, ele pode iniciar uma chamada. Certifique-se de que você tem um aplicativo de telefone configurado.');
  window.location.href = `tel:${contact.value.phone}`;
}

function emailUser() {
  showTemporaryAlert('O botão "Enviar Email" pode não funcionar em alguns navegadores. Ele abrirá o aplicativo de email padrão do dispositivo.');
  window.location.href = `mailto:${contact.value.email}`;
}

function editUser() {
  Inertia.visit(route('contact.edit', {id: contact.value.id,}));
}

function deleteUser() {
  Swal.fire({
    title: 'Você tem certeza?',
    text: 'Esta ação não pode ser desfeita!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Sim, Apagar!',
    cancelButtonText: 'Cancelar',
  }).then((result) => {
    if (result.isConfirmed) {
      Inertia.delete(route('contact.destroy', { id: contact.value.id }))
    }
  });
}
</script>

<style scoped>
.container {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 20px;
}

.user-info-container {
  width: 100%;
  margin-bottom: 20px;
  padding: 20px;
  background: var(--card-background);
  border: var(--card-border);
  border-radius: 12px;
  box-shadow: -1px -1px 30px rgba(73, 73, 73, 0.08);
}

.user-info {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.user-icon {
  width: 100px;
  height: 100px;
  background-color: var(--contact-icon);
  border-radius: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
  margin-bottom: 10px;
  font-size: 48px;
  color: var(--contact-icon-i);
}

.user-icon span {
  font-weight: bold;
}

.user-name {
  font-size: 24px;
  font-weight: bold;
  margin: 0;
}

.info-container {
  width: 100%;
  padding: 20px;
  background: var(--card-background);
  border: var(--card-border);
  border-radius: 12px;
  box-shadow: -1px -1px 30px rgba(73, 73, 73, 0.08);
}

.info-title {
  font-size: 18px;
  font-weight: bold;
  margin-bottom: 15px;
}

.info-details {
  margin-bottom: 30px;
}

.info-item {
  font-size: 16px;
  color: var(--card-text);
  margin: 15px 0;
  padding: 10px;
  border-radius: 8px;
  border: var(--card-border);
  background: var(--card-background);
}

.info-item:hover {
  transition: all .25s;
  opacity: 0.5;
  transform: scale(1.01);
}

.info-label {
  font-weight: bold;
  color: var(--black);
  display: block;
  margin-bottom: 7px;
}

.info-value {
  color: var(--gray-2);
  font-size: 16px;
  display: flex;
  align-items: center;
}

.info-value i {
  margin-right: 10px;
  color: #007bff;
}

.status-info {
  font-size: 14px;
  color: var(--gray-2);
  text-align: right;
  margin-top: 10px;
}

.alert {
  width: 100%!important;
}

.alert-info {
  background-color: #e7f1ff;
  border-color: #bcdff1;
  color: #0056b3;
}

.alert-info .btn-close {
  filter: invert(40%);
}
</style>
