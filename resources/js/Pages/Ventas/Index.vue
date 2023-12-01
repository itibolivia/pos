<template>

    <breeze-authenticated-layout>
        <template #header>
          <h2 class="h4 font-weight-bold">
            Ventas
          </h2>
        </template>
    
        <div class="card my-4 shadow-sm">
          <div class="card-body">
            <DataTable :data="data" class="display">
                <thead>
                    <tr>
                        <th>A</th>
                        <th>B</th>
                    </tr>
                </thead>
            </DataTable>
          </div>
        </div>
    
      </breeze-authenticated-layout>
    
    </template>
    
    <script setup>
    import DataTable from 'datatables.net-vue3'
    import DataTablesCore from 'datatables.net'
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
     
    DataTable.use(DataTablesCore);
     
    const data = [
      [1, 2],
      [3, 4],
    ];
    </script>
    
    <style>
    @import 'datatables.net-dt';
    </style>