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
  background: var(--card-background);
  border: var(--card-border);
  box-shadow: -1px -1px 30px rgba(131, 131, 131, 0.08);
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
  background-color: var(--contact-icon);
  border-radius: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
}
.contact-icon i {
  font-size: 24px;
  color:  var(--contact-icon-i);
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
  color: var();
}

.card-text {
  font-size: 14px;
  color: var(--card-text);
  margin-top: 4px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
</style>
