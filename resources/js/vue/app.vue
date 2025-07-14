<template>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100">
      <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="text-center mb-8">
          <h1 class="text-4xl font-bold text-gray-800 mb-2">
            <i class="fas fa-sticky-note text-blue-600 mr-3"></i>
            My Notes
          </h1>
          <p class="text-gray-600">Organize your thoughts and ideas</p>
        </div>
        
        <!-- Main Content -->
        <div class="max-w-6xl mx-auto">
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