<template>
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
    aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Fuentes</h5>
                        <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                        @click="closeModal"
                        ></button>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                <label for="sigla">
                                    <span class="text-danger"> (*) </span>
                                    Sigla
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text" 
                                    id="inputGroupPrepend2">#</span>
                                    </div>
                                    <input
                                    v-model="form.sigla"
                                    type="text"
                                    class="form-control"
                                    v-bind:class="{ 'is-invalid' : $page.props.errors.sigla}"
                                    id="sigla"
                                    aria-describedby="siglaHelp"
                                />
                                </div>
                                <div v-if="$page.props.errors.sigla" class="text-danger">
                                    {{ $page.props.errors.sigla }}
                                </div>
                                <small id="siglaHelp" class="form-text text-muted"
                                    >Coloque una sigla para el origen</small
                                >
                                </div>
                            </div>
                            <div class="col-md-8 mb-3">
                                <div class="form-group">
                                <label for="nombre">
                                    <span class="text-danger"> (*) </span>
                                    Nombre
                                </label>
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
                                    >Nombre del origen para el propspecto</small
                                >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                <label for="estado">Estado</label>
                                <select
                                    v-model="form.estado"
                                    class="form-control"
                                    v-bind:class="{ 'is-invalid' : $page.props.errors.estado}"
                                    id="estado"
                                    aria-describedby="estadoHelp"
                                >
                                    <option value="Publicado">Publicado</option>
                                    <option value="Despublicado">Despublicado</option>
                                </select>
                                <div v-if="$page.props.errors.estado" class="text-danger">
                                    {{ $page.props.errors.estado }}
                                </div>
                                <small id="estadoHelp" class="form-text text-muted"
                                    >Estado del origen</small
                                >
                                </div>
                            </div>
                            
                            <div class="col-md-9 mb-3">
                                <div class="form-group">
                                <label for="descripcion">Descripción</label>
                                <input
                                    v-model="form.descripcion"
                                    type="text"
                                    class="form-control"
                                    v-bind:class="{ 'is-invalid' : $page.props.errors.descripcion}"
                                    id="descripcion"
                                    aria-describedby="descripcionHelp"
                                />
                                <div v-if="$page.props.errors.descripcion" class="text-danger">
                                    {{ $page.props.errors.descripcion }}
                                </div>
                                <small id="descripcionHelp" class="form-text text-muted"
                                    >Dirección personal</small
                                >
                                </div>
                            </div>
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
export default {
    name: 'FuenteModal',
    props: {
        form: {
            type: Object,
            default: () => {},
            },
    },
    methods: {
        closeModal() {
            this.$page.props.errors = [];
            this.$emit("closeModal");
        },
        update(form) {
            this.$emit("updateFuente", form);
        },
    }
}
</script>

<style>

</style>