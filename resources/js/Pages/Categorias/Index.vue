<template>
  <breeze-authenticated-layout>

    <div class="card my-4 shadow-sm">
        <div class="card-header">
            <form @submit.prevent="submit">
                <div class="row">
                    <div class="col-md-2 mb-3">
                        <div class="form-group">
                            <label for="nombre">
                                <span class="text-danger"> (*) </span>
                                Nombre
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            
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
                                >Nombre de la categoria. Ej: Lacteos, Gaseosas, etc.</small>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
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
        <div class="card-body">
            <CategoriaTable :key="DataTableKey" :columns="columns" @updated="updated" @deleted="deleted" :categorias="categorias" />
        </div>
      </div>

  </breeze-authenticated-layout>

  <categoria-modal v-if="showModal" :form="form" @updateCategoria="updateCategoria" @closeModal="closeModal" />
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import BreezeButton from '@/Components/Button.vue'
import CategoriaTable from '@/Components/DataTable/CategoriaTable.vue'
import CategoriaModal from '@/Components/Modals/CategoriaModal.vue'
import { Inertia } from '@inertiajs/inertia'
import Swal from 'sweetalert2'

export default {
    name: 'Admins',
      components: {
          BreezeAuthenticatedLayout, BreezeButton,
          CategoriaTable, CategoriaModal
      },
      props: ['categorias'],
      data () {
        return {
          columns : [
            {label: 'Id', name: 'id' },
            {label: 'Nombre', name: 'nombre' },
            {label: 'Activo', name: 'activo'},
            {label: 'Date Added', name: 'created_at'}
          ],
          showModal: false,
          categoria: Object,
          DataTableKey: 0,
          form: this.$inertia.form({
            nombre: '',
            activo: ''
          })
        }
      },
      methods : {
        openModal(){
          this.showModal = true;
        },
        closeModal(){
          this.showModal = false
        },
        submit(){
          Inertia.post(route('categorias.store'), this.form, {
              onSuccess: () => {
                this.forceRerender();
                this.form.nombre = '';
                Swal.fire({
                          position: 'top-end',
                          icon: 'success',
                          showConfirmButton: false,
                          timer: 1500
                          });             
              }
            })
        },
        updated(categoria){
          this.categoria = categoria;
          this.form.nombre = categoria.nombre;
          this.form.activo = categoria.activo;
          this.showModal = true;
        },
        updateCategoria(param){
  
          Inertia.put(route('categorias.update', this.categoria), param, {  
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
        deleted(categoria){
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
                  Inertia.delete(route('categorias.destroy', categoria), {
                    preserveState: true,
                    preserveScroll: true,
                    only: ['categorias'],
                    onSuccess : () => {
                      this.forceRerender();
                      Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1500
                                });
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