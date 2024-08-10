<template>
  <div class="navbar bg-base-100 shadow-lg font-sans">
    <div class="navbar-start">
      <router-link to="/">
        <a class="btn btn-ghost normal-case text-xl">Perpustakaan</a>
      </router-link>
    </div>
    <div class="navbar-center hidden lg:flex">
      <ul class="menu menu-horizontal px-1">
        <li>
          <router-link to="/books">Books</router-link>
        </li>
        <li>
          <router-link to="/borrowbook">Borrow</router-link>
        </li>
        <li>
          <router-link to="/category">Category</router-link>
        </li>
        <li v-if="authStore.tokenUser">
          <router-link to="/profile">Profile</router-link>
        </li>
        <li v-if="authStore.currentUser && authStore.currentUser.role && authStore.currentUser.role.name === 'owner'">
          <router-link to="/rolecreate">Roles</router-link>
        </li>
      </ul>
    </div>
    <div class="navbar-end">
      <router-link to="/login" class="btn btn-ghost" v-if="!authStore.tokenUser">Login</router-link>
      <router-link to="/register" class="btn btn-ghost" v-if="!authStore.tokenUser">Register</router-link>
      <a @click="handleLogout" class="btn bg-blue-500 text-white" v-if="authStore.tokenUser">Logout</a>
    </div>
  </div>
</template>

<script setup>
import { useRouter } from "vue-router";
import { defineProps } from "vue";
import { RouterLink } from "vue-router";
import { useAuthStore } from "@/stores/AuthStore";

const authStore = useAuthStore();
const router = useRouter();

const handleLogout = () => {
  authStore.logoutUser();
  router.push("/");
};
</script>

<style scoped>
.navbar {
  transition: background-color 0.3s;
}
.font-sans {
  font-family: 'Arial', sans-serif;
}
</style>