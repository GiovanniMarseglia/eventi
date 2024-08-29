<script setup>
import singleMeeting from '../components/singleMeeting.vue'
import axios from 'axios';
import{ref,onMounted} from 'vue';


let meetings = ref([])
const loading=ref(true);
function meetingList(){
  axios.get("http://127.0.0.1:8000/api/meetings").then(result=>{
    meetings.value = result.data.results
    loading.value=false;
})
}

onMounted(() => {
  meetingList();
});
</script>

<template>
  <div class="container mx-auto">
    
    <h1 class="text-2xl font-semibold text-center pt-4">Lista di tutte le sale meeting registrate</h1>
    
    <div v-if="loading == false" class="flex flex-row mt-6 gap-2" v-for="element in meetings" :key="element.id">
      <singleMeeting :meeting="element" />
    </div>
    <div v-else class="container mx-auto mt-5 flex justify-center">

        <font-awesome-icon :icon="['fas', 'spinner']"class="fa-spin loader" />

    </div>
</div>
  
</template>

<style scoped>

.loader{
  min-width: 500px;
  height: 200px;
}
</style>