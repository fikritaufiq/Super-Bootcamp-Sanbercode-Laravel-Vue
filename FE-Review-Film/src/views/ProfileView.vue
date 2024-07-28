<template>
  <div>
    <h1>Profile</h1>
    <p>Name: {{ authStore.currentUser?.name || 'Nama tidak tersedia' }}</p>
    <p>Email: {{ authStore.currentUser?.email || 'Email tidak tersedia' }}</p>

    <br>
    <br>
    <h2>Update Profile</h2>
    <form @submit.prevent="updateUserProfile">
      <div>
        <label for="name">Name:</label>
        <input type="text" v-model="name" id="name" required class="input-field" />
      </div>
      <button type="submit" class="bg-blue-500 text-white py-1 px-3 rounded-md hover:bg-blue-600">
        Update
      </button>
    </form>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useAuthStore } from '@/stores/AuthStore';

const authStore = useAuthStore();
const name = ref(authStore.currentUser?.name || '');
const email = ref(authStore.currentUser?.email || '');

onMounted(async () => {
  await authStore.getCurrentUser(); // Ambil data pengguna saat komponen di-mount
});

// Fungsi untuk memperbarui profil pengguna
const updateUserProfile = async () => {
  const userData = {
    name: name.value,
    email: email.value,
  };
  await authStore.updateUser(userData); // Panggil metode updateUser dari store
};
</script>

<style scoped>
.input-field {
  color: black; /* Mengubah warna teks input menjadi hitam */
}
</style>