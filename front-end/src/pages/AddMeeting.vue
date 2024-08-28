<script setup>
import axios from 'axios';
import {ref} from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();
const name = ref('');
const description = ref('');
const number = ref('');
const loading=ref(false);
function send(){
  if(name.value && description.value && number.value){
    loading.value=true
    axios.post("http://127.0.0.1:8000/api/meetings", { params: { name: this.name, description: this.description, number:this.number } }).then(function (response){
      console.log("risposta back " ,response)
      name.value='';
      description.value='';
      number.value='';
      loading.value = false;
      router.push('/Success');
    }).catch(function (error){
      console.log("errore front",error)
    }) .finally(function(){
      loading.value = false;
    })
    
  }else{
    alert("Controlla di aver inserito sia il nome la descrizione ed il numero di posti disponibili")
    loading.value=false;
  }
}
</script>

<template>
  <h1 class="text-2xl font-semibold text-center mt-4">Crea una nuova sala Meeting</h1>
  <div v-if="loading == false" class="container mx-auto flex justify-center">

    <form method="get" class="flex flex-col w-6/12">
      <label for="name">Nome</label>
      <input v-model="name" class="border border-black rounded-lg" type="text" name="name" id="name">
      <label for="description">Descrizione</label>
      <textarea v-model="description" class="border border-black rounded-lg" rows="5" cols="10" name="description" id="description"></textarea>
      <label class="mx-auto" for="number">Posti</label>
      <input v-model="number" class="mx-auto border border-black rounded-lg w-2/12 px-2" type="number" name="number" id="name">
      
      <button class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center rounded-lg w-2/12 mx-auto mt-3" type="button" @click="send()">Crea sala</button>
    </form>

  </div>
  <div v-else class="container mx-auto mt-5 flex justify-center">

    <font-awesome-icon :icon="['fas', 'spinner']"class="fa-spin loader" />
  
  </div>
</template>

<style scoped>
.loader{
  min-width: 500px;
  height: 200px;
}
</style>