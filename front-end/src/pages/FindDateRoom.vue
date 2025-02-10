<script setup>
import singleMeeting from '../components/singleMeeting.vue'
import axios from 'axios'
import{ref,onMounted} from 'vue'

const showModal=ref(Boolean) 
showModal.value=false
const idMeeting=ref()
const lock = ref(Boolean)
lock.value=false
const start = ref('')

const arrayMeeting=ref([])
const meetingEvents=ref([])


function meetingList(){
  axios.get("http://127.0.0.1:8000/api/meetings").then(result=>{
    arrayMeeting.value = result.data.results
})
}


function find(){

  //insert URL to find all events for one meetings in "date" range

   axios.get("http://127.0.0.1:8000/api/events/find",{params:{id:idMeeting.value,date:start.value}}).then(result=>{
    meetingEvents.value = result.data.results
    console.log(meetingEvents.value)
 })
}


</script>

<template>
  <h1 class="text-2xl font-semibold text-center pt-4">Seleziona una data ed una sala per visualizzare gli eventi disponibili</h1>
  <div class="container mx-auto">

    <form class="flex flex-col content-start mx-auto rounded-lg mt-5 p-5"  action="">
      
      <input v-model="start" type="date" name="date" id="date">
      <div class="flex flex-col">
        <button type="button" @click="meetingList(), showModal=true" class="text-white bg-gray-700 rounded-full px-4 py-1">Clicca per scegliere la sala</button>

        <div v-if="idMeeting" class="flex flex-col">
          <label for="idMeeting">Sala</label>
          <input :value="arrayMeeting[idMeeting-1].name" type="text" name="meet" id="meet" :readonly="lock">
        </div>
        
      </div>

      <div class="flex justify-center gap-4">
          
          <button v-if="lock && start" type="button" class="bg-lime-500 rounded-full px-4 py-1" @click="find">Cerca</button>
        </div>
    </form>




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