<template>
    <breeze-authenticated-layout>
        <template #header>
      <div class="row">
          <div class="col-8">
            <h2 class="h4 font-weight-bold">
            Compras
          </h2>
        </div>
          <div class="col-4">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
              <Link :href="route('compras.create')">
                <button class="btn btn-success me-md-2 text-white" type="button">
                    <i class="fas fa-plus text-white"></i> Compra
                </button>
              </Link>
              
            </div>
          </div>
        </div>
        </template>

        <div class="card my-4 shadow-sm">
      <div class="card-body">
          <CompraTable :key="DataTableKey" :columns="columns" @updated="updated" @deleted="deleted" :compras="compras" />
      </div>
    </div>
    </breeze-authenticated-layout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import CompraModal from '@/Components/Modals/CompraModal.vue'
import CompraTable from '@/Components/DataTable/CompraTable.vue'
import Swal from 'sweetalert2'
import { Link } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia'

export default {
    name: 'Compras',
    components: {
        BreezeAuthenticatedLayout,
        Link,
        CompraModal,
        CompraTable
    },
    props: ['compras'],
    data () {
        return {
            columns: [
                {label: 'id', name: 'id', visible: false},
                {label: 'Fecha', name: 'fecha', visible: true},
                {label: 'Recibo', name: 'recibo', visible: true},
                {label: 'Factura', name: 'factura', visible: true}
            ],
            showModal: false,
            compra: Object,
            DataTableKey: 0,
            form: this.$inertia.form({
                recibo: '',
                factura: '',
                fecha: '',
                productos: Object
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
        updated(compra){
            this.compra = compra;
            Inertia.visit(route('compras.edit', this.compra));

        },
        updateCompra(param){
            Inertia.put(route('compras.update', this.compra), param,  {
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
        deleted(compra){
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
                    Inertia.delete(route('compras.destroy', compra),{
                        preserveState: true,
                        preserveScroll: true,
                        only: ['compras'],
                        onFinish : () => {

                            Inertia.visit('compras', {
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