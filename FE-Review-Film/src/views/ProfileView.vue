<template>
  <div class="profile-container">
    <h1 class="text-2xl font-bold mb-4">Update Profile</h1>
    <div v-if="authStore.isError" role="alert" class="alert alert-error bg-red-500 text-white p-2 rounded-md mb-4"> 
      <span>{{ authStore.errorMsg }}</span>
    </div>
    <form @submit.prevent="updateUser" class="space-y-4">
      <div>
        <label for="name" class="block text-sm font-medium text-white">Name</label>
        <input
          id="name"
          v-model="userInput.name"
          type="text"
          placeholder="Enter your name"
          class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm text-black"
          autocomplete="name"
        />
      </div>
      <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600">Update</button>
    </form>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useAuthStore } from '@/stores/AuthStore';

const authStore = useAuthStore();
const userInput = ref({
  name: authStore.currentUser.name || ''
});

const updateUser = async () => {
  try {
    await authStore.updateUser({
      name: userInput.value.name
    });
    console.log('User updated successfully');
  } catch (error) {
    console.log('Update error:', error);
  }
};
</script>

<style scoped>
.profile-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 2rem;
  background-color: #010814; 
}

input {
  border: 1px solid #000000; 
  border-radius: 0.375rem;
  padding: 0.5rem 0.75rem;
  box-shadow: none;
  outline: none;
  transition: border-color 0.2s ease-in-out;
}

input::placeholder {
  color: #9ca3af; /* Lighter placeholder text for contrast */
}

input:focus {
  border-color: #3b82f6;
  box-shadow: 0 0 0 1px #3b82f6;
}

button {
  background-color: #3b82f6;
  color: white;
  padding: 0.5rem 1rem;
  border-radius: 0.375rem;
  border: none;
  cursor: pointer;
  transition: background-color 0.2s ease-in-out;
}

button:hover {
  background-color: #2563eb;
}
</style>
