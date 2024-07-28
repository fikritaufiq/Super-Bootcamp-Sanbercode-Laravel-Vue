import { createRouter, createWebHistory } from 'vue-router';
import HomeView from '../views/HomeView.vue';
import LoginView from '../views/Auth/LoginView.vue';
import RegisterView from '../views/Auth/RegisterView.vue';
import VerifyView from '../views/Auth/VerifyView.vue';
import MovieView from '../views/MovieView.vue';
import GenreView from '../views/GenreView.vue';
import CastView from '../views/CastView.vue';
import ProfileView from '../views/ProfileView.vue';
import PublicLayout from '../layouts/PublicLayout.vue';
import AuthLayout from '../layouts/AuthLayout.vue';
import { useAuthStore } from '@/stores/AuthStore';

const routes = [
  {
    path: '/',
    component: PublicLayout,
    children: [
      { path: '', name: 'home', component: HomeView }, // Changed name to 'Home'
      { path: 'movie', name: 'movie', component: MovieView },
      { path: 'genre', name: 'genre', component: GenreView },
      { path: 'cast', name: 'cast', component: CastView },
      { path: 'profile', name: 'profile', component: ProfileView,
        meta: { isVerified: true }
      },
    ]
  },
  {
    path: '/',
    component: AuthLayout,
    children: [
      { path: 'login', name: 'login', component: LoginView,
        meta: { isAuthTrue: true } },
      { path: 'register', name: 'register', component: RegisterView,
        meta: { isAuthTrue: true }},
      { path: 'verify', name: 'verify', component: VerifyView },
    ]
  },
];

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes
});

router.beforeEach(async (to, from) => {
  const authStore = await useAuthStore();
  
  // Cek jika pengguna sudah login dan mencoba mengakses halaman login atau register
  if (to.meta.isAuthTrue && authStore.tokenUser) {
    alert("Harus Logout terlebih dahulu");
    return { path: "/" };
  }

  // Cek jika halaman memerlukan verifikasi dan pengguna belum terverifikasi
  console.log("Email Verified At:", authStore.currentUser?.email_verified_at); // Debugging
  console.log("Is Verified:", authStore.isVerified); // Debugging
  if (to.meta.isVerified && !authStore.currentUser?.email_verified_at) {
    alert("Anda belum terverifikasi");
    return { path: "/" };
  }

  // Cek jika pengguna belum login
  if (to.meta.isAuth && !authStore.tokenUser) {
    alert("Anda belum Login");
    return { path: "/" };
  }
});

export default router;