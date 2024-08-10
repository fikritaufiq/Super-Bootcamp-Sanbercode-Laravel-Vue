<template>
  <NavBar />
  <div class="flex items-center justify-center min-h-screen bg-gray-800">
    <div class="w-full max-w-md p-8 space-y-6 bg-gray-900 shadow-md rounded-lg">
      <h2 class="text-2xl font-bold text-center text-white">Login</h2>
      <!-- error msg -->
      <div v-if="authStore.isError" role="alert" class="alert alert-error my-2">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-6 w-6 shrink-0 stroke-current"
          fill="none"
          viewBox="0 0 24 24"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"
          />
        </svg>
        <span class="text-white">Error! {{ authStore.errorMsg }}</span>
      </div>
      <form @submit.prevent="handleLogin">
        <div class="form-control">
          <label class="label">
            <span class="label-text text-white">Email</span>
          </label>
          <input
            type="email"
            placeholder="Masukan email anda"
            class="input input-bordered bg-gray-700 text-white"
            v-model="userInput.email"
            required
          />
        </div>
        <div class="form-control mt-4">
          <label class="label">
            <span class="label-text text-white">Password</span>
          </label>
          <input
            type="password"
            placeholder="Masukan password anda"
            class="input input-bordered bg-gray-700 text-white"
            v-model="userInput.password"
            required
          />
        </div>
        <div class="mt-6">
          <button class="btn btn-primary w-full">Login</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>

import NavBar from "@/components/NavBar.vue"; // Pastikan jalur ini benar
import { useAuthStore } from "@/stores/AuthStore";
import { ref, reactive } from "vue";

const authStore = useAuthStore();

const userInput = reactive({
  email: "",
  password: "",
});

const { loginUser } = authStore;
const handleLogin = () => {
  loginUser(userInput);
};
</script>