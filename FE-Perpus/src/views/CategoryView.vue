<template>
  <div class="min-h-screen">
    <NavBar />
    <div class="container mx-auto p-4">
      <RouterLink
        to="/category/create"
        v-if="
          authStore.currentUser && authStore.currentUser.role.name === 'owner'
        "
      >
        <button class="btn btn-primary">Tambah Kategori</button>
      </RouterLink>
    </div>
    <Category />
  </div>
</template>

<script setup>
import Category from "@/components/Category.vue";
import NavBar from "@/components/NavBar.vue";

import { useAuthStore } from "@/stores/AuthStore";

const authStore = useAuthStore();
</script>
