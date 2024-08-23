<template>
  <div class="card contact-card" @click="navigateToContact">
    <div class="contact-icon">
      <i class='bx bx-user'></i>
    </div>
    <div class="card-body">
      <h5 class="card-title">{{ contactName }}</h5>
      <p class="card-text">{{ contactDetails }}</p>
    </div>
  </div>
</template>

<script setup>
const props = defineProps({
  contactName: {
    type: String,
    default: 'Nome não preenchido',
  },
  contactDetails: {
    type: String,
    default: 'Detalhes não preenchido',
  },
  contactId: {
    type: [Number, String],
    default: null,
  },
});

const navigateToContact = () => {
  if (props.contactId) {
    window.location.href = `/contact/${props.contactId}`;
  }
};
</script>

<style scoped>
.contact-card {
  display: flex;
  align-items: center;
  flex-direction: row;
  padding: 0px 10px;
  margin-bottom: 20px;
  background: #FFFFFF;
  border: 1.5px solid rgba(67, 67, 67, 0.15);
  box-shadow: -1px -1px 30px rgba(73, 73, 73, 0.08);
  border-radius: 12px;
  cursor: pointer;
  text-decoration: none;
  color: inherit;
  overflow: hidden;
}

.contact-card:hover {
  transition: all 0.25s;
  transform: scale(1.02);
  box-shadow: -1px -1px 20px rgba(0, 0, 0, 0.2);
}

.contact-icon {
  min-width: 50px;
  min-height: 50px;
  background-color: #e9ecef;
  border-radius: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
}
.contact-icon i {
  font-size: 24px;
  color: #6c757d;
}

.card-body {
  flex: 1;
  width: 100%;
  max-width: 100%;
  box-sizing: border-box;
}

.card-title {
  font-size: 18px;
  font-weight: bold;
  margin: 0;
}

.card-text {
  font-size: 14px;
  color: #666;
  margin-top: 4px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
</style>
