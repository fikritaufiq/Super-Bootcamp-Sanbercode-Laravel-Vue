<template>
  <div class="min-h-screen bg-gray-900 text-white">
    <NavBar />
    <div class="container mx-auto p-4">
      <RouterLink to="/books/create">
        <button
          class="btn bg-blue-600 hover:bg-blue-700 text-white mb-4"
          v-if="authStore.tokenUser && authStore.currentUser.role.name === 'owner'"
        >
          Add Buku
        </button>
      </RouterLink>
      <h1 class="text-3xl font-bold mb-4">Daftar Buku</h1>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <DaftarBuku />
      </div>
    </div>
  </div>
</template>

<script setup>
import DaftarBuku from "@/components/DaftarBuku.vue";
import NavBar from "@/components/NavBar.vue";

import { useAuthStore } from "@/stores/AuthStore";
const authStore = useAuthStore();
</script>

<style scoped>
.btn {
  transition: background-color 0.3s, transform 0.2s;
}

.btn:hover {
  transform: scale(1.05);
}
</style>