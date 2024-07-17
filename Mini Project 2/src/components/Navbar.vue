<template>
  <nav class="bg-black p-4 p-4 fixed top-0 left-0 right-0 z-10 flex justify-between items-center">
    <div class="text-white font-bold">My Portfolio</div>
    <ul class="flex space-x-4">
      <li @click="handleScroll('homeSection')" class="text-white font-bold cursor-pointer">Home</li>
      <li @click="handleScroll('skillsSection')" class="text-white font-bold cursor-pointer">Skills</li>
      <li @click="handleScroll('portfolioSection')" class="text-white font-bold cursor-pointer">Portfolio</li>
      <li @click="handleScroll('experienceSection')" class="text-white font-bold cursor-pointer">Experience</li>
    </ul>
  </nav>
</template>

<script setup>
import { defineEmits } from 'vue';

defineEmits(['scrollTo']);

const handleScroll = (section) => {
  emit('scrollTo', section);
};
</script>
