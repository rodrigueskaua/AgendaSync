<template>
  <div class="btn-wrapper">
    <button :class="buttonClass" @click="onClick">
      <i :class="icon"></i>
    </button>
    <p class="btn-text">{{ text }}</p>
  </div>
</template>

<script setup>
const props = defineProps({
  icon: {
    type: String,
    required: true
  },
  text: {
    type: String,
    required: true
  },
  buttonClass: {
    type: String,
    default: 'btn btn-primary'
  },
  onClick: {
    type: Function,
    required: true
  }
});
</script>

<style scoped>
.btn {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 70px;
  height: 70px; 
  padding: 0;
  border: none;
  border-radius: 50%;
  font-size: 32px;
  transition: background-color 0.3s, box-shadow 0.3s;
  text-align: center;
}

.btn-text {
  text-align: center;
  line-height: 0;
  font-size: 15px;
  margin-top: 20px;
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
</style>
