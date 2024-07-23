<script setup>
import Header from './components/Header/Header.vue';
</script>

<template>
  <div class="h-dvh">
  
    <Header/>
    <main class="a">
        <router-view></router-view>
    </main>
  </div>
</template>

<style scoped>
.a{
  height: calc(100vh - 44px);
}
</style>
