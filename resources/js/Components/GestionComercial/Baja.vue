<template>
    <div class="row justify-content-center">
              <div class="card shadow-sm px-3">
                  <div class="card-body">
                      <form @submit.prevent="submit">
                          <div class="row mb-3">
  
                              <div class="form-group">
                              <label for="nota">Dar de Baja</label>
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
  
  export default {
      name: 'Baja',
      components: {
          BreezeButton
      },
      props: ['venta'],
      data () {
          return {
              form: this.$inertia.form({
                  venta: this.venta.id,
                  nota: this.venta.nota_test
              })
          }
      },
      methods: {
          onFileChange(e){
              this.form.adjunto = e.target.files[0];
          },
          submit() {
          this.form.post(this.route('baja'), this.form, {
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