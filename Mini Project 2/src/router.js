import { createRouter, createWebHistory } from 'vue-router';

import HomeView from './page/HomeView.vue';
import SkillsView from './page/SkillsView.vue';
import ExperienceView from './page/ExperienceView.vue';
import PortfolioView from './page/PortfolioView.vue';

const routes = [
  {
    path: '/',
    name: 'Home',
    component: HomeView
  },
  {
    path: '/skills',
    name: 'Skills',
    component: SkillsView
  },
  {
    path: '/experience',
    name: 'Experience',
    component: ExperienceView
  },
  {
    path: '/portfolio',
    name: 'Portfolio',
    component: PortfolioView
  },
  
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
