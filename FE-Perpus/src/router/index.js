import { createRouter, createWebHistory } from "vue-router";
import LoginView from "@/views/Auth/LoginView.vue";
import RegisterView from "@/views/Auth/RegisterView.vue";
import BookView from "@/views/BookView.vue";
import BorrowBookView from "@/views/BorrowBookView.vue";
import HomeView from "@/views/HomeView.vue";
import CategoryView from "@/views/CategoryView.vue";
import CategoryCreateView from "@/views/CategoryCreateView.vue";
import CategoryDetailView from "@/views/CategoryDetailView.vue";
import CategoryUpdateView from "@/views/CategoryUpdateView.vue";
import ProfileView from "@/views/ProfileView.vue";
import RoleCreateView from "@/views/RoleCreateView.vue";
import BookCreateView from "@/views/BookCreateView.vue";
import BookUpdateView from "@/views/BookUpdateView.vue";
import BorrowView from "@/views/BorrowView.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "Home",
      component: HomeView,
    },
    { 
      path: "/register", 
      name: "Register", 
      component: RegisterView 
    },
    { 
      path: "/login", 
      name: "Login", 
      component: LoginView 
    },
    {
      path: "/category",
      name: "Category",
      component: CategoryView,
    },
    {
      path: "/category/create",
      name: "CategoryCreate",
      component: CategoryCreateView,
    },
    {
      path: "/category/:id",
      name: "CategoryDetail",
      component: CategoryDetailView,
    },
    {
      path: "/category/:id/update",
      name: "CategoryUpdate",
      component: CategoryUpdateView,
    },
    { path: "/books",
      name: "BookList", 
      component: BookView 
    },
    { 
      path: "/borrowbook", 
      name: "BorrowBook", 
      component: BorrowBookView 
    },
    {
      path: "/Borrowlist",
      name: "BorrowList",
      component: BorrowView,
    },
    {
      path: "/profile",
      name: "Profile",
      component: ProfileView,
    },
    {
      path: "/rolecreate",
      name: "RoleCreate",
      component: RoleCreateView,
    },
    {
      path: "/books/create",
      name: "BookCreate",
      component: BookCreateView,
    },
    {
      path: "/book/:id/update",
      name: "UpdateBook",
      component: BookUpdateView,
    },
    
  ],
});

export default router;
