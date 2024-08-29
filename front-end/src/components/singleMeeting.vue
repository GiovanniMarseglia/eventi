<script setup>
import {ref} from 'vue';
const props = defineProps({
    meeting:Object
})



</script>


<template>

    <div class="flex flex-col p-3 border border-4 border-green-500 min-w-full">
        <span>Name: <span class="uppercase font-semibold">{{props.meeting.name}}</span></span>
        <span>Description: <span class="font-medium">{{props.meeting.description}}</span></span>
        <span>Posti: <span class="font-medium">{{props.meeting.place}}</span></span>
    </div>
    
</template>


<style scoped>

</style>