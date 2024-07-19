<template>
  <div class="wrapper">
    <Navbar @scrollTo="scrollTo" />
    <div class="content mt-16">
      <router-view v-slot="{ Component }">
        <transition name="fade" mode="out-in">
          <component :is="Component" />
        </transition>
      </router-view>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import Navbar from './components/Navbar.vue';

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
  if (element && element.value) {
    element.value.scrollIntoView({ behavior: 'smooth' });
  }
};
</script>

<style scoped>
.wrapper {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
  background: linear-gradient(to bottom, #3123b2, #9ec2db);
}

.content {
  flex: 1;
}

.section {
  margin-bottom: 2rem;
  color: black;
  background-color: #9ec2db;
  max-width: 1000px;
  margin-left: auto;
  margin-right: auto;
}

.fade-enter-active, .fade-leave-active {
  transition: opacity 0.5s;
}
.fade-enter, .fade-leave-to {
  opacity: 0;
}

html {
  scroll-behavior: smooth;
}
</style>
