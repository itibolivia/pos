<template>
  <h4 class="mb-3">Productos</h4>
    <button type="button" class="btn btn-light" v-for="categoria in categorias" :key="categoria.id"
    v-on:click="seleccionada=categoria.id">{{categoria.nombre}}</button>
    <hr>

    <div class="row">
        <div class="card col-md-4" v-show="producto.categoria_id==seleccionada||seleccionada==0"
        style="padding:0px;" v-for="producto in productos" :key="producto.id">
            <img alt="" v-if="producto.imagen" :src="producto.ruta" width="100" />
            <div class="card-body">
            <h5 class="card-title">{{producto.nombre}}</h5>
            <p class="card-text">{{producto.descripcion}}</p>
            <button class="btn btn-success" @click="agregarProducto(producto)">{{convertMoney(producto.precio)}}</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "PosProductos",
    emits: ["agregarProducto"],
    props: ['categorias', 'productos'],
    created() {
        this.seleccionada =  this.categorias[0].id;
    },
    data() {
        return {
            seleccionada:0
        };
    },
    methods: {
        convertMoney(value){

        const formatterPeso = new Intl.NumberFormat('es-BO', {
        style: 'currency',
        currency: 'BOB',
        minimumFractionDigits: 1
        })
        let valueFinal = formatterPeso.format(value);


        return valueFinal

        },

        agregarProducto(producto){
            this.$emit("agregarProducto", producto);
        }
    }
}
</script>

<style>

</style>