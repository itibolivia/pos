<template>
  <breeze-authenticated-layout>
    <template #header>
      

<div class="row">
    <div class="col-8">
      <h2 class="h4 font-weight-bold">
      Asesor Comercial
    </h2>
  </div>
    <div class="col-4">
      <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <Link :href="route('usuarios.create')">
          <button class="btn btn-success me-md-2" type="button">Nuevo</button>
        </Link>
        
      </div>
    </div>
  </div>
  </template>

  <div class="card my-4 shadow-sm">
      <div class="card-body">
          <AsesorTable :columns="columns" @updated="updated" @deleted="deleted" :users="usuarios" />
      </div>
    </div>

  </breeze-authenticated-layout>

  <asesor-modal v-if="showModal" :form="form" @updateAsesor="updateAsesor" @closeModal="closeModal" />
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import AsesorModal from '@/Components/Modals/AsesorModal.vue'
import { Link } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia'

import Swal from 'sweetalert2';

import AsesorTable from '@/Components/DataTable/AsesorTable.vue'

export default {
    name: 'Usuarios',
    components: {
        BreezeAuthenticatedLayout,
        AsesorModal,
        Link,
        AsesorTable
    },
    props: ['usuarios'],
    data () {
      return {
        columns : [
          {label: 'Id', name: 'id' },
          {label: 'Name', name: 'name' },
          {label: 'Email', name: 'email'},
          {label: 'Date Added', name: 'created_at'}
        ],
        users : this.usuarios,
        showModal: false,
        form: this.$inertia.form({
          name: '',
          email: '',
          password: '',
          password_confirmation: '',
          terms: false,
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
      updated(user){
        this.form.name = user.name;
        this.form.email = user.email;
        this.showModal = true;
      },
      updateAsesor(param){

        Inertia.post('/usuarios', param,{

          method: 'put',

          onSuccess: (page) => {
            this.closeModal();
          }

        });
      },
      deleted(id){
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
                //form.delete(route('categorie.destroy',id));
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