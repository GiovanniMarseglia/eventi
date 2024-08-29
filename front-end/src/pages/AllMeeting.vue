<script setup>
import singleMeeting from '../components/singleMeeting.vue'
import axios from 'axios';
import{ref,onMounted} from 'vue';


let meetings = ref([])

function meetingList(){
  axios.get("http://127.0.0.1:8000/api/meetings").then(result=>{
    meetings.value = result.data.results
    console.log(meetings.value)
})
}

onMounted(() => {
  meetingList();
});
</script>

<template>
  <div class="container mx-auto">
    
    <h1 class="text-2xl font-semibold text-center pt-4">Lista di tutte le sale meeting registrate</h1>
    
    <div class="flex flex-row mt-6 gap-2" v-for="element in meetings" :key="element.id">
      <singleMeeting :meeting="element" />
    </div>
</div>
  
</template>

<style scoped>
.weq{
  width: calc(100% / 3);
}
</style>