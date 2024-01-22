<template>
    <breeze-authenticated-layout>
        <template #header>
      <div class="row">
          <div class="col-8">
            <h2 class="h4 font-weight-bold">
            Productos
          </h2>
        </div>
          <div class="col-4">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
              <Link :href="route('productos.create')">
                <button class="btn btn-success me-md-2" type="button">Nuevo</button>
              </Link>
              
            </div>
          </div>
        </div>
        </template>

        <div class="card my-4 shadow-sm">
      <div class="card-body">
          <ProductoTable :key="DataTableKey" :columns="columns" @updated="updated" @deleted="deleted" :productos="productos" />
      </div>
    </div>
    </breeze-authenticated-layout>

    <producto-modal v-if="showModal" :form="form" :categorias="categorias" @updateProducto="updateProducto" @closeModal="closeModal" />
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import ProductoModal from '@/Components/Modals/ProductoModal.vue'
import ProductoTable from '@/Components/DataTable/ProductoTable.vue'
import Swal from 'sweetalert2'
import { Link } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia'

export default {
    name: 'Productos',
    components: {
        BreezeAuthenticatedLayout,
        Link,
        ProductoModal,
        ProductoTable
    },
    props: ['productos', 'categorias'],
    data () {
        return {
            columns: [
                {label: 'id', name: 'id', visible: false},
                {label: 'Categoria', name: 'categoria', visible: true},
                {label: 'Nombre', name: 'nombre', visible: true},
                {label: 'Precio', name: 'precio', visible: true},
                {label: 'Descripción', name: 'descripcion', visible: true},
                {label: 'Categoria ID', name: 'categoria_id', visible: true}
            ],
            showModal: false,
            producto: Object,
            DataTableKey: 0,
            form: this.$inertia.form({
                categoria_id: '',
                nombre: '',
                precio: '',
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
        updated(producto){
            this.producto = producto;
            this.form.categoria_id = producto.categoria_id;
            this.form.nombre = producto.nombre;
            this.form.precio = producto.precio;
            this.form.descripcion = producto.descripcion;
            this.showModal = true;
        },
        updateProducto(param){
            Inertia.put(route('productos.update', this.producto), param,  {
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
                    Inertia.delete(route('productos.destroy', producto),{
                        preserveState: true,
                        preserveScroll: true,
                        only: ['productos'],
                        onFinish : () => {

                            Inertia.visit('productos', {
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