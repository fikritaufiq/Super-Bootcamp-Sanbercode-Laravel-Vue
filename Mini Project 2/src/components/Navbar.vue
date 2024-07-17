<template>
  <nav class="bg-black p-4 p-4 fixed top-0 left-0 right-0 z-10 flex justify-between items-center">
    <div class="text-white font-bold">My Portfolio</div>
    <ul class="flex space-x-4">
      <li><RouterLink to="/">Home</RouterLink></li>
      <li><RouterLink to="/skills">Skills</RouterLink></li>
      <li><RouterLink to="/experience">Experience</RouterLink></li>
      <li><RouterLink to="/portfolio">Portfolio</RouterLink></li>
    </ul>
  </nav>
</template>

<script setup>
import { defineEmits } from 'vue';
import { RouterLink } from 'vue-router';

defineEmits(['scrollTo']);

const handleScroll = (section) => {
  emit('scrollTo', section);
};
</script>
