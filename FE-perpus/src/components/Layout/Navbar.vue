<template>
  <nav class="bg-gray-900 text-white p-4 flex flex-col lg:flex-row items-center lg:justify-between">
    <!-- Dropdown untuk versi mobile -->
    <div class="block lg:hidden mb-4 lg:mb-0 w-full">
      <button @click="toggleDropdown" class="btn btn-ghost flex items-center space-x-2 justify-start">
        <span>Menu</span>
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
      </button>
      <transition name="fade">
        <div v-if="isDropdownOpen" class="absolute left-0 mt-2 w-48 bg-gray-800 text-white rounded-lg shadow-lg lg:hidden">
          <router-link v-for="nav in navItems" :key="nav.id" :to="nav.url" class="block px-4 py-2 hover:bg-gray-700">
            {{ nav.name }}
          </router-link>
          <button v-if="authStore.isAuthenticated" @click="handleLogout" class="block px-4 py-2 hover:bg-gray-700">Logout</button>
        </div>
      </transition>
    </div>

    <!-- Menu horizontal untuk versi desktop -->
    <div class="hidden lg:flex lg:items-center lg:space-x-4 lg:mx-auto">
      <div>
        <router-link v-for="nav in navItems" :key="nav.id" :to="nav.url" class="btn btn-ghost hover:text-gray-300 mx-4">
          {{ nav.name }}
        </router-link>
      </div>
    </div>
    
    <div class="flex items-center space-x-4">
      <router-link v-if="authStore.isAuthenticated" to="/profile" class="btn btn-ghost hover:text-gray-300">Profile</router-link>
      <button v-if="authStore.isAuthenticated" @click="handleLogout" class="btn btn-ghost hover:text-gray-300">Logout</button>
      <router-link v-if="!authStore.isAuthenticated" to="/login" class="btn btn-ghost hover:text-gray-300">Login</router-link>
      <router-link v-if="!authStore.isAuthenticated" to="/register" class="btn btn-ghost hover:text-gray-300">Register</router-link>
    </div>
  </nav>
</template>

<script setup>
import { ref } from 'vue';
import { useAuthStore } from '@/stores/AuthStore';
import { useRouter } from 'vue-router';

const authStore = useAuthStore();
const router = useRouter();
const isDropdownOpen = ref(false);
const navItems = [
  { id: 1, name: 'Home', url: '/' },
  { id: 2, name: 'Books', url: '/books' },
  { id: 3, name: 'Categories', url: '/categories' },
  { id: 4, name: 'Borrows', url: '/borrows' }, 
];

const toggleDropdown = () => {
  isDropdownOpen.value = !isDropdownOpen.value;
};

const handleLogout = () => {
  authStore.logout();
  router.push('/login');
};
</script>

<style scoped>
.fade-enter-active, .fade-leave-active {
  transition: opacity 0.3s ease; 
}
.fade-enter, .fade-leave-to {
  opacity: 0;
}
</style>