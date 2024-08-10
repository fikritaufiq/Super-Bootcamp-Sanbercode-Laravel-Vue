<template>
  <NavBar />
  <div class="container mx-auto p-4 bg-slate-100">
    <h1 class="text-2xl font-bold mb-4">{{ props.title }} Buku</h1>
    <form
      @submit.prevent="createBook"
      class="bg-slate-50 p-6 rounded-lg shadow-md max-w-lg mx-auto"
    >
      <div class="mb-4">
        <label class="block text-gray-700">Title</label>
        <input
          type="text"
          v-model="formData.title"
          class="input input-bordered w-full"
          required
        />
      </div>
      <div class="mb-4">
        <label class="block text-gray-700">Summary</label>
        <textarea
          v-model="formData.summary"
          class="textarea textarea-bordered w-full"
          required
        ></textarea>
      </div>
      <div class="mb-4">
        <label class="block text-gray-700">Image</label>
        <input
          type="file"
          @change="handleFileUpload"
          class="input input-bordered w-full"
          required
        />
      </div>
      <div class="mb-4">
        <label class="block text-gray-700">Stok</label>
        <input
          type="number"
          v-model="formData.stok"
          class="input input-bordered w-full"
          required
        />
      </div>
      <div class="mb-4">
        <label class="block text-gray-700">Category</label>
        <select
          v-model="formData.category_id"
          class="select select-bordered w-full"
          required
        >
          <option :value="category.id" v-for="category in categories">
            {{ category.name }}
          </option>
        </select>
      </div>
      <div class="flex justify-end">
        <button type="submit" class="btn btn-primary">Tambah Buku</button>
      </div>
    </form>
  </div>
</template>
<script setup>
import NavBar from "@/components/NavBar.vue";
import { ref, onMounted } from "vue";
import customApi from "@/api";
import { useAuthStore } from "@/stores/AuthStore";
import { useRouter, useRoute } from "vue-router";

const router = useRouter();
const route = useRoute();

const authStore = useAuthStore();

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

const formData = ref({
  title: "",
  summary: "",
  image: null,
  stok: "",
  category_id: "",
});

const categories = ref([]);

const fetchCategories = async () => {
  try {
    const response = await customApi.get("/categories");
    categories.value = response.data.data;
    const categoryName = categories.value.map((category) => category.name);
    console.log(categoryName);
  } catch (error) {
    console.error("Failed to fetch categories:", error);
  }
};

const getDataBook = async () => {
  const { data } = await customApi.get(`/books/${route.params.id}`);
  formData.value = data.data;
  console.log(formData.value);
};

onMounted(() => {
  fetchCategories();
  if (props.isUpdate) {
    getDataBook();
  }
});
const handleFileUpload = (event) => {
  formData.value.image = event.target.files[0];
};

const createBook = async () => {
  const bookData = new FormData();
  bookData.append("title", formData.value.title);
  bookData.append("summary", formData.value.summary);
  bookData.append("image", formData.value.image);
  bookData.append("stok", formData.value.stok);
  bookData.append("category_id", formData.value.category_id);

  if (!props.isUpdate) {
    try {
      await customApi.post("/books", bookData, {
        headers: {
          Authorization: `Bearer ${authStore.tokenUser}`,
        },
      });
      alert("Buku berhasil ditambahkan!");
      router.push("/books");
    } catch (error) {
      console.error("Failed to create book:", error);
      alert("Gagal menambahkan buku.");
    }
  } else {
    try {
      await customApi.post(`/books/${route.params.id}?_method=PUT`, bookData, {
        headers: {
          Authorization: `Bearer ${authStore.tokenUser}`,
        },
      });
      alert("Buku berhasil diupdate!");
      router.push("/books");
    } catch (error) {
      console.error("Failed to update book:", error);
      alert("Gagal mengupdate buku.");
    }
  }
};
</script>

<style scoped>
body {
  background-color: #1a1a1a;
}
</style>
