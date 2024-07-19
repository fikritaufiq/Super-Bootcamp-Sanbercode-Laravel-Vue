<template>
  <section ref="experienceSection" class="section bg-white py-16 px-4">
    <div class="max-w-3xl mx-auto">
      <h1 class="text-4xl font-bold mb-8">Experience</h1>
      <div class="relative border-l border-gray-200 dark:border-gray-700">
        <div v-for="(experience, index) in experiences" :key="index" class="mb-10 ml-4">
          <div class="absolute w-3 h-3 bg-blue-500 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900"></div>
          <time class="mb-1 text-sm font-normal leading-none text-black text-gray-400 dark:text-gray-500">{{ experience.period }}</time>
          <h3 class="text-lg font-semibold text-black dark:text-white">{{ experience.role }}</h3>
          <p class="text-base font-normal text-black dark:text-gray-400">{{ experience.company }}</p>
          <p class="text-base font-normal text-black dark:text-gray-400 mt-2">{{ experience.description }}</p>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
const experiences = [
  {
    period: 'Juni 2024 - Sekarang',
    role: 'Talent Superbootcamp Laravel-Vue',
    company: 'PT Santai Berkualitas Syberindo (Sanbersy)',
    description: 'Untuk Saat ini masih belajar Fullstack Web Development dengan Frontend VueJS, dan Backend Laravel'
  },
  {
    period: 'Desember 2023 - Januari 2024',
    role: 'Talent Mini Bootcamp Quality Assurance',
    company: 'Pt. Digitalisasi Pemuda Indonesia (Digital Skola)',
    description: 'selama 1 bulan belajar Manual dan Automation Testing dengan tools Postman, Katalon, dan, Selenium'
  },
  {
    period: 'Juli 2022 - September 2022',
    role: 'Talent Bootcamp ERP Programming',
    company: 'PT. Hashmicro Solusi Indonesia (Hashmicro Academy)',
    description: 'Selama 2 bulan belajar ERP PRogramming dengan aplikasi berbasis ERP yaitu Odoo, dan Backend Python'
  },
  {
    period: 'Agustus 2021 - Maret 2022',
    role: 'Talent Bootcamp FullStack Web Development',
    company: 'PT. Lentera Bangsa Benderang (Binar Academy)',
    description: 'Selama 6 bulan belajar Fullstack Web Development dengan Frontend ReactJS, dan Backend NodeJS, ExpressJS, dan Sequelize'
  }
];
</script>

<style scoped>
.section {
  margin-bottom: 2rem;
}

.text-black {
  color: black;
}
</style>
