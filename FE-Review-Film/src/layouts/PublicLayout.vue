<template>
  <div>
    <Header v-if="authStore.currentColor && authStore.tokenUser" />
    <Navbar />
    <main class="mx-auto max-w-6xl px-8 py-10 my-1 rounded-xl min-h-[80vh]">
      <RouterView v-slot="{ Component, route }">
        <Transition name="fade" mode="out-in">
          <component :is="Component" :key="route.path" />
        </Transition>
      </RouterView>
    </main>
  </div>
</template>

<script setup>
import Header from '../components/Layouts/Header.vue';
import Navbar from '../components/Layouts/Navbar.vue';
import { useAuthStore } from '@/stores/AuthStore';

const authStore = useAuthStore();
</script>

<style scoped>
main {
  padding: 20px;
}
</style>
