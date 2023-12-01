<template>
    <breeze-authenticated-layout>
      <template #header>
      
          <h2 class="h4 font-weight-bold">
            Nuevo asesor comercial
          </h2>

      
        </template>

    <div class="row justify-content-center">
      <div class="col-sm-12 col-md-8 col-lg-5">

        <div class="card shadow-sm px-3">
          <div class="card-body">
  
  <breeze-validation-errors class="mb-3" />

  <form @submit.prevent="submit">
    <div class="mb-3">
      <breeze-label for="name" value="Nombre" />
      <breeze-input id="name" type="text" v-model="form.name" required autofocus autocomplete="name" />
    </div>

    <div class="mb-3">
      <breeze-label for="email" value="Correo" />
      <breeze-input id="email" type="email" v-model="form.email" required />
    </div>

    <div class="mb-3">
      <breeze-label for="password" value="Contraseña" />
      <breeze-input id="password" type="password" v-model="form.password" required autocomplete="new-password" />
    </div>

    <div class="mb-3">
      <breeze-label for="password_confirmation" value="Confirmación de contraseña" />
      <breeze-input id="password_confirmation" type="password" v-model="form.password_confirmation" required autocomplete="new-password" />
    </div>

    <div class="mb-0">
      <div class="d-flex justify-content-end align-items-baseline">

        <breeze-button class="ms-4" :class="{ 'text-white-50': form.processing }" :disabled="form.processing"> <!--:disabled="form.processing"-->
          <div v-show="form.processing" class="spinner-border spinner-border-sm" role="status">
            <span class="visually-hidden">Cargando...</span>
          </div>
          
          Guardar
        </breeze-button>
      </div>
    </div>
  </form>
</div>
        </div>
      </div>
    </div>
  
    
  </breeze-authenticated-layout>
  </template>
  
  <script>
  import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
  import BreezeButton from '@/Components/Button.vue'
  import BreezeCheckbox from '@/Components/Checkbox.vue'
  import BreezeInput from '@/Components/Input.vue'
  import BreezeLabel from '@/Components/Label.vue'
  import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
  import { Head, Link } from '@inertiajs/inertia-vue3'

  import Swal from 'sweetalert2';
  
  export default {
  
    components: {
      BreezeAuthenticatedLayout,
      BreezeButton,
      BreezeCheckbox,
      BreezeInput,
      BreezeLabel,
      BreezeValidationErrors,
      Link,
    },
  
    data() {
      return {
        form: this.$inertia.form({
          name: '',
          email: '',
          password: '',
          password_confirmation: '',
          terms: false,
        })
      }
    },
  
    methods: {
      submit() {
        this.form.post(this.route('usuarios.store'), {
          onFinish: () => {
            this.form.reset('password', 'password_confirmation'),
            Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500
                    });
          }
        })
      }
    }
  }
  </script>
  