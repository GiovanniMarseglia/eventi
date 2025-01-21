<script setup>
import {ref,watch} from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';
import singleMeeting from '../components/singleMeeting.vue'

const checkFields = ref('')
const name= ref('')
const description = ref('')
const file = ref('')
const color = ref('')
const start = ref('')
const end = ref('')
const checkMeeting = ref('')
const idMeeting = ref('')
const showModal = ref(Boolean)
showModal.value=false
const lock = ref(Boolean)
lock.value=false



const arrayDataStart=ref([])
const arrayDataEnd=ref([])
const arrayDataNow=ref([])
const arrayMeeting=ref([])

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
  axios.get("http://127.0.0.1:8000/api/events/availableMeetings", {params:{idMeeting:idMeeting.value,name:name.value,description:description.value,color:color.value,start:start.value,end:end.value}}).then(result=>{
    arrayMeeting.value=result.data.results
    showModal.value=true
})

}

function storeEvent(){
  axios.post("http://127.0.0.1:8000/api/events/storeEvents", {title:name.value,description:description.value,color:color.value,start:start.value,end:end.value,meeting_id:idMeeting.value}).then(result=>{
    console.log(result)
}).catch(error => {
    console.error(error);
});
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
        <div v-if="idMeeting">
          <label for="idMeeting"></label>
          <input :value="arrayMeeting[idMeeting-1].name" type="text" name="idMeeting" id="idMeeting" readonly>
        </div>
        <span>Data</span>
        <div class="flex gap-2">
          <div class="flex flex-col">
            <label for="start">Inizio</label>
            <input type="date" v-model="start" name="start" id="start" :readonly="lock">
          </div>
          <div v-if="start" class="flex flex-col">
            <label for="end">Fine</label>
            <input type="date" v-model="end" name="end" id="end" :readonly="lock">      
          </div>
        </div>
        <div class="flex justify-center gap-4">
          <button v-if="checkFields" type="button" class="bg-blue-700 rounded-full px-4 py-1" @click="listMeeting">Cerca</button>
          <button v-if="lock" type="button" class="bg-lime-500 rounded-full px-4 py-1" @click="storeEvent">Crea</button>
        </div>
      </div>
    </form>
  </div>

  <!-- inizio modale -->
  <div v-if="showModal" class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
  <!--
    Background backdrop, show/hide based on modal state.

    Entering: "ease-out duration-300"
      From: "opacity-0"
      To: "opacity-100"
    Leaving: "ease-in duration-200"
      From: "opacity-100"
      To: "opacity-0"
  -->
  <div class="fixed inset-0 bg-gray-500/75 transition-opacity" aria-hidden="true"></div>

  <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
      <!--
        Modal panel, show/hide based on modal state.

        Entering: "ease-out duration-300"
          From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
          To: "opacity-100 translate-y-0 sm:scale-100"
        Leaving: "ease-in duration-200"
          From: "opacity-100 translate-y-0 sm:scale-100"
          To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
      -->
      <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
        <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
          <div class="sm:flex sm:items-start">
            
            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
              <h3 class="text-base font-semibold text-gray-900" id="modal-title">Seleziona sala</h3>
              <div class="mt-2">

                <div class="flex flex-row mt-6 gap-2 cursor-pointer" v-for="element in arrayMeeting" :key="element.id" >
                <singleMeeting :meeting="element"  @click="idMeeting=element.id,lock=true,showModal=false" />
                </div>

              </div>
            </div>
          </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
          <button type="button" class="inline-flex w-full justify-center rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto" @click="showModal=false">Chiudi</button>
        </div>
      </div>
    </div>
  </div>
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