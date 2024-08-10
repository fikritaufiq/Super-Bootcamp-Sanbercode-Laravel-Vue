<template>
  <Navbar />
  <div class="flex items-center justify-center min-h-screen bg-gray-800">
    <div class="w-full max-w-md p-8 space-y-6 bg-white shadow-md rounded-lg">
      <h2 class="text-2xl font-bold text-center">Register</h2>
      <form @submit.prevent="handleRegister">
        <div class="form-control">
          <label class="label">
            <span class="label-text">Nama</span>
          </label>
          <input
            type="text"
            placeholder="Nama"
            class="input input-bordered bg-gray-900 text-white"
            required
            v-model="name"
          />
        </div>
        <div class="form-control mt-4">
          <label class="label">
            <span class="label-text">Email</span>
          </label>
          <input
            type="email"
            placeholder="Email"
            class="input input-bordered bg-gray-900 text-white"
            required
            v-model="email"
          />
        </div>
        <div class="form-control mt-4">
          <label class="label">
            <span class="label-text">Password</span>
          </label>
          <input
            type="password"
            placeholder="Password"
            class="input input-bordered bg-gray-900 text-white"
            required
            v-model="password"
          />
        </div>
        <div class="form-control mt-4">
          <label class="label">
            <span class="label-text">Confirm Password</span>
          </label>
          <input
            type="password"
            placeholder="Password Confirmation"
            class="input input-bordered bg-gray-900 text-white"
            required
            v-model="password_confirmation"
          />
        </div>
        <div class="text-center">
          <p v-if="error" class="text-red-500">{{ error }}</p>
        </div>
        <div class="mt-6">
          <button type="submit" class="btn btn-primary w-full">Register</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";
import { useAuthStore } from "@/stores/AuthStore";
import Navbar from "@/components/NavBar.vue";

const authStore = useAuthStore();

const name = ref("");
const email = ref("");
const password = ref("");
const password_confirmation = ref("");
const error = ref(""); // Added error variable

const handleRegister = async () => {
  if (password.value !== password_confirmation.value) {
    error.value = "Password and password confirmation do not match.";
    return;
  }
  
  try {
    await authStore.registerUser({
      name: name.value,
      email: email.value,
      password: password.value,
      password_confirmation: password_confirmation.value,
    });
  } catch (err) {
    error.value = err.message || "An error occurred during registration.";
  }
};

</script>