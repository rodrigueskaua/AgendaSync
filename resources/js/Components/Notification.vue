<template>
  <div v-if="visible" class="notification mb-2">
    <div class="alert alert-info" role="alert">
      <i :class="icon"></i>
      <span>{{ message }}</span>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    message: {
      type: String,
      required: true,
    },
    icon: {
      type: String,
      default: 'bx bx-info-circle'
    }
  },
  data() {
    return {
      visible: true,
    };
  },
  mounted() {
    setTimeout(() => {
      this.visible = false;
    }, 5000);
  },
};
</script>

<style scoped>
.notification {
  width: 100%;
  z-index: 1000;
  display: flex;
  justify-content: center;
}

.alert {
  display: flex;
  align-items: center;
  background-color: #c8dfff;
  border-color: #bcdff1;
  color: #0056b3;
  border-radius: 0;
  width: 100%;
  padding: 15px;
  box-shadow: -1px -1px 30px rgba(73, 73, 73, 0.08);
}

.alert i {
  margin-right: 10px;
  font-size: 24px;
  color: #0c5460; 
}

.alert .btn-close {
  filter: invert(40%);
}
</style>
