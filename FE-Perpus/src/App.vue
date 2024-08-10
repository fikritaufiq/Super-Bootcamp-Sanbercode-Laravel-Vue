<template>
  <transition name="fade">
    <div class="min-h-screen flex flex-col">
      <router-view />
    </div>
  </transition>
</template>

<style>
.fade-enter-active, .fade-leave-active {
  transition: opacity 0.5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active in <2.1.8 */ {
  opacity: 0;
}
</style>

<script setup>
import NavBar from "./components/NavBar.vue";


import { onMounted } from "vue";
import { useAuthStore } from "@/stores/AuthStore";

// ambil instance auth store
const authStore = useAuthStore();

// panggil fungsi get me
onMounted(() => {
  authStore.getMe();
});
</script>