<template>
    <div class="auth-container">
      <div class="auth-card">
        <h1 class="text-2xl font-bold mb-4">Login</h1>
        <form @submit.prevent="login" class="space-y-4">
          <div>
            <label for="email" class="block text-sm font-medium">Email</label>
            <input
              id="email"
              v-model="email"
              type="email"
              placeholder="Masukkan email Anda"
              class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm"
              required
            />
          </div>
          <div>
            <label for="password" class="block text-sm font-medium">Password</label>
            <input
              id="password"
              v-model="password"
              type="password"
              placeholder="Masukkan password Anda"
              class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm"
              required
            />
          </div>
          <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600">Login</button>
        </form>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  
  const email = ref('');
  const password = ref('');
  
  function login() {
    console.log('Logging in with:', email.value, password.value);
  }
  </script>
  
  <style scoped>
  .auth-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-color: #f3f4f6;
    padding: 1rem;
  }
  
  .auth-card {
    background-color: #ffffff;
    padding: 2rem;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    max-width: 400px;
    width: 100%;
  }
  
  input::placeholder {
    color: #9ca3af;
    opacity: 1;
    font-style: italic;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
  }
  
  input {
    border: 1px solid #d1d5db;
    border-radius: 0.375rem;
    padding: 0.5rem 0.75rem;
    box-shadow: none;
    outline: none;
    transition: border-color 0.2s ease-in-out;
  }
  
  input:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 1px #3b82f6;
  }
  </style>
  