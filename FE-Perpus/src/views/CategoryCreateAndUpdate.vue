<template>
  <NavBar />
  <div class="container mx-auto p-4 min-h-screen">
    <div class="flex flex-col items-center justify-center bg-base-200 p-4">
      <div
        class="flex flex-col items-center justify-center bg-base-300 p-4 rounded-lg shadow-md w-full max-w-md"
      >
        <h1 class="text-2xl font-bold mb-4">{{ props.title }} Kategori</h1>
        <form @submit.prevent="handleSubmit()" class="flex flex-col gap-2">
          <input
            type="text"
            placeholder="Masukan nama kategori"
            class="input input-bordered w-full max-w-xs text-center mb-4"
            v-model="kategoriName"
          />

          <input type="submit" :value="props.name" class="btn btn-primary" />
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import NavBar from "@/components/NavBar.vue";

import { ref, onMounted } from "vue";
import customApi from "@/api";
import { useAuthStore } from "@/stores/AuthStore";
import { useRouter, useRoute } from "vue-router";

const authStore = useAuthStore();
const router = useRouter();
const route = useRoute();

const props = defineProps({
  title: {
    type: String,
    required: true,
  },
  isUpdate: {
    type: Boolean,
    default: false,
  },
});
const kategoriName = ref("");

const getCategoryDetail = async () => {
  const { data } = await customApi.get(`/categories/${route.params.id}`);
  kategoriName.value = data.data.name;
  console.log(data.data);
};

const handleSubmit = async () => {
  if (!props.isUpdate) {
    await customApi.post(
      "/categories",
      {
        name: kategoriName.value,
      },
      {
        headers: {
          Authorization: `Bearer ${authStore.tokenUser}`,
        },
      }
    );
    router.push("/category");
  } else {
    await customApi.post(
      `/categories/${route.params.id}?_method=PUT`,
      {
        name: kategoriName.value,
      },
      {
        headers: {
          Authorization: `Bearer ${authStore.tokenUser}`,
        },
      }
    );
  }
  router.push("/category");
};

onMounted(() => {
  if (props.isUpdate) {
    getCategoryDetail();
  }
});
</script>
