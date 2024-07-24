<template>
  <div class="auth-container">
    <div class="auth-card">
      <h1 class="text-2xl font-bold mb-4">{{ title }}</h1>
      <div v-if="authStore.isError" role="alert" class="alert alert-error bg-red-500 text-white p-2 rounded-md mb-4"> 
      <span>{{authStore.errorMsg}}</span>
      </div>
      <form @submit.prevent="handleAuth" class="space-y-4">
        <div v-if="showUsername">
          <label for="username" class="block text-sm font-medium text-white">Username</label>
          <input
            id="username"
            v-model="userInput.username"
            type="text"
            placeholder="Enter your username"
            class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm text-black"
            autocomplete="username"
          />
        </div>
        <div>
          <label for="email" class="block text-sm font-medium text-white">Email</label>
          <input
            id="email"
            v-model="userInput.email"
            type="email"
            placeholder="Enter your email"
            class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm text-black"
            autocomplete="email"
          />
        </div>
        <div>
          <label for="password" class="block text-sm font-medium text-white">Password</label>
          <input
            id="password"
            v-model="userInput.password"
            type="password"
            placeholder="Enter your password"
            class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm text-black"
            autocomplete="current-password"
          />
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600">{{ buttonText }}</button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { reactive } from 'vue';
import { useAuthStore } from '@/stores/AuthStore';

const authStore = useAuthStore();

const userInput = reactive({
  username: '',
  email: '',
  password: ''
});

const { loginUser } = authStore;

const handleAuth = () => {
  loginUser(userInput);
};


const props = defineProps({
  title: {
    type: String,
    default: 'Authentication'
  },
  buttonText: {
    type: String,
    default: 'Submit'
  },
  handleSubmit: {
    type: Function,
    default: () => {}
  },
  showUsername: {
    type: Boolean,
    default: false
  }
});
</script>

<style scoped>
.auth-container {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  background-color: #010814; 
}

.auth-card {
  background-color: #1f2937; 
  padding: 2rem;
  border-radius: 8px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  max-width: 400px;
  width: 100%;
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
  color: #9ca3af; 
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
