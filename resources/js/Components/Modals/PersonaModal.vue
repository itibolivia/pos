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
                        <h5 class="modal-title" id="myModalLabel">Persona</h5>
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
                                <label for="carnet">
                                    <span class="text-danger"> (*) </span>
                                    Nro. de Carnet
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text" 
                                    id="inputGroupPrepend2">#</span>
                                    </div>
                                    <input
                                    v-model="form.carnet"
                                    type="number"
                                    class="form-control"
                                    v-bind:class="{ 'is-invalid' : $page.props.errors.carnet}"
                                    id="carnet"
                                    aria-describedby="carnetHelp"
                                />
                                </div>
                                <div v-if="$page.props.errors.carnet" class="text-danger">
                                    {{ $page.props.errors.carnet }}
                                </div>
                                <small id="carnetHelp" class="form-text text-muted"
                                    >Coloque sólo el número de CI</small
                                >
                                </div>
                            </div>
                            <div class="col-md-8 mb-3">
                                <div class="form-group">
                                <label for="nombre">
                                    <span class="text-danger"> (*) </span>
                                    Nombre completo
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
                                    >Nombre completo de la persona para prospecto</small
                                >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                <label for="telefono">Teléfono</label>
                                <input
                                    v-model="form.telefono"
                                    type="number"
                                    class="form-control"
                                    v-bind:class="{ 'is-invalid' : $page.props.errors.telefono}"
                                    id="telefono"
                                    aria-describedby="telefonoHelp"
                                />
                                <div v-if="$page.props.errors.telefono" class="text-danger">
                                    {{ $page.props.errors.telefono }}
                                </div>
                                <small id="telefonoHelp" class="form-text text-muted"
                                    >Número de teléfono</small
                                >
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                <label for="correo">Correo electrónico</label>
                                <input
                                    v-model="form.correo"
                                    type="email"
                                    class="form-control"
                                    v-bind:class="{ 'is-invalid' : $page.props.errors.correo}"
                                    id="correo"
                                    aria-describedby="correoHelp"
                                />
                                <div v-if="$page.props.errors.correo" class="text-danger">
                                    {{ $page.props.errors.correo }}
                                </div>
                                <small id="correoHelp" class="form-text text-muted"
                                    >Personal</small
                                >
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                <label for="direccion">Dirección</label>
                                <input
                                    v-model="form.direccion"
                                    type="text"
                                    class="form-control"
                                    v-bind:class="{ 'is-invalid' : $page.props.errors.direccion}"
                                    id="direccion"
                                    aria-describedby="direccionHelp"
                                />
                                <div v-if="$page.props.errors.direccion" class="text-danger">
                                    {{ $page.props.errors.direccion }}
                                </div>
                                <small id="direccionHelp" class="form-text text-muted"
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
    name: 'PersonaModal',
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
            this.$emit("updatePersona", form);
        },
    }
}
</script>

<style>

</style>