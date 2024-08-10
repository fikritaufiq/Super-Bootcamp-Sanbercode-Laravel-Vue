<template>
  <div class="container mx-auto p-4">
    <h2 class="text-4xl font-bold mb-4 text-white">Daftar Kategori</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div
        v-for="item in kategori"
        :key="item.id"
        class="card bg-gray-800 text-white shadow-xl transition-transform transform hover:scale-105"
      >
        <div class="card-body">
          <h3 class="card-title text-2xl">{{ item.name }}</h3>
          <div class="card-actions justify-end">
            <RouterLink
              :to="{
                name: 'CategoryDetail',
                params: { id: item.id },
              }"
            >
              <button class="btn bg-blue-600 hover:bg-blue-700 text-white">Detail</button>
            </RouterLink>
            <RouterLink
              :to="{
                name: 'CategoryUpdate',
                params: { id: item.id },
              }"
              v-if="
                authStore.currentUser &&
                authStore.currentUser.role.name === 'owner'
              "
            >
              <button class="btn bg-green-600 hover:bg-green-700 text-white">Update</button>
            </RouterLink>

            <button
              v-if="
                authStore.currentUser &&
                authStore.currentUser.role.name === 'owner'
              "
              class="btn bg-red-600 hover:bg-red-700 text-white"
              @click="handleDelete(item.id)"
            >
              Delete
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";
import { onMounted } from "vue";
import { useAuthStore } from "@/stores/AuthStore";
import customApi from "@/api";

const authStore = useAuthStore();

const kategori = ref([]); // Ubah menjadi array

// fetch data kategori
const fetchCategories = async () => {
  const response = await customApi.get("/categories");
  console.log(response);
  kategori.value = response.data.data;
};

const handleDelete = async (id) => {
  await customApi.post(`/categories/${id}?_method=DELETE`, null, {
    headers: {
      Authorization: `Bearer ${authStore.tokenUser}`,
    },
  });
  alert("Kategori berhasil dihapus!");
  fetchCategories();
};

onMounted(() => {
  authStore.getMe();
  fetchCategories();
});
</script>

<style scoped>
.card {
  transition: transform 0.2s;
}
</style>