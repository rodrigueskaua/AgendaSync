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

    <div class="buttons-container">
      <div class="action-buttons">
        <div class="btn-wrapper">
          <button class="btn btn-primary" @click="callUser">
            <i class='bx bx-phone'></i>
          </button>
          <p class="btn-text">Ligar</p>
        </div>
        <div class="btn-wrapper">
          <button class="btn btn-primary" @click="emailUser">
            <i class='bx bx-envelope'></i>
          </button>
          <p class="btn-text">Enviar Email</p>
        </div>
        <div class="btn-wrapper">
          <button class="btn btn-outline-primary" @click="editUser">
            <i class='bx bx-edit'></i>
          </button>
          <p class="btn-text">Editar</p>
        </div>
        <div class="btn-wrapper">
          <button class="btn btn-outline-danger" @click="deleteUser">
            <i class='bx bx-trash'></i>
          </button>
          <p class="btn-text">Apagar</p>
        </div>
      </div>
    </div>
    
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
  window.location.href = `tel:${contact.phone}`;
}

function emailUser() {
  showTemporaryAlert('O botão "Enviar Email" pode não funcionar em alguns navegadores. Ele abrirá o aplicativo de email padrão do dispositivo.');
  window.location.href = `mailto:${contact.email}`;
}

function editUser() {
  console.log(contact)
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
  background: #ffffff;
  border-radius: 12px;
  border: 1.5px solid rgba(67, 67, 67, 0.15);
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
  background-color: #e9ecef;
  border-radius: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
  margin-bottom: 10px;
  font-size: 48px;
  color: #6c757d;
}

.user-icon span {
  font-weight: bold;
}

.user-name {
  font-size: 24px;
  font-weight: bold;
  margin: 0;
}

.buttons-container {
  width: 100%;
  margin-bottom: 20px;
  padding: 20px;
  background: #ffffff;
  border-radius: 12px;
  border: 1.5px solid rgba(67, 67, 67, 0.15);
  box-shadow: -1px -1px 30px rgba(73, 73, 73, 0.08);
}

.action-buttons {
  display: flex;
  justify-content: center;
  flex-direction: row!important;
  gap: 45px!important; 
}

.btn-wrapper {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.btn {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 80px;
  height: 80px;
  padding: 0;
  border: none;
  border-radius: 50%;
  font-size: 24px;
  transition: background-color 0.3s, box-shadow 0.3s;
}

.action-buttons {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.btn {
  font-size: 32px;
  width: 70px;
  height: 70px;
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 50%;
  padding: 0;
  border: none;
  transition: background-color 0.3s, box-shadow 0.3s;
  text-align: center;
}

.btn-text {
  line-height: 0;
  font-size: 15px;
  margin-top: 20px;
}

@media (max-width: 768px) {
  .btn {
    font-size: 24px;
    width: 50px;
    height: 50px;
  }

  .btn-text {
    font-size: 13px;
  }
}

.btn-primary {
  background-color: var(--primary);
  color: #fff;
}

.btn-primary:hover {
  background-color: var(--primary-dark);
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.btn-secondary {
  background-color: #6c757d;
  color: #fff;
}

.btn-secondary:hover {
  background-color: #5a6268;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.btn-outline-primary {
  background-color: transparent;
  color: var(--primary-dark);
  border: 2px solid var(--primary-dark);
}

.btn-outline-primary:hover {
  background-color: var(--primary-dark);
  color: #fff;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.btn-outline-danger {
  background-color: transparent;
  color: var(--primary-dark);
  border: 2px solid var(--primary-dark);
}

.btn-outline-danger:hover {
  background-color: #db140d;
  border: 2px solid #db140d;
  color: #fff;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.info-container {
  width: 100%;
  padding: 20px;
  background: #ffffff;
  border-radius: 12px;
  border: 1.5px solid rgba(67, 67, 67, 0.15);
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
  color: #666;
  margin: 15px 0;
  padding: 10px;
  border-radius: 8px;
  border: 1px solid #dee2e6;
  background: #ffffff;
}

.info-item:hover {
  background: #e9ecef;
  border-color: #ced4da;
}

.info-label {
  font-weight: bold;
  color: #333;
  display: block;
  margin-bottom: 7px;
}

.info-value {
  color: #333;
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
  color: #888;
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
