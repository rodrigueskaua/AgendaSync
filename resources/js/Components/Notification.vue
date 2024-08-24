<template>
  <div v-if="isVisible" class="notification" :class="className">
    <div class="alert">
      <i :class="icon"></i>
      <span>{{ message }}</span>
      <button class="btn-close" @click="hideNotification">×</button>
    </div>
  </div>
</template>

<script setup>
import { ref, watch } from 'vue';

const props = defineProps({
  message: String,
  icon: String,
  autoDismiss: {
    type: Boolean,
    default: true
  },
  className: String
});

const isVisible = ref(true);

function hideNotification() {
  isVisible.value = false;
}

watch(() => props.message, (newValue) => {
  if (newValue && props.autoDismiss) {
    setTimeout(() => {
      hideNotification();
    }, 5000);
  }
}, { immediate: true });
</script>

<style scoped>
.notification {
  width: 100%;
  z-index: 1000;
  display: flex;
  justify-content: center;
}

span{
  width: 100%;
}

.alert {
  display: flex;
  align-items: center;
  background-color: var(--primary-light);
  border: 1px solid var(--primary-dark);
  color: var(--black);
  border-radius: 5px;
  width: 100%;
  padding: 15px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.alert i {
  margin-right: 10px;
  font-size: 24px;
  color: var(--primary-dark);
}

.alert .btn-close {
  filter: invert(40%);
  color: var(--primary-dark);
  font-size: 18px;
}
</style>
