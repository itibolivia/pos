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
                                <label for="codigo">
                                    <span class="text-danger"> (*) </span>
                                    Categoria
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text" 
                                    id="inputGroupPrepend2">#</span>
                                    </div>
                                    <select
                                        v-model="form.categoria_id"
                                        class="form-select"
                                        v-bind:class="{ 'is-invalid' : $page.props.errors.categoria_id}"
                                        id="categoria_id"
                                        aria-describedby="categoria_idHelp"
                                    >
                                        <option v-for="categoria in categorias" :value="categoria.id" :key="categoria.id">
                                            {{ categoria.nombre }}
                                        </option>
                                    </select>
                                </div>
                                <div v-if="$page.props.errors.codigo" class="text-danger">
                                    {{ $page.props.errors.codigo }}
                                </div>
                                <small id="codigoHelp" class="form-text text-muted"
                                    >Coloque un código para el producto</small
                                >
                                </div>
                            </div>
                            <div class="col-md-5 mb-3">
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
                                    >Nombre completo de la persona para prospecto</small
                                >
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                <label for="precio">
                                    <span class="text-danger"> (*) </span>
                                    Precio</label>
                                <input
                                    v-model="form.precio"
                                    type="number"
                                    class="form-control"
                                    v-bind:class="{ 'is-invalid' : $page.props.errors.precio}"
                                    id="precio"
                                    aria-describedby="precioHelp"
                                />
                                <div v-if="$page.props.errors.precio" class="text-danger">
                                    {{ $page.props.errors.precio }}
                                </div>
                                <small id="precioHelp" class="form-text text-muted"
                                    >Precio del producto</small
                                >
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                <label for="nombre">
                                    Imagen
                                </label>
                                <input
                                    type="file"
                                    class="form-control"
                                    @input="form.imagen = $event.target.files[0]"
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

                            <div class="col-md-8 mb-3">
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
    props : ['categorias'],
    data () {
        return {
            form: this.$inertia.form({
                categoria_id: '',
                nombre: '',
                precio: '',
                imagen: '',
                descripcion: ''
            })
        }
    },

    methods: {
        submit() {
        this.form.post(this.route('productos.store'), {
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