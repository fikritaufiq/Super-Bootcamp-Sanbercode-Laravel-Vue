<template>
  <section ref="skillsSection" class="section bg-white py-16 px-4">
    <div class="max-w-3xl mx-auto">
      <h1 class="text-4xl font-bold mb-8">Skills</h1>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 justify-center">
        <!-- Frontend -->
        <div class="bg-gray-100 p-4 rounded-lg shadow-md flex flex-col items-center text-center">
          <img src="@/assets/frontend.png" alt="Frontend Logo" class="mb-4 h-24">
          <h2 class="text-xl font-semibold mb-2">Frontend</h2>
          <p class="text-gray-700">
            HTML, CSS, JavaScript, Vue.js, React
          </p>
        </div>
        <!-- Backend -->
        <div class="bg-gray-100 p-4 rounded-lg shadow-md flex flex-col items-center text-center">
          <img src="@/assets/backend.png" alt="Backend Logo" class="mb-4 h-24">
          <h2 class="text-xl font-semibold mb-2">Backend</h2>
          <p class="text-gray-700">
            Laravel, Node.js, Express.js, Python
          </p>
        </div>
        <!-- QA -->
        <div class="bg-gray-100 p-4 rounded-lg shadow-md flex flex-col items-center text-center">
          <img src="@/assets/qa.png" alt="QA Logo" class="mb-4 h-24">
          <h2 class="text-xl font-semibold mb-2">QA</h2>
          <p class="text-gray-700">
            Manual Testing, Automated Testing, Selenium, Katalon, Postman
          </p>
        </div>
        <!-- DevOps -->
        <div class="bg-gray-100 p-4 rounded-lg shadow-md flex flex-col items-center text-center">
          <img src="@/assets/devops.png" alt="DevOps Logo" class="mb-4 h-24">
          <h2 class="text-xl font-semibold mb-2">DevOps</h2>
          <p class="text-gray-700">
            Git
          </p>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
// No need to define a skillsSection ref here
</script>

<style scoped>
/* Scoped styles for Skills component */
.section {
  margin-bottom: 2rem;
  color: black; /* Override text color if needed */
}
</style>