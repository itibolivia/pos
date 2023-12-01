<template>
    <div class="row justify-content-center">
              <div class="card shadow-sm px-3">
                  <div class="card-body">
                          <div class="row">
                              <div class="col-8">
                                  <label for="adjunto">
                                      <span class="text-danger"> (*) </span>
                                      Documentos
                                  </label>
                              </div>
                              <div class="col-4">
                                  <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                      <button class="btn btn-success me-md-2" type="button"
                                      @click="showModal = true" ><!--:disabled="venta.documento != null"-->
                                          <i class="fa fa-plus" style="color:white"></i>
                                      </button>
                                  </div>
                              </div>
                              
                          </div>
  
                          <div class="row">
                              <span>{{ venta.pago }}</span>
                              <table v-show="pagos">
                                  <thead>
                                      <th>Nombre</th>
                                      <th>Adjunto</th>
                                      <th></th>
                                  </thead>
                                  <tbody>
                                      <tr v-for="(pago, doc) in pagos" :key="doc">
                                          <td>{{ pago.adjunto }}</td>
                                          <td>
                                              <a :href="pago.ruta_pago" target="_blank">
                                                  {{ pago.archivo }}
                                              </a>
                                          </td>
                                          <td>
                                              <button class="btn btn-sm btn-danger" @click="deleted(pago)">
                                              <!--:disabled="venta.pago != null"-->
                                                  <i class="fa fa-trash" style="color:white"></i>
                                              </button>
                                          </td>
                                      </tr>
                                  </tbody>
                              </table>
                          </div>
     
                      <form @submit.prevent="submit">

                          <div class="row mb-3">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="tipo">Tipo</label>
                                    <select
                                        v-model="form.tipo_pago"
                                        class="form-select"
                                        id="tipo_pago"
                                        aria-describedby="tipo_pagoHelp"
                                    >
                                        <option value="credito">Crédito</option>
                                        <option value="contado">Contado</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="banco">Banco</label>
                                    <input 
                                        v-model="form.banco"
                                        type="text"
                                        class="form-control"
                                        id="banco"
                                        aria-describedby="bancoHelp"
                                    />
                                </div>
                            </div>
                          </div>

                          <div class="row mb-3">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="ejecutivo">Ejecutivo</label>
                                    <input 
                                        v-model="form.ejecutivo"
                                        type="text"
                                        class="form-control"
                                        id="ejecutivo"
                                        aria-describedby="ejecutivoHelp"
                                    />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="telefono">Teléfono</label>
                                    <input 
                                        v-model="form.telefono"
                                        type="number"
                                        class="form-control"
                                        id="telefono"
                                        aria-describedby="telefonoHelp"
                                    />
                                </div>
                            </div>
                          </div>

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
                                  :disabled="pagos.length === 0 || form.processing"> <!--:disabled="venta.pago != null || "-->
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
  
          <Pagos v-if="showModal" :form="formArchivo" @adjuntar="adjuntar" @closeModal="closeModal" />
  
  </template>
  
  <script>
  import BreezeButton from '@/Components/Button.vue'
  import Pagos from '@/Components/GestionModals/Pagos.vue'
  import { Inertia } from '@inertiajs/inertia'
  import Swal from 'sweetalert2';
  
  export default {
      name: 'Pago',
      components: {
          BreezeButton,
          Pagos
      },
      props: ['venta', 'pagos'],
      data () {
          return {
              showModal: false,
              form: this.$inertia.form({
                  venta: this.venta.id,
                  tipo_pago: this.venta.tipo_pago,
                  banco: this.venta.banco,
                  ejecutivo: this.venta.ejecutivo,
                  telefono: this.venta.telefono,
                  nota: this.venta.nota_pago
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
              Inertia.post(this.route('pagos.store'), form, {
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
                      this.formArchivo.delete(route('pagos.destroy',documento));
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
              this.form.post(this.route('pago'), this.form, {
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