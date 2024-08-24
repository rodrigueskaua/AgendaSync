<template>
  <div class="card contact-card" @click="navigateToContact">
    <div class="contact-icon"
    :style="{ backgroundColor: generateColor(contactName) }"
    :data-contact-name="contactName" 
    v-if="isAlphabetic(contactName)">
      <span>{{ getInitials(contactName) }}</span>
    </div>
    <div class="contact-icon" v-else>
      <i class='bx bx-user'></i>
    </div>
    <div class="card-body">
      <h5 class="card-title">{{ contactName || 'Nome não preenchido' }}</h5>
      <p class="card-text">{{ contactDetails || 'Detalhes não preenchidos' }}</p>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const props = defineProps({
  contactName: {
    type: String,
    default: '',
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

function isAlphabetic(name) {
  return /[a-zA-Z]/.test(name);
}

function getInitials(name) {
  const nameParts = name.split(' ');
  if (nameParts.length === 1) {
    return nameParts[0].charAt(0).toUpperCase();
  }
  return nameParts[0].charAt(0).toUpperCase() + nameParts[1].charAt(0).toUpperCase();
}

const isDarkMode = ref(document.body.getAttribute('data-bs-theme') === 'dark');

const generateColor = (name) => {
  let hash = 0;
  for (let i = 0; i < name.length; i++) {
    hash = name.charCodeAt(i) + ((hash << 5) - hash);
  }
  const hue = Math.abs(hash) % 360;
  const saturation = isDarkMode.value ? 20 + (Math.abs(hash) % 20) : 60 + (Math.abs(hash) % 20);
  const lightness = isDarkMode.value ? 30 + (Math.abs(hash) % 10) : 70 + (Math.abs(hash) % 20);
  return `hsl(${hue}, ${saturation}%, ${lightness}%)`;
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

.contact-icon span {
  font-size: 24px;
  font-weight: bold;
  color: var(--contact-icon-i);
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
