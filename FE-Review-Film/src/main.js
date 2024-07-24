import './styles/index.css';
import { createApp, markRaw } from 'vue';
import { createPinia } from 'pinia';
import App from './App.vue'
import router from './router'

const app = createApp(App)
const pinia = createPinia()

app.use(router)
app.use(pinia)

pinia.use(({store}) => {
    store.router = markRaw(router)
})

app.mount('#app')
