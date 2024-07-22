import { createRouter, createWebHistory } from 'vue-router';
import HomeView from '../views/HomeView.vue';
import LoginView from '../views/Auth/LoginView.vue';
import RegisterView from '../views/Auth/RegisterView.vue';
import VerifyView from '../views/Auth/VerifyView.vue';
import FilmView from '../views/FilmView.vue';
import GenreView from '../views/GenreView.vue';
import CastView from '../views/CastView.vue';

const routes = [
  { path: '/', component: HomeView },
  { path: '/login', component: LoginView },
  { path: '/register', component: RegisterView },
  { path: '/verify', component: VerifyView },
  { path: '/film', component: FilmView },
  { path: '/genre', component: GenreView },
  { path: '/cast', component: CastView },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
