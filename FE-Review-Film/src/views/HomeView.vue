<template>
  <div class="container mx-auto p-4 dark:bg-gray-900 dark:text-white">
    <div class="hero bg-cover bg-center h-64 flex items-center justify-center rounded-lg shadow-lg mb-8">
      <div class="text-center text-white">
        <h1 class="text-4xl font-bold mb-4">Selamat Datang di Review Movie</h1>
        <p v-if="authStore.token" class="text-lg mt-2">Token: {{ authStore.token }}</p>
      </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
      <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-4">Daftar Movie</h2>
        <p>Kumpulan daftar movie yang dapat di review </p>
        <router-link to="/movie" class="block mt-4 text-blue-400 hover:underline">Lihat Movie</router-link>
      </div>
      <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-4">Daftar Genre</h2>
        <p>Kumpulan daftar genre yang disesuaikan dengan movie </p>
        <router-link to="/genre" class="block mt-4 text-blue-400 hover:underline">Lihat Genre</router-link>
      </div>
      <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-4">Daftar Cast</h2>
        <p>Kumpulan daftar pemeran dari movie-movie yang ada</p>
        <router-link to="/cast" class="block mt-4 text-blue-400 hover:underline">Lihat Cast</router-link>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useAuthStore } from '@/stores/AuthStore';
const authStore = useAuthStore();



// Fungsi untuk menampilkan kotak verifikasi (jika diperlukan)
const showVerification = () => {
  // Logika untuk menampilkan kotak verifikasi
  console.log('Menampilkan kotak verifikasi akun');
};
</script>

<style scoped>
.container {
  max-width: 1200px;
  margin: 0 auto;
}

.hero {
  background-image: url('https://example.com/hero-image.jpg'); 
}

body {
  background-color: black;
}
</style>