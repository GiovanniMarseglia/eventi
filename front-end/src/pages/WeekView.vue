<script setup>
import singleEvent from '../components/singleEvent.vue'
import axios from 'axios';
import{ref,onMounted} from 'vue';

//taken actual date and actualdate + 7 day 
let today=new Date();
let todayPlusSeven=new Date();
todayPlusSeven.setDate(today.getDate()+6);
todayPlusSeven=todayPlusSeven.toLocaleDateString();
today=today.toLocaleDateString();

//axios call to take all week events

const loading=ref(true);
let events = ref([])

function weekElements(){
  axios.get("http://127.0.0.1:8000/api/events/week").then(result=>{
  events.value = result.data.results
  loading.value=false;
})
}

onMounted(() => {
  weekElements();
});
</script>

<template>
  <div class="container mx-auto">
    
    <h1 class="text-2xl font-semibold text-center pt-4">Ecco una lista degli eventi che vanno da giorno {{ today }} fino al giorno {{ todayPlusSeven }}</h1>
    <div v-if="loading" class="container mx-auto mt-5 flex justify-center">

      <font-awesome-icon :icon="['fas', 'spinner']"class="fa-spin loader" />

    </div>
    <div v-if="events" class="flex flex-row mt-6 gap-2">
      <div class="border border-black weq p-3 text-center" v-for="element in events" :key="element.id">
        <singleEvent :events="element"/>
      </div>
    </div>
    <div v-else>
      <h1>Nei prossimi 7 giorni non risultano eventi in corso</h1>
    </div>
</div>
  
</template>

<style scoped>
.weq{
  width: calc(100% / 3);
}

.loader{
  min-width: 500px;
  height: 200px;
}
</style>