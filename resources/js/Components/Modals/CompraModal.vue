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
                        <h5 class="modal-title" id="myModalLabel">Compra</h5>
                        <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                        @click="closeModal"
                        ></button>
                    </div>
                    <div class="modal-body">

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
    name: 'CompraModal',
    props: {
        form: {
            type: Object,
            default: () => {},
            },
        categorias: Object,
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