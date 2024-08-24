<template>
  <NavLink @click="handleToggleDarkMode" href="#" :text="darkModeName" :icon="darkModeIcon" />
  </template>

<script setup>
import { ref, onMounted } from 'vue';

import { toggleDarkMode, initializeDarkMode } from '@/utils/darkMode';
import NavLink from '@/Components/NavLink.vue';

const darkModeIcon = ref('bx-moon');
const darkModeName = ref('Modo Escuro');

onMounted(() => {
  initializeDarkMode();
  updateUI();
});

function updateUI() {
  const isDarkMode = document.body.classList.contains('dark-mode');
  darkModeIcon.value = isDarkMode ? 'bx-sun' : 'bx-moon';
  darkModeName.value = isDarkMode ? 'Modo Claro' : 'Modo Escuro';
}

function handleToggleDarkMode() {
  toggleDarkMode();
  updateUI();
}
</script>
