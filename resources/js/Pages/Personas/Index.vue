<template>
    <breeze-authenticated-layout>
        <template #header>
      <div class="row">
          <div class="col-8">
            <h2 class="h4 font-weight-bold">
            Personas
          </h2>
        </div>
          <div class="col-4">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
              <Link :href="route('personas.create')">
                <button class="btn btn-success me-md-2" type="button">Nuevo</button>
              </Link>
              
            </div>
          </div>
        </div>
        </template>

        <div class="card my-4 shadow-sm">
      <div class="card-body">
          <DataTablePersona :key="DataTableKey" :columns="columns" @updated="updated" @deleted="deleted" :personas="personas" />
      </div>
    </div>
    </breeze-authenticated-layout>

    <persona-modal v-if="showModal" :form="form" @updatePersona="updatePersona" @closeModal="closeModal" />
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import PersonaModal from '@/Components/Modals/PersonaModal.vue'
import DataTablePersona from '@/Components/DataTablePersona.vue'
import Swal from 'sweetalert2'
import { Link } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia'

export default {
    name: 'Personas',
    components: {
        BreezeAuthenticatedLayout,
        Link,
        PersonaModal,
        DataTablePersona
    },
    props: ['personas'],
    data () {
        return {
            columns: [
                {label: 'id', name: 'id', visible: false},
                {label: 'Código', name: 'codigo', visible: true},
                {label: 'Carnet', name: 'carnet', visible: true},
                {label: 'Nombre', name: 'nombre', visible: true},
                {label: 'Teléfono', name: 'telefono', visible: true},
                {label: 'Correo', name: 'correo', visible: true},
                {label: 'Asesor', name: 'asesor', visible: true}
            ],
            showModal: false,
            persona: Object,
            DataTableKey: 0,
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
        openModal(){
            this.showModal = true;
        },
        closeModal(){
            this.showModal = false;
        },
        updated(persona){
            this.persona = persona;
            this.form.carnet = persona.carnet;
            this.form.nombre = persona.nombre;
            this.form.telefono = persona.telefono;
            this.form.correo = persona.correo;
            this.form.direccion = persona.direccion;
            this.showModal = true;
        },
        updatePersona(param){
            Inertia.put(route('personas.update', this.persona), param,  {
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
        deleted(persona){
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
                    Inertia.delete(route('personas.destroy', persona),{
                        preserveState: true,
                        preserveScroll: true,
                        only: ['personas'],
                        onFinish : () => {

                            Inertia.visit('personas', {
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