<template>
    <!-- Modal -->
    <div
      class="modal fade show"
      id="myModal"
      style="
        display: block;
        background-color: rgba(0, 0, 0, 0.5);
        transform: scale(1);
        transition: transform 0.75s ease-in;
      "
      tabindex="-1"
      aria-labelledby="myModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <form>
            <div class="modal-header">
              <h5 class="modal-title" id="myModalLabel">Gerente</h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
                @click="closeModal"
              ></button>
            </div>
            <div class="modal-body">
  
              <div class="form-group">
                <label for="Nombre">Nombre</label>
                <input
                  v-model="form.name"
                  type="text"
                  class="form-control"
                  id="Nombre"
                  aria-describedby="nombreHelp"
                />
                <small id="nombreHelp" class="form-text text-muted"
                  >Coloque nombre y apellido.</small
                >
              </div>
  
              <div class="form-group">
                <label for="exampleInputEmail1">Correo electrónico</label>
                <input
                  v-model="form.email"
                  type="email"
                  class="form-control"
                  v-bind:class="{ 'is-invalid' : $page.props.errors.email}"
                  id="exampleInputEmail1"
                  aria-describedby="emailHelp"
                />
                <div v-if="$page.props.errors.email" class="text-danger">
                  {{ $page.props.errors.email }}
                </div>
                <small id="emailHelp" class="form-text text-muted"
                  >Con el correo electrónico el asesor puede ingresar al sistema.</small
                >
              </div>
  
              <div class="form-group">
                <label for="exampleInputPassword1">Contraseña</label>
                <input
                  v-model="form.password"
                  type="password"
                  class="form-control"
                  id="exampleInputpassword1"
                  aria-describedby="passwordHelp"
                />
                <div v-if="$page.props.errors.password" class="text-danger">
                  {{ $page.props.errors.password }}
                </div>
                <small id="passwordHelp" class="form-text text-muted"
                  >Constraseña de al menos 8 caracteres.</small
                >
              </div>
  
              <div class="form-group">
                <label for="exampleInputPassword_confirmation1">Contraseña</label>
                <input
                  v-model="form.password_confirmation"
                  type="password"
                  class="form-control"
                  id="exampleInputpassword_confirmation1"
                  aria-describedby="password_confirmationHelp"
                />
                <small id="password_confirmactionHelp" class="form-text text-muted"
                  >Confirme la contraseña.</small
                >
              </div>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary"
                data-bs-dismiss="modal"
                @click="closeModal"
              >
                Cerrar
              </button>
              <button 
                @click.prevent="update(form)"
                type="button" 
                class="btn btn-primary">
                  Guardar cambios
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </template>
      
  <script>
  import BreezeLabel from "@/Components/Label.vue";
  import BrezzeInput from "@/Components/Input.vue";
  import BreezeValidationErrors from "@/Components/ValidationErrors.vue";
  
  export default {
    name: "GerenteModal",
    components: {
      BreezeLabel,
      BrezzeInput,
      BreezeValidationErrors,
    },
    props: {
      form: {
        type: Object,
        default: () => {},
      },
    },
    components: {},
    methods: {
      closeModal() {
        this.$page.props.errors = [];
        this.$emit("closeModal");
      },
      update(form) {
        this.$emit("updateAsesor", form);
      },
    },
  };
  </script>
      
      <style scoped>
  .top-100 {
    top: 100%;
  }
  .bottom-100 {
    bottom: 100%;
  }
  
  .max-h-select {
    max-height: 300px;
  }
  </style>
      