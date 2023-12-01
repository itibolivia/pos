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
                                <label for="codigo">
                                    <span class="text-danger"> (*) </span>
                                    Código
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text" 
                                    id="inputGroupPrepend2">#</span>
                                    </div>
                                    <input
                                    v-model="form.codigo"
                                    type="text"
                                    class="form-control"
                                    v-bind:class="{ 'is-invalid' : $page.props.errors.codigo}"
                                    id="codigo"
                                    aria-describedby="codigoHelp"
                                />
                                </div>
                                <div v-if="$page.props.errors.codigo" class="text-danger">
                                    {{ $page.props.errors.codigo }}
                                </div>
                                <small id="codigoHelp" class="form-text text-muted"
                                    >Coloque un código para el producto</small
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
                                    >Nombre completo de la persona para prospecto</small
                                >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                <label for="precio">Precio</label>
                                <input
                                    v-model="form.precio"
                                    type="number"
                                    class="form-control"
                                    v-bind:class="{ 'is-invalid' : $page.props.errors.precio}"
                                    id="precio"
                                    aria-describedby="precioHelp"
                                />
                                <div v-if="$page.props.errors.precio" class="text-danger">
                                    {{ $page.props.errors.precio }}
                                </div>
                                <small id="precioHelp" class="form-text text-muted"
                                    >Precio del producto</small
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
    name: 'ProductoModal',
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
            this.$emit("updateProducto", form);
        },
    }
}
</script>

<style>

</style>