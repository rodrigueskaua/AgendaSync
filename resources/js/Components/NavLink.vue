<template>
  <li class="nav-item">
    <a class="nav-link" :href="href">
      <i :class="iconClass"></i> {{ text }}
    </a>
  </li>
</template>

<script>
export default {
  props: {
    href: {
      type: String,
      required: true
    },
    icon: {
      type: String,
      required: true
    },
    text: {
      type: String,
      required: true
    }
  },
  computed: {
    iconClass() {
      return `bx ${this.icon}`;
    }
  }
}
</script>

<style scoped>
.nav-link {
  font-weight: 700;
  display: flex;
  align-items: center;
  padding: 12px 10px;
  font-size: 16px;
  color: var(--primary-color);
  text-decoration: none;
  border-radius: 8px;
  transition: background-color 0.3s, color 0.3s;
}

.nav-link .bx {
  font-size: 20px;
  margin-right: 12px;
}

.nav-link:hover {
  background-color: var(--primary);
  color: #fff;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

</style>
