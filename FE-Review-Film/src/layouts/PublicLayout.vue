<template>
  <div>
    <Header />
    <Navbar />
    <main class="mt-4">
      <router-view v-slot="{ Component }">
        <transition name="fade" mode="out-in">
          <component :is="Component" />
        </transition>
      </router-view>
    </main>
  </div>
</template>

<script setup>
import Header from '../components/Layouts/Header.vue';
import Navbar from '../components/Layouts/Navbar.vue';
</script>

<style scoped>
main {
  padding: 20px;
}
</style>
