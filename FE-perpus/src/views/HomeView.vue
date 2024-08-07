<template>
  <div>
    <h1>Selamat Datang di Aplikasi Perpustakaan</h1>
    <p v-if="isAuthenticated">Halo, {{ userName }}!</p>
    <p v-else>Ini adalah tampilan Home yang dapat diakses tanpa autentikasi.</p>
    

  </div>
</template>

<script setup>
import { ref, watch } from 'vue';
import { useAuthStore } from '../stores/AuthStore';

const authStore = useAuthStore();
const isAuthenticated = ref(authStore.isAuthenticated);
const userName = ref(authStore.user ? authStore.user.name : '');

const logout = () => {
  authStore.logout();
  isAuthenticated.value = false; 
};

watch(() => authStore.user, (newUser) => {
  userName.value = newUser ? newUser.name : '';
});
</script>

<style scoped>

</style>