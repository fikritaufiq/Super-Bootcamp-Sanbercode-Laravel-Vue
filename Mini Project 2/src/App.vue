<template>
  <div class="wrapper">
    <Navbar @scrollTo="scrollTo" />
    <div class="content mt-16">
      <Home ref="homeSection" />
      <Skills ref="skillsSection" />
      <Portfolio ref="portfolioSection" />
      <Experience ref="experienceSection" />
    </div>

  </div>
</template>

<script setup>
import { ref } from 'vue';
import Navbar from './components/Navbar.vue';
import Home from './components/Home.vue';
import Skills from './components/Skills.vue';
import Portfolio from './components/Portfolio.vue';
import Experience from './components/Experience.vue';
import Footer from './components/Footer.vue';

const homeSection = ref(null);
const skillsSection = ref(null);
const portfolioSection = ref(null);
const experienceSection = ref(null);

const scrollTo = (section) => {
  const element = {
    homeSection,
    skillsSection,
    portfolioSection,
    experienceSection,
  }[section];
  if (element.value) {
    element.value.scrollIntoView({ behavior: 'smooth' });
  }
};
</script>

<style scoped>

.wrapper {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
  background: linear-gradient(to bottom, #3123b2, #9ec2db); /* Gradient dari atas (#2d0f47) ke bawah (#6096ba) */
}

.content {
  flex: 1;
}

.section {
  margin-bottom: 2rem;
  color: black; /* Sesuaikan warna teks jika diperlukan */
  background-color: #9ec2db;
  max-width: 1000px; /* Atur lebar maksimal sesuai kebutuhan */
  margin-left: auto;
  margin-right: auto;
}

html {
  scroll-behavior: smooth;
}

/* Tambahkan gaya responsif sesuai kebutuhan */
</style>
