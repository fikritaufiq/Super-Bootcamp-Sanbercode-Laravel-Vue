<template>
  <nav class="bg-black p-4 fixed top-0 left-0 right-0 z-10 flex justify-between items-center">
    <div class="dropdown lg:hidden">
      <div tabindex="0" class="btn btn-ghost">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-5 w-5"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor">
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M4 6h16M4 12h8m-8 6h16" />
        </svg>
      </div>
      <ul
        tabindex="0"
        class="menu menu-sm dropdown-content mt-3 z-[1] w-52 bg-black p-2 shadow">
        <li><RouterLink to="/">Home</RouterLink></li>
        <li><RouterLink to="/skills">Skills</RouterLink></li>
        <li><RouterLink to="/experience">Experience</RouterLink></li>
        <li><RouterLink to="/portfolio">Portfolio</RouterLink></li>
      </ul>
    </div>
    <div class="text-white font-bold ml-2">My Portfolio</div>
    <ul class="hidden lg:flex space-x-4">
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

const emit = defineEmits(['scrollTo']);

const handleScroll = (section) => {
  emit('scrollTo', section);
};
</script>

<style scoped>

</style>
