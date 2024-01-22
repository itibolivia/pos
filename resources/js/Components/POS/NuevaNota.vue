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
              <h5 class="modal-title" id="myModalLabel">Nueva Nota</h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
                @click="closeNota"
              ></button>
            </div>
            <div class="modal-body">
  
              <div class="form-group">
                <label for="nota">Nota</label>
                <input
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
                <small id="notaHelp" class="form-text text-muted"
                  >Coloque nombre de Nota.</small
                >
              </div>
  
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary"
                data-bs-dismiss="modal"
                @click="closeNota"
              >
                Cerrar
              </button>
              <button 
                @click.prevent="guardar(form)"
                type="button" 
                class="btn btn-primary">
                  Nueva
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
    name: "NuevaNota",
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
    methods: {
      closeNota() {
        this.$page.props.errors = [];
        this.$emit("closeNota");
      },
      guardar(form) {
        this.$emit("guardarNota", form);
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
      