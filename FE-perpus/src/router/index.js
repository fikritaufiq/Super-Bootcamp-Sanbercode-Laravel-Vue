import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import LoginView from '../views/Auth/LoginView.vue'
import RegisterView from '../views/Auth/RegisterView.vue'
import AuthLayout from '../layouts/AuthLayout.vue'
import PublicLayout from '../layouts/PublicLayout.vue'
import { useAuthStore } from '../stores/AuthStore'
import CategoryView from '../views/CategoryView.vue'
import BookView from '../views/BookView.vue'
import BorrowView from '../views/BorrowView.vue' 
import ProfileView from '../views/ProfileView.vue' 

const routes = [
    {
        path: '/',
        component: PublicLayout,
        children: [
            { path: '', component: HomeView }, 
            { path: 'categories', component: CategoryView }, 
            { path: 'books', component: BookView }, 
            { path: 'borrows', component: BorrowView },
            { path: 'profile', component: ProfileView }, 
        ],
    },
    {
      path: '/',
      component: AuthLayout,
      children: [
        { path: '/login', name: 'login', component: LoginView,
          meta: { isAuthTrue: true } },
        { path: '/register', name: 'register', component: RegisterView,
          meta: { isAuthTrue: true }},
        ]
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

router.beforeEach((to, from, next) => {
    const authStore = useAuthStore()
    if (to.meta.requiresAuth && !authStore.isAuthenticated) {
        next({ name: 'login' })
    } else {
        next()
    }
})

export default router