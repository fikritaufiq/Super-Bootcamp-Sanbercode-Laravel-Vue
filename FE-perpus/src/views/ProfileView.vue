<template>
  <div class="container mt-4">
    <h1 class="text-center">Profil Pengguna</h1>

    <div v-if="profileStore.message" class="alert alert-success">{{ profileStore.message }}</div>
    <div v-if="profileStore.errorMessage" class="alert alert-danger">{{ profileStore.errorMessage }}</div>

    <div v-if="profileStore.profile" class="profile-info">
      <h2 class="text-black">Informasi Profil:</h2>
      <p class="text-black"><strong>Bio:</strong> {{ profileStore.profile.bio }}</p>
      <p class="text-black"><strong>Usia:</strong> {{ profileStore.profile.age }}</p>
    </div>

    <form @submit.prevent="submitProfile">
      <div class="mb-3">
        <label for="bio" class="form-label">Bio</label>
        <textarea v-model="bio" id="bio" class="form-control input-black" required></textarea>
      </div>
      <div class="mb-3">
        <label for="age" class="form-label">Usia</label>
        <input v-model="age" type="number" id="age" class="form-control input-black" required />
      </div>
      <button type="submit" class="btn btn-primary">Simpan Profil</button>
    </form>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useProfileStore } from '@/stores/ProfileStore';

const profileStore = useProfileStore();
const bio = ref('');
const age = ref('');


const fetchProfile = async () => {
  await profileStore.fetchProfile();
  if (profileStore.profile) {
    bio.value = profileStore.profile.bio;
    age.value = profileStore.profile.age;
  }
};

const submitProfile = async () => {

  console.log("Mengirim data:", { bio: bio.value, age: age.value });

  try {
    await profileStore.updateProfile(bio.value, age.value);
    bio.value = '';
    age.value = '';
  } catch (error) {
    console.error("Kesalahan saat memperbarui profil:", error);
  }
};


onMounted(() => {
  fetchProfile();
});
</script>

<style scoped>
.alert {
  margin-bottom: 10px;
}
.profile-info {
  margin-bottom: 20px;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  background-color: #f9f9f9;
}
.text-black {
  color: black; 
}
.input-black {
  color: black; 
  background-color: white; 
  border: 1px solid #ccc; 
  padding: 8px;
  border-radius: 4px;
}
</style>