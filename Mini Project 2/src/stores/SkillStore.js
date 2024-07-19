import { defineStore } from 'pinia';

export const useSkillsStore = defineStore('skills', {
  state: () => ({
    skills: [
      {
        title: 'Frontend',
        description: 'HTML, CSS, JavaScript, Vue.js, React',
        icon: 'pi pi-code', 
      },
      {
        title: 'Backend',
        description: 'Laravel, Node.js, Express.js, Python',
        icon: 'pi pi-database'
      },
      {
        title: 'QA',
        description: 'Manual Testing, Automation Testing, Selenium, Katalon, Postman',
        icon: 'pi pi-check-square',
      },
      {
        title: 'DevOps',
        description: 'Git',
        icon: 'pi pi-cog',
      },
    ],
  }),
});
