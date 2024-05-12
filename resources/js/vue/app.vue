<template>
    <div class="container p-10 flex-col">
      <div class="row">
        <div class="col-md-12">
          <h1 class="font-bold text-2xl text-center ml-20">My Notes</h1>
          <createNotes/>
        </div>
      </div> 
    </div>
  </template>
  
  <script>
  
  import createNotes from './createNotes.vue';
  
  export default {
    components: {
      createNotes,
  
      
    }
  }
  </script>
  