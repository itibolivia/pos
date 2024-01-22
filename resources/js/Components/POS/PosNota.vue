<template>
  <h4 class="d-flex justify-content-between align-items-center mb-3">
    <button class="btn btn-danger" title="Eliminar" 
    :disabled="form.processing" 
    @click="eliminar(nota)">
    <i class="fa fa-trash"></i></button>
    
    {{ nota.nota }}

    <button class="btn btn-dark" title="Guardar" 
    :disabled="form.processing" @click="guardar()">
    <i class="fa fa-save"></i></button>
  </h4>
  <div class="row">
    <ul class="list-group mb-3">
        <li class="list-group-item d-flex justify-content-between lh-condensed">
            <div>
            <h6 class="my-0">Producto</h6>
            <small class="text-muted"></small>
            </div>
        </li>
        <li v-for="(itemcart,i) in carrito" :key="i"
        class="list-group-item d-flex justify-content-between lh-condensed">
            <div>
            <h6 class="my-0">{{itemcart.nombre}}</h6>
            </div>
                <div>
                    <i class="fa fa-minus-circle"  v-on:click="cambiarCantidad(i,false)"></i>
                    <span class="text-muted"> {{itemcart.cantidad}}</span>
                    <i class="fa fa-plus-circle"  v-on:click="cambiarCantidad(i, true)"></i>
                </div>
            <div>
                <span class="text-muted"> {{convertMoney(itemcart.cantidad * itemcart.precio)}}</span>
            </div>
            <i class="fa fa-trash"  v-on:click="deleteItem(i)"></i>

        </li>
        <li class="list-group-item d-flex justify-content-between">
            <span>Total (PESOS)</span>
            <strong> {{onViewTotal()}}</strong>
        </li>
        `
        <button class="btn btn-block btn-success" :disabled="!nota || !carrito.length" @click="pagar()">PAGAR</button>`
    </ul>
  </div>
</template>

<script>
export default {
 name: 'PosNota',
 emits: ["detalleNota", "eliminarNota", "pagar"],
 props: ['nota', 'carrito'],
 data() {
    return {
        form: this.$inertia.form({
            id: '',
            fecha: '',
            factura: '',
            recibo: ''
        })
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

    onViewTotal(){
        let total = 0;
        this.carrito.map((data)=>{
            total = total + (data.cantidad * data.precio);
        })

        return this.convertMoney(total);
    },

    cambiarCantidad(i,type){

        const dataCar = this.carrito;

        let cantd = dataCar[i].cantidad;

        if (type) {
        cantd = cantd + 1
        }
        else if (type==false&&cantd>=1) {
        cantd = cantd - 1
        }

        if ((type==false&&cantd>=1)||type) {
        dataCar[i].cantidad = cantd
            this.carrito
        }
    },

    deleteItem(i){
        this.carrito.splice(i,1)
    },

    eliminar(nota){
        this.$emit("eliminarNota", nota);
    },
    guardar(){
        this.$emit("detalleNota", this.carrito);
    },
    pagar(){
        this.$emit("pagar", this.carrito);
    }
 }
}
</script>

<style>

</style>