<template>
    <breeze-authenticated-layout>
      <template #header>
        
  
  <div class="row">
      <div class="col-8">
        <h2 class="h4 font-weight-bold">
        Gerente Comercial
      </h2>
    </div>
      <div class="col-4">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
          <Link :href="route('admins.create')">
            <button class="btn btn-success me-md-2" type="button">Nuevo</button>
          </Link>
          
        </div>
      </div>
    </div>
    </template>
  
    <div class="card my-4 shadow-sm">
        <div class="card-body">
            <GerenteTable :columns="columns" @updated="updated" @deleted="deleted" :users="admins" />
        </div>
      </div>
  
    </breeze-authenticated-layout>
  
    <gerente-modal v-if="showModal" :form="form" @updateGerente="updateGerente" @closeModal="closeModal" />
  </template>
  
  <script>
  import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
  import GerenteModal from '@/Components/Modals/GerenteModal.vue'
  import { Link } from '@inertiajs/inertia-vue3'
  import { Inertia } from '@inertiajs/inertia'
  
  import Swal from 'sweetalert2';
  
  import GerenteTable from '@/Components/DataTable/GerenteTable.vue'
  
  export default {
      name: 'Admins',
      components: {
          BreezeAuthenticatedLayout,
          GerenteModal,
          Link,
          GerenteTable
      },
      props: ['admins'],
      data () {
        return {
          columns : [
            {label: 'Id', name: 'id' },
            {label: 'Name', name: 'name' },
            {label: 'Email', name: 'email'},
            {label: 'Date Added', name: 'created_at'}
          ],
          users : this.Gerentes,
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
        updateGerente(param){
  
          Inertia.post('/admins', param,{
  
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