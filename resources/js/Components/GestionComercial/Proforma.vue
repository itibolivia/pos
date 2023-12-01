<template>
    <div class="row justify-content-center">
              <div class="card shadow-sm px-3">
                  <div class="card-body">
                          <div class="row">
                              <div class="col-8">
                                  <label for="adjunto">
                                      <span class="text-danger"> (*) </span>
                                      Proformas
                                  </label>
                              </div>
                              <div class="col-4">
                                  <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                      <button class="btn btn-success me-md-2" type="button"
                                      @click="showModal = true" ><!--:disabled="venta.proforma != null"-->
                                          <i class="fa fa-plus" style="color:white"></i>
                                      </button>
                                  </div>
                              </div>
                              
                          </div>
  
                          <div class="row">
                              <span>{{ venta.proforma }}</span>
                              <table v-show="proformas">
                                  <thead>
                                      <th>Nombre</th>
                                      <th>Adjunto</th>
                                      <th></th>
                                  </thead>
                                  <tbody>
                                      <tr v-for="(proforma, doc) in proformas" :key="doc">
                                          <td>{{ proforma.adjunto }}</td>
                                          <td>
                                              <a :href="proforma.ruta_proforma" target="_blank">
                                                  {{ proforma.archivo }}
                                              </a>
                                          </td>
                                          <td>
                                              <button class="btn btn-sm btn-danger" @click="deleted(proforma)">
                                              <!--:disabled="venta.proforma != null"-->
                                                  <i class="fa fa-trash" style="color:white"></i>
                                              </button>
                                          </td>
                                      </tr>
                                  </tbody>
                              </table>
                          </div>
     
                      <form @submit.prevent="submit">
                          <div class="row mb-3">
  
                              <div class="form-group">
                              <label for="nota">Nota</label>
                              <textarea
                                  v-model="form.nota"
                                  type="text"
                                  class="form-control"
                                  v-bind:class="{ 'is-invalid' : $page.props.errors.nota}"
                                  id="nota"
                                  aria-describedby="notaHelp"
                              />
                              <div v-if="$page.props.errors.nota" class="text-danger">
                                  {{ $page.props.errors.nota }}
                              </div>
                              </div>
                          </div>
                          
  
                          <div class="mb-0">
                              <div class="d-flex justify-content-end align-items-baseline">
  
                                  <breeze-button class="ms-4" :class="{ 'text-white-50': form.processing }" 
                                  :disabled="proformas.length === 0 || form.processing"> <!--:disabled="venta.proforma != null || "-->
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
  
          <Proformas v-if="showModal" :form="formArchivo" @adjuntar="adjuntar" @closeModal="closeModal" />
  
  </template>
  
  <script>
  import BreezeButton from '@/Components/Button.vue'
  import Proformas from '@/Components/GestionModals/Proformas.vue'
  import { Inertia } from '@inertiajs/inertia'
  import Swal from 'sweetalert2';
  
  export default {
      name: 'Proforma',
      components: {
          BreezeButton,
          Proformas
      },
      props: ['venta', 'proformas'],
      data () {
          return {
              showModal: false,
              form: this.$inertia.form({
                  venta: this.venta.id,
                  nota: this.venta.nota_proforma
              }),
              formArchivo: this.$inertia.form({
                  venta: this.venta.id,
                  adjunto: '',
                  archivo: '',
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
          adjuntar(form) {
              Inertia.post(this.route('proformas.store'), form, {
                  onFinish: () => {
                      this.closeModal();
                      Swal.fire({
                          position: 'top-end',
                          icon: 'success',
                          showConfirmButton: false,
                          timer: 1500
                          });
  
              }
              })
          },
          deleted(documento) {
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
                      this.formArchivo.delete(route('proformas.destroy',documento));
                      Swal.fire({
                          position: 'top-end',
                          icon: 'success',
                          showConfirmButton: false,
                          timer: 1500
                          });
                  }    
              })
          },
          submit() {
              this.form.post(this.route('proforma'), this.form, {
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