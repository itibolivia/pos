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
              <h5 class="modal-title" id="myModalLabel">Adjuntar</h5>
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
                                <label for="adjunto">
                                    Adjunto
                                </label>
                                <div class="input-group">
                                    <input
                                    v-model="form.adjunto"
                                    type="text"
                                    class="form-control"
                                    v-bind:class="{ 'is-invalid' : $page.props.errors.adjunto}"
                                    id="adjunto"
                                    aria-describedby="adjuntoHelp"
                                />
                                </div>
                                <div v-if="$page.props.errors.adjunto" class="text-danger">
                                    {{ $page.props.errors.adjunto }}
                                </div>
                                <small id="adjuntoHelp" class="form-text text-muted"
                                    >Nombre adjunto.</small
                                >
                                </div>

                                <div class="form-group">
                                <label for="adjunto">
                                    Archivo
                                </label>
                                <div class="input-group">
                                    <input
                                    v-on:change="onFileChange"
                                    type="file"
                                    class="form-control"
                                    v-bind:class="{ 'is-invalid' : $page.props.errors.adjunto}"
                                    id="adjunto"
                                    aria-describedby="adjuntoHelp"
                                />
                                </div>
                                <div v-if="$page.props.errors.adjunto" class="text-danger">
                                    {{ $page.props.errors.adjunto }}
                                </div>
                                <small id="adjuntoHelp" class="form-text text-muted"
                                    >Todos los archivos deben ser PDF.</small
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
                @click.prevent="adjuntar(form)"
                type="button" 
                class="btn btn-primary">
                  Adjuntar
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
    name: "Cartas",
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
        onFileChange(e){
            this.form.archivo = e.target.files[0];
        },
      closeModal() {
        this.$page.props.errors = [];
        this.$emit("closeModal");
      },
      adjuntar(form) {
        this.$emit("adjuntar", form);
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
      