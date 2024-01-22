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
                        <h5 class="modal-title" id="myModalLabel">Categorias</h5>
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
                            <div>
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
                            <div>
                                <div class="form-group">
                                <label for="estado">Estado</label>
                                <select
                                    v-model="form.activo"
                                    class="form-control"
                                    v-bind:class="{ 'is-invalid' : $page.props.errors.activo}"
                                    id="activo"
                                    aria-describedby="activoHelp"
                                >
                                    <option value="S" :selected="form.activo == 'S'">Publicado</option>
                                    <option value="N" :selected="form.activo == 'N'">Despublicado</option>
                                </select>
                                <div v-if="$page.props.errors.activo" class="text-danger">
                                    {{ $page.props.errors.activo }}
                                </div>
                                <small id="activoHelp" class="form-text text-muted"
                                    >Estado de la categoría</small
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
            this.$emit("updateCategoria", form);
        },
    }
}
</script>

<style>

</style>