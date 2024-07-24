<template>
  <nav class="bg-gray-900 text-white p-4 flex flex-col lg:flex-row items-center lg:justify-between">
    <div class="block lg:hidden mb-4 lg:mb-0">
      <button @click="toggleDropdown" class="flex items-center space-x-2">
        <span>Menu</span>
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
      </button>
      <div v-if="isDropdownOpen" class="absolute left-0 mt-2 w-48 bg-gray-800 text-white rounded-lg shadow-lg lg:hidden">
        <router-link v-for="nav in navItems" :key="nav.id" :to="nav.url" class="block px-4 py-2 hover:bg-gray-700">
          {{ nav.name }}
        </router-link>
        <button @click="logout" class="block px-4 py-2 hover:bg-gray-700">Logout</button>
      </div>
    </div>

    <div class="hidden lg:flex lg:items-center lg:space-x-4 lg:mx-auto">
      <router-link v-for="nav in navItems" :key="nav.id" :to="nav.url" class="hover:text-gray-300">
        {{ nav.name }}
      </router-link>
      <button v-if="authStore.tokenUser" @click="handleLogout" class="hover:text-gray-300">Logout</button>
    </div>
  </nav>
</template>

<script setup>
import { ref } from 'vue';
import { useAuthStore } from '@/stores/AuthStore';

const authStore = useAuthStore();
const isDropdownOpen = ref(false);
const handleLogout = () => {
  authStore.logoutUser();
}

const navItems = [
  { id: 1, name: 'Home', url: '/' },
  { id: 2, name: 'Film', url: '/film' },
  { id: 3, name: 'Genre', url: '/genre' },
  { id: 4, name: 'Cast', url: '/cast' },
  { id: 5, name: 'Profile', url: '/profile' },
  { id: 6, name: 'Verifikasi Akun', url: '/verify' },
];

const toggleDropdown = () => {
  isDropdownOpen.value = !isDropdownOpen.value;
};

const logout = () => {
  authStore.logout();
};
</script>

<style scoped>
</style>
