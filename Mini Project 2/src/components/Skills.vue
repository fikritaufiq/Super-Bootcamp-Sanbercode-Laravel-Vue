<template>
  <section ref="skillsSection" class="section bg-white py-16 px-4">
    <div class="max-w-3xl mx-auto">
      <h1 class="text-4xl font-bold mb-8">Skills</h1>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 justify-center">
        <div v-for="(skill, index) in skills" :key="index" class="bg-gray-100 p-4 rounded-lg shadow-md flex flex-col items-center text-center">
          <span class="text-6xl text-blue-500 mb-4">
            <i :class="skill.icon"></i>
          </span>
          <h2 class="text-xl font-semibold mb-2">{{ skill.title }}</h2>
          <p class="text-gray-700">{{ skill.description }}</p>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { useSkillsStore } from '../stores/SkillStore';

const store = useSkillsStore();

const skills = store.skills;
</script>

<style scoped>

.section {
  margin-bottom: 2rem;
  color: black; 
}
</style>
