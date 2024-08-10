<template>
  <div class="flex flex-col min-h-screen bg-gray-900">
    <NavBar />

    <!-- Main Content -->
    <main class="flex-1 container mx-auto p-8">
      <div class="bg-gray-800 p-10 rounded-lg shadow-xl max-w-lg mx-auto">
        <div class="text-center">
     
          <h2 class="text-5xl font-extrabold text-blue-400 mb-3">
            {{ authStore.currentUser.name }}
          </h2>
          <p class="text-gray-300 text-lg">{{ authStore.currentUser.email }}</p>
          <p class="text-gray-300 text-lg">Age: {{ formData.age }}</p>
          <p class="text-gray-300 mt-5 italic">{{ formData.bio }}</p>
          <button @click="editProfile" class="btn btn-primary mt-5">
            Edit Profile
          </button>
        </div>
      </div>

      <!-- Edit Profile Form -->
      <div
        v-if="showEditForm"
        class="bg-gray-800 p-10 rounded-lg shadow-xl max-w-lg mx-auto mt-8"
      >
        <h2 class="text-4xl font-bold text-blue-400 mb-5">Edit Profile</h2>
        <form @submit.prevent="updateProfile">
          <div class="mb-5">
            <label class="block text-gray-300">Age</label>
            <input
              type="number"
              v-model="formData.age"
              class="input input-bordered w-full bg-gray-700 text-white"
            />
          </div>
          <div class="mb-5">
            <label class="block text-gray-300">Bio</label>
            <textarea
              v-model="formData.bio"
              class="textarea textarea-bordered w-full bg-gray-700 text-white"
            ></textarea>
          </div>
          <div class="flex justify-end">
            <button
              type="button"
              @click="cancelEdit"
              class="btn btn-danger mr-3"
            >
              Cancel
            </button>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </form>
      </div>
    </main>
  </div>
</template>

<script setup>
import { ref } from "vue";
import NavBar from "../components/NavBar.vue";
import { useAuthStore } from "@/stores/AuthStore";
import customApi from "@/api";

const authStore = useAuthStore();

const showEditForm = ref(false);

const formData = ref({
  age: "",
  bio: "",
});

function editProfile() {
  showEditForm.value = true;
}

function cancelEdit() {
  showEditForm.value = false;
}

const updateProfile = async () => {
  try {
    const response = await customApi.post("/profile", formData.value, {
      headers: { Authorization: `Bearer ${authStore.tokenUser}` },
    });
    console.log(response);
    // Simpan perubahan profil di sini
    showEditForm.value = false;
    alert("Profile updated successfully!");
  } catch (error) {
    console.error("Failed to update profile:", error);
  }
};
</script>

<style scoped>
/* Tambahkan gaya kustom sesuai kebutuhan */
</style>