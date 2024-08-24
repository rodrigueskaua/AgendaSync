<template>
  <div class="button-container">
    <div :class="{'grid': buttons.length > 1}">
      <Button
        v-for="(button, index) in buttons"
        :key="index"
        :icon="button.icon"
        :text="button.text"
        :buttonClass="button.buttonClass"
        :onClick="button.onClick"
      />
    </div>
  </div>
</template>

<script setup>
import Button from './ButtonWrapper.vue';

const props = defineProps({
  buttons: {
    type: Array,
    required: true,
    validator: (value) => value.every(button => 
      typeof button.icon === 'string' &&
      typeof button.text === 'string' &&
      typeof button.buttonClass === 'string' &&
      typeof button.onClick === 'function'
    )
  }
});
</script>

<style scoped>
.button-container {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
  margin-bottom: 20px;
  padding: 20px;
  border-radius: 12px;
  border: var(--card-border);
  background: var(--card-background);
  color: var(--card-text);
  box-shadow: -1px -1px 30px rgba(73, 73, 73, 0.08);
}

.grid {
  display: flex;
  flex-wrap: wrap;
  gap: 45px;
  justify-content: center;
}

@media (max-width: 768px) {
  .grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: calc(5vw + 10px) calc(20vw + 10px);
  }
}
</style>
