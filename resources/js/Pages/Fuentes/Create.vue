<template>
    <breeze-authenticated-layout>
        <template #header>
            <h2 class="h4 font-weight-bold">
                Nuevo producto
            </h2>
        </template>

        <div class="row justify-content-center">
            <div class="card shadow-sm px-3">
                <div class="card-body">
                    <form @submit.prevent="submit">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                <label for="sigla">
                                    <span class="text-danger"> (*) </span>
                                    Sigla
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text" 
                                    id="inputGroupPrepend2">#</span>
                                    </div>
                                    <input
                                    v-model="form.sigla"
                                    type="text"
                                    class="form-control"
                                    v-bind:class="{ 'is-invalid' : $page.props.errors.sigla}"
                                    id="sigla"
                                    aria-describedby="siglaHelp"
                                />
                                </div>
                                <div v-if="$page.props.errors.sigla" class="text-danger">
                                    {{ $page.props.errors.sigla }}
                                </div>
                                <small id="siglaHelp" class="form-text text-muted"
                                    >Coloque una sigla para el origen</small
                                >
                                </div>
                            </div>
                            <div class="col-md-8 mb-3">
                                <div class="form-group">
                                <label for="nombre">
                                    <span class="text-danger"> (*) </span>
                                    Nombre
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
                                    >Nombre del origen para el propspecto</small
                                >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                <label for="estado">Estado</label>
                                <select
                                    v-model="form.estado"
                                    class="form-select"
                                    v-bind:class="{ 'is-invalid' : $page.props.errors.estado}"
                                    id="estado"
                                    aria-describedby="estadoHelp"
                                >
                                    <option value="Publicado">Publicado</option>
                                    <option value="Despublicado">Despublicado</option>
                                </select>
                                <div v-if="$page.props.errors.estado" class="text-danger">
                                    {{ $page.props.errors.estado }}
                                </div>
                                <small id="estadoHelp" class="form-text text-muted"
                                    >Estado del origen</small
                                >
                                </div>
                            </div>
                            
                            <div class="col-md-9 mb-3">
                                <div class="form-group">
                                <label for="descripcion">Descripción</label>
                                <input
                                    v-model="form.descripcion"
                                    type="text"
                                    class="form-control"
                                    v-bind:class="{ 'is-invalid' : $page.props.errors.descripcion}"
                                    id="descripcion"
                                    aria-describedby="descripcionHelp"
                                />
                                <div v-if="$page.props.errors.descripcion" class="text-danger">
                                    {{ $page.props.errors.descripcion }}
                                </div>
                                <small id="descripcionHelp" class="form-text text-muted"
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
    name: 'CreateProducto',
    components: {
        BreezeAuthenticatedLayout,
        BreezeButton,
    },
    data () {
        return {
            form: this.$inertia.form({
                sigla: '',
                nombre: '',
                estado: '',
                descripcion: ''
            })
        }
    },

    methods: {
        submit() {
        this.form.post(this.route('fuentes.store'), {
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