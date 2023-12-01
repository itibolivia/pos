<template>

    <breeze-authenticated-layout>
        <template #header>
          <h2 class="h4 font-weight-bold">
            Bajas
          </h2>
        </template>
    
        <div class="card my-4 shadow-sm">
          <div class="card-body">
            <BajaTable :columns="columns" :bajas="bajas" />
          </div>
        </div>
    
      </breeze-authenticated-layout>
    
    </template>
    
    <script>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
    import BajaTable from '@/Components/DataTable/BajaTable.vue'
    
    export default {
      name: 'Bajas',
      props: ['bajas'],
      components: {
        BreezeAuthenticatedLayout,
        BajaTable
      },
      data () {
        return {
          columns: [
              {label: 'id', name: 'id', visible: false},
              {label: 'Origen', name: 'fuente', visible: true},
              {label: 'Producto', name: 'producto', visible: true},
              {label: 'Persona', name: 'persona', visible: true},
              {label: 'Fecha', name: 'fecha', visible: true},
              {label: 'Nota', name: 'nota', visible: true}
          ],
        }
      }
    }
    </script>
    
    <style>
    
    </style>