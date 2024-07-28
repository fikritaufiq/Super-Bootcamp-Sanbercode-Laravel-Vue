<template>
  <div>
    <h1>Profile</h1>
    <p>Name: {{ authStore.currentUser?.name || 'Nama tidak tersedia' }}</p>

    <br>
    <br>
    <h2>Update Profile</h2>
    <form @submit.prevent="updateUserProfile">
      <div>
        <label for="name">Name:</label>
        <input type="text" v-model="userName" id="name" required class="input-field" />
      </div>
      <div>
        <label for="email">Email:</label>
        <input type="email" v-model="userEmail" id="email" required class="input-field" />
      </div>
      <button type="submit" class="bg-blue-500 text-white py-1 px-3 rounded-md hover:bg-blue-600">
        Update
      </button>
    </form>
    <div v-if="error">{{ error }}</div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useAuthStore } from '@/stores/AuthStore';

const authStore = useAuthStore();
const userName = ref(authStore.currentUser?.name || '');
const userEmail = ref(authStore.currentUser?.email || '');
const error = ref('');

onMounted(async () => {
  await authStore.getCurrentUser(); // Ambil data pengguna saat komponen di-mount
});

// Fungsi untuk memperbarui profil pengguna
const updateUserProfile = async () => {
  try {
    const userData = {
      name: userName.value,
      email: userEmail.value,
    };
    await authStore.updateUser(userData); // Panggil metode updateUser dari store
    alert("Profil berhasil diperbarui!"); // Beri tahu pengguna
  } catch (err) {
    console.error("Gagal memperbarui profil:", err);
    error.value = "Gagal memperbarui profil. Silakan coba lagi.";
  }
};
</script>

<style scoped>
.input-field {
  color: black; /* Mengubah warna teks input menjadi hitam */
}
</style>