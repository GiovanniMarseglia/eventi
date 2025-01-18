<script setup>

</script>

<template>
  <div class="container min-h-full mx-auto p-5">
  
    <form class="flex flex-col content-start mx-auto rounded-lg" action="">
      <h1 class="rounded-t-lg p-1">Evento</h1>
      <div class="p-3">
      
        <div class="flex flex-col">
          <label for="name">Inserisci il nome dell'evento</label>
          <input type="text" name="name" id="">
          <label for="description">Inserisci la descrizione dell'evento</label>
          <textarea name="description" id="" cols="10" rows="5"></textarea>
          <label for="">Locandina</label>
          <input type="file" name="" id="">
          <label for="">Colore</label>
          <input type="color" name="" id="">
        </div>
        <span>Data</span>
        <div class="flex">
          <input type="date" name="" id="">
          <input type="date" name="" id="">      
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