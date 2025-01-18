<script setup>
import {ref,watch} from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';

const checkFields = ref('')
const name= ref('')
const description = ref('')
const file = ref('')
const color = ref('')
const start = ref('')
const end = ref('')
const checkMeeting = ref('')

const arrayDataStart=ref([])
const arrayDataEnd=ref([])
const arrayDataNow=ref([])

//get actual date for comparisone with field start in form
const dateNow = new Date();

const giorno = dateNow.getDate();
const mese = dateNow.getMonth() + 1; 
const anno = dateNow.getFullYear();

//adjust formatting to match with input date
const dateFormatted = `${anno}-${mese <= 9 ? '0' : ''}${mese}-${giorno}`;
arrayDataNow.value=dateFormatted.split("-")
console.log(dateFormatted);

watch([name, description, color, start, end], () => {
  //check date,"start" must happen from today and not before
  if(start.value){
    arrayDataStart.value=start.value.split("-")
  
    if(!(arrayDataStart.value[0] >= arrayDataNow.value[0])){
      start.value=""
      end.value=""
    }
  }
//check date,"start" must be before the "end"
  if(end.value){
    arrayDataEnd.value=end.value.split("-")
    
    if(!(arrayDataEnd.value[0] >= arrayDataStart.value[0])){
      end.value=""
    }else{
      if(!(arrayDataEnd.value[1] >= arrayDataStart.value[1])){
        end.value=""
      }else{
        if ((arrayDataEnd.value[1] == arrayDataStart.value[1])) {
          if(!(arrayDataEnd.value[2] >= arrayDataStart.value[2])){
            end.value=""
          }
        }
      }
    }
  }

  if (name.value && description.value && color.value && start.value && end.value) {
    checkFields.value = true;
  } else {
    checkFields.value = false;
  }
})


//get lists of all meeting available in the specific range
function listMeeting(){
  axios.get("http://127.0.0.1:8000/api/events/availableMeetings", {params:{start:start.value,end:end.value}}).then(result=>{
  console.dir(result.data.results)
})
}
</script>

<template>
  <div class="container min-h-full mx-auto p-5">
  
    <form class="flex flex-col content-start mx-auto rounded-lg" action="">
      <h1 class="rounded-t-lg p-1">Evento</h1>
      <div class="p-3">
      
        <div class="flex flex-col">
          <label for="name">Inserisci il nome dell'evento</label>
          <input v-model="name" type="text" name="name" id="">
          <label for="description">Inserisci la descrizione dell'evento</label>
          <textarea v-model="description" name="description" id="description" cols="10" rows="5"></textarea>
          <label for="file">Locandina</label>
          <input type="file" name="file" id="file">
          <label for="color">Colore</label>
          <input v-model="color" type="color" name="color" id="color">
        </div>
        <span>Data</span>
        <div class="flex gap-2">
          <div class="flex flex-col">
            <label for="start">Inizio</label>
            <input type="date" v-model="start" name="start" id="start">
          </div>
          <div v-if="start" class="flex flex-col">
            <label for="end">Fine</label>
            <input type="date" v-model="end" name="end" id="end">      
          </div>
        </div>
        <div class="flex justify-center gap-4">
          <button v-if="checkFields" type="button" class="bg-blue-700 rounded-full px-4 py-1" @click="listMeeting">Cerca</button>
          <button v-if="checkMeeting" type="button" class="bg-lime-500 rounded-full px-4 py-1">Crea</button>
        </div>
      </div>
    </form>
  </div>

  
</template>

<style scoped>
  input, textarea, form{
    margin-bottom: 5px;
    border: 1px solid gray;
  }
  h1{
    border-bottom: 1px solid gray;
    background-color: rgb(236, 235, 235);
  }
  form{
    width: 60%;
  }
</style>