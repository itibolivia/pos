<template>
  <div class="row justify-content-center">
            <div class="card shadow-sm px-3">
                <div class="card-body">
                    <form @submit.prevent="submit">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                <label for="precio">
                                    <span class="text-danger"> (*) </span>
                                    Precio Venta
                                </label>
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
                                    >Precio final</small
                                >
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                <label for="rubro">Rubro</label>
                                <input
                                    v-model="form.rubro"
                                    type="text"
                                    class="form-control"
                                    v-bind:class="{ 'is-invalid' : $page.props.errors.rubro}"
                                    id="rubro"
                                    aria-describedby="rubroHelp"
                                />
                                <div v-if="$page.props.errors.rubro" class="text-danger">
                                    {{ $page.props.errors.rubro }}
                                </div>
                                <small id="rubroHelp" class="form-text text-muted"
                                    >Dedicación del cliente</small
                                >
                                </div>
                            </div>
                        </div>
                        <div class="row">                            
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                <label for="padre">Papá/Mamá</label>
                                <select
                                    v-model="form.padre"
                                    class="form-select"
                                    v-bind:class="{ 'is-invalid' : $page.props.errors.padre}"
                                    id="padre"
                                    aria-describedby="padreHelp"
                                >
                                    <option value="papa">Papá</option>
                                    <option value="mama">Mamá</option>
                                    <option value="nohijos">Sin hijos</option>
                                </select>
                                <div v-if="$page.props.errors.padre" class="text-danger">
                                    {{ $page.props.errors.padre }}
                                </div>
                                <small id="padreHelp" class="form-text text-muted"
                                    >Padre o madre</small
                                >
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                <label for="cumpleanos">Cumpleaños</label>
                                <input
                                    v-model="form.cumpleanos"
                                    type="date"
                                    class="form-control"
                                    v-bind:class="{ 'is-invalid' : $page.props.errors.cumpleanos}"
                                    id="cumpleanos"
                                    aria-describedby="cumpleanosHelp"
                                />
                                <div v-if="$page.props.errors.cumpleanos" class="text-danger">
                                    {{ $page.props.errors.cumpleanos }}
                                </div>
                                <small id="cumpleanosHelp" class="form-text text-muted"
                                    >Aniversario natal</small
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
</template>

<script>
import BreezeButton from '@/Components/Button.vue'

import Swal from 'sweetalert2'

export default {
    name: 'CreateProducto',
    components: {
        BreezeButton,
    },
    props: ['venta'],
    data () {
        return {
            form: this.$inertia.form({
                venta: this.venta.id,
                precio: '',
                rubro: '',
                padre: '',
                cumpleanos: ''
            })
        }
    },

    methods: {
        submit() {
        this.form.post(this.route('clientes.store'), {
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