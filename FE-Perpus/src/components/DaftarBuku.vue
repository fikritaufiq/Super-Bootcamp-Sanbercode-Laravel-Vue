<template>
  <div class="mx-auto p-4">
    <div class="lg:flex gap-4 mt-4"></div>

    <div class="overflow-x-auto">
      <table class="table">
        <!-- head -->
        <thead>
          <tr>
            <th>Judul Buku</th>
            <th>Summary</th>
            <th>Stok</th>
            <th>Kategori</th>
            <th
              v-if="
                authStore.tokenUser &&
                authStore.currentUser.role.name === 'owner'
              "
            >
              Action
            </th>
          </tr>
        </thead>
        <tbody>
          <!-- row 1 -->
          <tr v-for="item in books" :key="item.id">
            <td>
              <div class="flex items-center gap-3">
                <div class="avatar">
                  <div class="mask mask-squircle h-12 w-12">
                    <img :src="item.image" alt="Cover Buku" />
                  </div>
                </div>
                <div>
                  <div class="font-bold">{{ item.title }}</div>
                  <div class="text-sm opacity-50">
                    <button @click="handleDetail(item.id)">Detail Buku</button>
                  </div>
                </div>
              </div>
            </td>
            <td>
              {{ item.summary }}
              <br />
              <!-- <span class="badge badge-ghost badge-sm"
                    >Desktop Support Technician</span
                  > -->
            </td>
            <td>{{ item.stok }}</td>
            <td>{{ item.category.name }}</td>

            <td
              v-if="
                authStore.tokenUser &&
                authStore.currentUser.role.name === 'owner'
              "
              class="flex gap-2"
            >
              <RouterLink
                :to="{
                  name: 'UpdateBook',
                  params: { id: item.id },
                }"
              >
                <button class="btn btn-primary">Update</button>
              </RouterLink>

              <button @click="handleDelete(item.id)" class="btn btn-error">
                Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
<script setup>
import { ref, onMounted } from "vue";
import { useAuthStore } from "@/stores/AuthStore";
import customApi from "@/api";
import { RouterLink } from "vue-router";

const authStore = useAuthStore();
const books = ref("");

const fetchBooks = async () => {
  const response = await customApi.get("/books");
  console.log(response);

  books.value = response.data.data;
};

const handleDelete = async (id) => {
  await customApi.post(`/books/${id}?_method=DELETE`, null, {
    headers: {
      Authorization: `Bearer ${authStore.tokenUser}`,
    },
  });

  alert("Buku berhasil dihapus");
  fetchBooks();
};

onMounted(() => {
  fetchBooks();
  authStore.getMe();
});
</script>
