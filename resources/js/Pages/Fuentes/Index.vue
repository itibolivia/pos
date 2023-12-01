<template>
    <breeze-authenticated-layout>
        <template #header>
      <div class="row">
          <div class="col-8">
            <h2 class="h4 font-weight-bold">
            Fuentes
          </h2>
        </div>
          <div class="col-4">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
              <Link :href="route('fuentes.create')">
                <button class="btn btn-success me-md-2" type="button">Nuevo</button>
              </Link>
              
            </div>
          </div>
        </div>
        </template>

        <div class="card my-4 shadow-sm">
      <div class="card-body">
          <FuenteTable :key="DataTableKey" :columns="columns" @updated="updated" @deleted="deleted" :fuentes="fuentes" />
      </div>
    </div>
    </breeze-authenticated-layout>

    <fuente-modal v-if="showModal" :form="form" @updateFuente="updateFuente" @closeModal="closeModal" />
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import FuenteModal from '@/Components/Modals/FuenteModal.vue'
import FuenteTable from '@/Components/DataTable/FuenteTable.vue'
import Swal from 'sweetalert2'
import { Link } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia'

export default {
    name: 'Fuentes',
    components: {
        BreezeAuthenticatedLayout,
        Link,
        FuenteModal,
        FuenteTable
    },
    props: ['fuentes'],
    data () {
        return {
            columns: [
                {label: 'id', name: 'id', visible: false},
                {label: 'Estado', name: 'estado', visible: true},
                {label: 'Sigla', name: 'sigla', visible: true},
                {label: 'Nombre', name: 'nombre', visible: true},
                {label: 'Descripción', name: 'descripcion', visible: true}
            ],
            showModal: false,
            fuente: Object,
            DataTableKey: 0,
            form: this.$inertia.form({
                sigla: '',
                nombre: '',
                descripcion: ''
            })
        }
    },
    methods: {
        openModal(){
            this.showModal = true;
        },
        closeModal(){
            this.showModal = false;
        },
        updated(fuente){
            this.fuente = fuente;
            this.form.sigla = fuente.sigla;
            this.form.nombre = fuente.nombre;
            this.form.estado = fuente.estado;
            this.form.descripcion = fuente.descripcion;
            this.showModal = true;
        },
        updateFuente(param){
            Inertia.put(route('fuentes.update', this.fuente), param,  {
                onSuccess: (page) => {
                    this.forceRerender();
                    this.closeModal();
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500
                        });
                }
            });
        },
        deleted(producto){
            let swalWithBootstrapButtons = Swal.mixin({
                buttonsStyling : true
            })
            swalWithBootstrapButtons.fire({
                title:'Seguro que desea eliminar?',
                text:'se perderá la información',
                icon:'question',
                showCancelButton:true,
                confirmButtonText:'<i class="fa fa-solid fa-check"></i> si, eliminar',
                cancelButtonText:'<i class="fa fa-solid fa-ban"></i> cancelar'
            }).then((result)=> {
                if(result.isConfirmed){
                    Inertia.delete(route('fuentes.destroy', producto),{
                        preserveState: true,
                        preserveScroll: true,
                        only: ['fuentes'],
                        onFinish : () => {

                            Inertia.visit('fuentes', {
                            onSuccess: page => {
                                Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1500
                                });
                            },
                            })

                            
                        }
                    });
                }    
            })
        },
        forceRerender() {
            this.DataTableKey += 1;
        }
    }
}
</script>

<style>

</style>