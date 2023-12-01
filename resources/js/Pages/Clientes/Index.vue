<template>

<breeze-authenticated-layout>
    <template #header>
      <h2 class="h4 font-weight-bold">
        Ventas
      </h2>
    </template>

    <div class="card my-4 shadow-sm">
      <div class="card-body">
        <ClienteTable :columns="columns" :clientes="clientes" />
      </div>
    </div>

  </breeze-authenticated-layout>

</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import ClienteTable from '@/Components/DataTable/ClienteTable.vue'

export default {
  name: 'Clientes',
  props: ['clientes'],
  components: {
    BreezeAuthenticatedLayout,
    ClienteTable
  },
  data () {
    return {
      columns: [
          {label: 'id', name: 'id', visible: false},
          {label: 'Origen', name: 'fuente', visible: true},
          {label: 'Producto', name: 'producto', visible: true},
          {label: 'Persona', name: 'persona', visible: true},
          {label: 'Precio', name: 'precio', visible: true},
          {label: 'Asesor', name: 'asesor', visible: true}
      ],
    }
  }
}
</script>

<style>

</style>