<script setup>
let name;
let description;
let number;
function send(){
  axios.post("http://127.0.0.1:8000/api/meetings", { params: { name: this.name, description: this.description, number:this.number } })
}
</script>

<template>
  <h1 class="text-2xl font-semibold text-center pt-4">Crea una nuova sala Meeting</h1>
  <div class="container mx-auto flex justify-center">

    <form method="get" class="flex flex-col w-6/12">
      <label for="name">Nome</label>
      <input v-model="name" class="border border-black rounded-lg" type="text" name="name" id="name">
      <label for="description">Descrizione</label>
      <textarea v-model="description" class="border border-black rounded-lg" rows="5" cols="10" name="description" id="description"></textarea>
      <label class="mx-auto" for="number">Posti</label>
      <input v-model="number" class="mx-auto border border-black rounded-lg w-2/12 px-2" type="number" name="number" id="name">
      
      <!-- <button class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center rounded-lg w-2/12 mx-auto mt-3" type="button" @click="send()">Crea sala</button> -->
    </form>

  </div>
</template>

<style scoped>

</style>