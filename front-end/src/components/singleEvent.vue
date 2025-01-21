<script setup>
import {ref} from 'vue';
const props = defineProps({
  events: Object,
})

let dateNow ;
dateNow= new Date().toLocaleDateString('en-ZA').replaceAll('/','-');
let color=0;

//if actual date == last day of event add text red
if(dateNow === props.events.end){
    color="text-red-500"
}else{
    color="text-black-500"
}


</script>


<template>

    <div class="flex flex-col">
        <span class="uppercase font-bold">Title: <span class="uppercase font-bold">{{props.events.title}}</span></span>
        <span class="uppercase font-bold">Description: <span class="font-medium">{{props.events.description}}</span></span>
        <span class="uppercase font-bold">Start: <span class="font-medium">{{props.events.start}}</span></span>
        <span class="uppercase font-bold">End: <span :class="color" class="font-medium">{{props.events.end}}</span></span>
    </div>
    
</template>


<style scoped>
    span>span{
        font-weight: initial;
    }
</style>