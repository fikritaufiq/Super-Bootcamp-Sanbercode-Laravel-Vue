<template>
  <NavBar />
  <div class="flex items-center justify-center min-h-screen bg-gray-800">
    <div class="w-full max-w-md p-8 space-y-6 bg-gray-700 shadow-md rounded-lg">
      <h2 class="text-2xl font-bold text-center text-white">Tambah Role</h2>
      <!-- error msg -->

      <form @submit.prevent="handleInput">
        <div class="form-control">
          <label class="label">
            <!-- <span class="label-text">Nama Role</span> -->
          </label>
          <input
            type="text"
            placeholder="Masukan nama Role"
            class="input input-bordered text-center bg-gray-600 text-white"
            required
            v-model="roleName"
          />
        </div>

        <div class="mt-6">
          <button class="btn btn-primary w-full">Tambah</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import NavBar from "../components/NavBar.vue";

import { useAuthStore } from "@/stores/AuthStore";
import { ref, reactive } from "vue";
import customApi from "@/api";

const authStore = useAuthStore();

const roleName = ref("");
const handleInput = async () => {
  try {
    const res = await customApi.post(
      "/roles",
      {
        name: roleName.value,
      },
      {
        headers: {
          Authorization: `Bearer ${authStore.tokenUser}`,
        },
      }
    );

    roleName.value = res.data.data.name;
    console.log(res);
    alert("Role Created");
  } catch (error) {
    console.log(error);
    console.log(error.response.data.message);
  }
};

</script>