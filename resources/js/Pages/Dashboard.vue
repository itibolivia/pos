<template>
  <Head title="Dashboard" />

  <breeze-authenticated-layout>
    <template #header>
      <h2 class="h4 font-weight-bold">
        Bienvenida
      </h2>
    </template>

    <div class="card my-4 shadow-sm">
      <div class="card-body">
        <h4>Hola {{ $page.props.auth.user.name }} !!!</h4>    
      </div>
    </div>

  </breeze-authenticated-layout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head } from '@inertiajs/inertia-vue3'

export default {
  components: {
    BreezeAuthenticatedLayout,
    Head
  },
}
</script>
