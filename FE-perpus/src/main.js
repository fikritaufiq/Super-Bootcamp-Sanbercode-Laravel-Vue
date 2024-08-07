import './styles/index.css';
import { createApp, markRaw } from 'vue';
import { createPinia } from 'pinia';
import App from './App.vue';
import router from './router';
import { useAuthStore } from './stores/AuthStore';

const createMyApp = () => {
  const app = createApp(App);
  const pinia = createPinia();

  app.use(router);
  app.use(pinia);

  const authStore = useAuthStore();
  authStore.initializeAuth(); 

  pinia.use(({ store }) => {
    store.router = markRaw(router);
  });

  app.mount('#app');
};

createMyApp();