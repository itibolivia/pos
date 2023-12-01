<template>
    <breeze-authenticated-layout>
        <template #header>
            <h2 class="h4 font-weight-bold">
                Nueva persona
            </h2>
        </template>

        <div class="row justify-content-center">
            <div class="card shadow-sm px-3">
                <div class="card-body">
                    <form @submit.prevent="submit">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                <label for="carnet">
                                    <span class="text-danger"> (*) </span>
                                    Nro. de Carnet
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text" 
                                    id="inputGroupPrepend2">#</span>
                                    </div>
                                    <input
                                    v-model="form.carnet"
                                    type="number"
                                    class="form-control"
                                    v-bind:class="{ 'is-invalid' : $page.props.errors.carnet}"
                                    id="carnet"
                                    aria-describedby="carnetHelp"
                                />
                                </div>
                                <div v-if="$page.props.errors.carnet" class="text-danger">
                                    {{ $page.props.errors.carnet }}
                                </div>
                                <small id="carnetHelp" class="form-text text-muted"
                                    >Coloque sólo el número de CI</small
                                >
                                </div>
                            </div>
                            <div class="col-md-8 mb-3">
                                <div class="form-group">
                                <label for="nombre">
                                    <span class="text-danger"> (*) </span>
                                    Nombre completo
                                </label>
                                <input
                                    v-model="form.nombre"
                                    type="text"
                                    class="form-control"
                                    v-bind:class="{ 'is-invalid' : $page.props.errors.nombre}"
                                    id="nombre"
                                    aria-describedby="nombreHelp"
                                />
                                <div v-if="$page.props.errors.nombre" class="text-danger">
                                    {{ $page.props.errors.nombre }}
                                </div>
                                <small id="nombreHelp" class="form-text text-muted"
                                    >Nombre completo de la persona para prospecto</small
                                >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                <label for="telefono">Teléfono</label>
                                <input
                                    v-model="form.telefono"
                                    type="number"
                                    class="form-control"
                                    v-bind:class="{ 'is-invalid' : $page.props.errors.telefono}"
                                    id="telefono"
                                    aria-describedby="telefonoHelp"
                                />
                                <div v-if="$page.props.errors.telefono" class="text-danger">
                                    {{ $page.props.errors.telefono }}
                                </div>
                                <small id="telefonoHelp" class="form-text text-muted"
                                    >Número de teléfono</small
                                >
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                <label for="correo">Correo electrónico</label>
                                <input
                                    v-model="form.correo"
                                    type="email"
                                    class="form-control"
                                    v-bind:class="{ 'is-invalid' : $page.props.errors.correo}"
                                    id="correo"
                                    aria-describedby="correoHelp"
                                />
                                <div v-if="$page.props.errors.correo" class="text-danger">
                                    {{ $page.props.errors.correo }}
                                </div>
                                <small id="correoHelp" class="form-text text-muted"
                                    >Personal</small
                                >
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                <label for="direccion">Dirección</label>
                                <input
                                    v-model="form.direccion"
                                    type="text"
                                    class="form-control"
                                    v-bind:class="{ 'is-invalid' : $page.props.errors.direccion}"
                                    id="direccion"
                                    aria-describedby="direccionHelp"
                                />
                                <div v-if="$page.props.errors.direccion" class="text-danger">
                                    {{ $page.props.errors.direccion }}
                                </div>
                                <small id="direccionHelp" class="form-text text-muted"
                                    >Dirección personal</small
                                >
                                </div>
                            </div>
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

    </breeze-authenticated-layout>
  
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import BreezeButton from '@/Components/Button.vue'

import Swal from 'sweetalert2'

export default {
    name: 'CreatePersona',
    components: {
        BreezeAuthenticatedLayout,
        BreezeButton,
    },
    data () {
        return {
            form: this.$inertia.form({
                carnet: '',
                nombre: '',
                telefono: '',
                correo: '',
                direccion: ''
            })
        }
    },

    methods: {
        submit() {
        this.form.post(this.route('personas.store'), {
          onFinish: () => {
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

<style>

</style>