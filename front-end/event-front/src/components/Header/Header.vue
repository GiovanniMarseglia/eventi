<script setup>


</script>

<template>
    <div class="bg-blue-600 text-white py-2">
        <router-link :to="{name:'home'}">
            <h1 class="inline mx-1 text-xl hover:text-gray-300">Kata-Meeting-Rooms</h1>
        </router-link>
        
        <router-link :to="{name:'AddMeeting'}">
            <span class="mx-1 hover:text-gray-300">Aggiungi nuova sala meeting</span>
        </router-link>
        
        <router-link :to="{name:'AddEvent'}">
            <span class="mx-1 hover:text-gray-300">Crea un nuovo Evento</span>
        </router-link>
        
        <router-link :to="{name:'WeekView'}">
            <span class="mx-1 hover:text-gray-300">Vista settimanale</span>
        </router-link>
        
        <router-link :to="{name:'FindDateRoom'}">
            <span class="mx-1 hover:text-gray-300">Ricerca eventi per data e sala</span>
        </router-link>
        
        
    </div>
</template>

<style>

</style>