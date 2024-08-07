<template>
  <div id="app" class="bg-base-200 min-h-screen text-white">
  <transition name="fade">
  <router-view />
  </transition>
  </div>
</template>
  

<style>
.fade-enter-active, .fade-leave-active {
transition: opacity 0.5s;
}
.fade-enter, .fade-leave-to  {
opacity: 0;
}
body {
  background-color: #010814;
  color: white;
  margin: 0;
  font-family: Arial, sans-serif;
}

#app {
  min-height: 100vh;
}


</style>
