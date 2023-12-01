<template>

<breeze-authenticated-layout>
  <template #header>
      <div class="row">
          <div class="col-8">
            <h2 class="h4 font-weight-bold">
            Prospectos
          </h2>
        </div>
          <div class="col-4">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
              <Link :href="route('prospectos.create')">
                <button class="btn btn-success me-md-2" type="button">Nuevo</button>
              </Link>
              
            </div>
          </div>
        </div>
        </template>

    <div class="card my-4 shadow-sm">
      <div class="card-body">
        <ProspectoTable :columns="columns" :prospectos="prospectos" />
      </div>
    </div>

  </breeze-authenticated-layout>

</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import ProspectoTable from '@/Components/DataTable/ProspectoTable.vue'
import { Link } from '@inertiajs/inertia-vue3'

export default {
  name: 'Prospectos',
  props: ['prospectos'],
  components: {
    BreezeAuthenticatedLayout,
    Link,
    ProspectoTable
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