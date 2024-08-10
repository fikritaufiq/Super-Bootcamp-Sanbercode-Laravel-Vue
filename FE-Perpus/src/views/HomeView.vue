<template>
  <NavBar :navItems="filteredNav" />
  <div class="container mx-auto p-4 bg-gradient-to-r from-gray-800 to-gray-900 text-white flex flex-col items-center h-screen">
    <div class="flex flex-col items-center justify-center w-full h-full">
      <div class="text-center w-full mb-8">
        <h1 class="text-6xl font-extrabold pb-4">Selamat Datang di Perpustakaan Online</h1>
        <p class="mt-4 text-lg">
          <span v-if="!authStore.tokenUser">
            Untuk menjelajahi lebih lanjut, silakan Login atau Register terlebih dahulu.
          </span>
          <span v-else>
            Silakan jelajahi semua yang ada di perpustakaan kami.
          </span>
        </p>
      </div>
      <main id="main" class="grid md:grid-cols-3 place-items-center w-full gap-6">
  <div class="card bg-gray-800 shadow-xl text-center w-full rounded-lg overflow-hidden">
    <div class="card-body p-6">
      <h2 class="card-title text-2xl font-bold text-white">Kategori Buku</h2>
      <p class="text-gray-300">Jelajahi berbagai kategori buku yang tersedia.</p>
      <div class="card-actions justify-center mt-4">
        <router-link to="/category" class="btn btn-primary">Lihat Kategori</router-link>
      </div>
    </div>
  </div>
  <div class="card bg-gray-800 shadow-xl text-center w-full rounded-lg overflow-hidden">
    <div class="card-body p-6">
      <h2 class="card-title text-2xl font-bold text-white">Daftar Buku</h2>
      <p class="text-gray-300">Lihat daftar buku yang tersedia di sini.</p>
      <div class="card-actions justify-center mt-4">
        <router-link to="/books" class="btn btn-primary">Lihat Buku</router-link>
      </div>
    </div>
  </div>
  <div class="card bg-gray-800 shadow-xl text-center w-full rounded-lg overflow-hidden">
  </div>
</main>
    </div>
  </div>
</template>

<script setup>
import { RouterLink } from "vue-router";
import NavBar from "../components/NavBar.vue";
import { useAuthStore } from "@/stores/AuthStore"; // Mengimpor authStore
import { computed } from "vue"; // Mengimpor computed

const authStore = useAuthStore(); // Menginisialisasi authStore

const listNav = [
  {
    name: "Home",
    path: "/",
  },
];

// Menggunakan computed untuk memfilter navigasi
const filteredNav = computed(() => {
  return authStore.tokenUser
    ? listNav // Menampilkan item navigasi jika terautentikasi
    : []; // Mengembalikan array kosong jika tidak terautentikasi
});
</script>