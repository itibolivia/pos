<template>
    <breeze-authenticated-layout>
        <template #header>
            <h2 class="h4 font-weight-bold">
                Modificar compra
            </h2>
        </template>

        <div class="row justify-content-center">
            <div class="card shadow-sm px-3">
                <div class="card-body">
                    <form @submit.prevent="submit">
                        <div class="row">

                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                <label for="fecha">
                                    <span class="text-danger"> (*) </span>
                                    Fecha</label>
                                <input
                                    v-model="form.fecha"
                                    type="date"
                                    class="form-control"
                                    v-bind:class="{ 'is-invalid' : $page.props.errors.fecha}"
                                    id="fecha"
                                    aria-describedby="fechaHelp"
                                />
                                <div v-if="$page.props.errors.fecha" class="text-danger">
                                    {{ $page.props.errors.fecha }}
                                </div>
                                <small id="fechaHelp" class="form-text text-muted"
                                    >Fecha de compra</small
                                >
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                <label for="factura">
                                    Factura
                                </label>
                                <input
                                    v-model="form.factura"
                                    type="text"
                                    class="form-control"
                                    v-bind:class="{ 'is-invalid' : $page.props.errors.factura}"
                                    id="factura"
                                    aria-describedby="facturaHelp"
                                />
                                <div v-if="$page.props.errors.factura" class="text-danger">
                                    {{ $page.props.errors.factura }}
                                </div>
                                <small id="facturaHelp" class="form-text text-muted"
                                    >Coloque el nro de factura</small
                                >
                                </div>
                            </div>
                            <div class="col-md-5 mb-3">
                                <div class="form-group">
                                <label for="recibo">
                                    Recibo
                                </label>
                                <input
                                    v-model="form.recibo"
                                    type="text"
                                    class="form-control"
                                    v-bind:class="{ 'is-invalid' : $page.props.errors.recibo}"
                                    id="recibo"
                                    aria-describedby="reciboHelp"
                                />
                                <div v-if="$page.props.errors.recibo" class="text-danger">
                                    {{ $page.props.errors.recibo }}
                                </div>
                                <small id="reciboHelp" class="form-text text-muted"
                                    >Coloque el nro de recibo</small>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">

                            <form @submit.prevent="addCart(this)">

                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="producto">
                                            Producto
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-2 mb-3">
                                    <div class="form-group">
                                        <label for="cantidad">
                                            Cantidad
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-2 mb-3">
                                    <div class="form-group">
                                        <label for="precio">
                                            Precio
                                        </label>
                                    </div>
                                </div>

                                </div>

                                <div class="row" style="margin-top: -15px">
                                    <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <select
                                            v-model="proform.producto_id"
                                            class="form-select"
                                            v-bind:class="{ 'is-invalid' : $page.props.errors.producto_id}"
                                            id="producto_id"
                                            aria-describedby="producto_idHelp"
                                            @change="cambiaProducto()"
                                        >
                                            <option v-for="producto in productos"  :key="producto.id"
                                            v-bind:value="{ id: producto.id, text: producto.nombre }">
                                                {{ producto.nombre }}
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2 mb-3">
                                    <div class="form-group">
                                        <input
                                            v-model="proform.cantidad"
                                            type="text"
                                            class="form-control"
                                            v-bind:class="{ 'is-invalid' : $page.props.errors.cantidad}"
                                            id="cantidad"
                                            aria-describedby="cantidadHelp"
                                        />
                                    </div>
                                </div>

                                <div class="col-md-2 mb-3">
                                    <div class="form-group">
                                        <input
                                            v-model="proform.precio"
                                            type="text"
                                            class="form-control"
                                            v-bind:class="{ 'is-invalid' : $page.props.errors.precio}"
                                            id="precio"
                                            aria-describedby="precioHelp"
                                        />
                                    </div>
                                </div>

                                <div class="col-md-2 mb-3">
                                    <div class="form-group">
                                        <button type="submit" 
                                        class="btn btn-success">
                                        Agregar 
                                        </button>
                                    </div>
                                </div>
                                </div>
                            
                            </form>
                            
                        </div>

                        <div v-if="form.errors.pro" class="text-sm text-danger">
                            {{ form.errors.pro }}
                        </div>

                        <div class="row">
                            <table class="table table-striped">
                        <thead>
                            <tr>
                                <th
                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-gray-100 border-b border-gray-200">
                                    PRODUCTO
                                </th>
                                <th
                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-gray-100 border-b border-gray-200">
                                    CANTIDAD
                                </th>
                                <th
                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-gray-100 border-b border-gray-200">
                                    PRECIO
                                </th>
                                <th
                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-gray-100 border-b border-gray-200">
                                    SubTOTAL
                                </th>
                                <th>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(itemcart,i) in listCompra.pro" :key="i">
                            <td>
                                {{itemcart.producto}}
                            </td>
                            <td>
                                {{itemcart.cantidad}}
                            </td>
                            <td>
                                {{convertMoney(itemcart.precio)}}
                            </td>
                            <td>
                                {{convertMoney(itemcart.cantidad * itemcart.precio)}}
                            </td>
                            <td>
                                <i class="fa fa-trash"  v-on:click="deleteItem(i)"></i>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>
                            </td>
                            <td>
                            </td>
                            <td>
                                TOTAL
                            </td>
                            <td>
                                {{onViewTotal()}}
                            </td>
                            <td>
                            </td>
                        </tr>
                    </tfoot>
                </table>
                        </div>

                        <div class="mb-0">
                            <div class="d-flex justify-content-end align-items-baseline">

                                <breeze-button class="ms-4" :class="{ 'text-white-50': form.processing }" :disabled="form.processing"> <!--:disabled="form.processing"-->
                                <div v-show="form.processing" class="spinner-border spinner-border-sm" role="status">
                                    <span class="visually-hidden">Cargando...</span>
                                </div>
                                
                                Modificar
                                </breeze-button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </breeze-authenticated-layout>
  
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import BreezeButton from '@/Components/Button.vue'

import Swal from 'sweetalert2'

export default {
    name: 'UpdateProducto',
    components: {
        BreezeAuthenticatedLayout,
        BreezeButton,
    },
    props : ['productos', 'compra', 'detalles'],
    data () {
        return {
            form: this.$inertia.form({
                id: this.compra.id,
                fecha: this.compra.fecha,
                factura: this.compra.factura,
                recibo: this.compra.recibo
            }),
            proform : this.$inertia.form({
                producto_id : 0,
                cantidad: 0,
                precio: 0
            }),
            listCompra : {
                pro : []
            }
        }
    },

    created() {
        let current = new Date(this.form.fecha);
        let date = `${current.getFullYear()}-${('0' + (current.getMonth()+1)).slice(-2)}-${('0' + current.getDate()).slice(-2)}`;
        this.form.fecha = date;

        this.detalles.map((detalle)=>{
            let itemcar = {
                id : detalle.producto.id,
                producto : detalle.producto.nombre,
                cantidad: detalle.cantidad,
                precio: detalle.precio
            }
            this.listCompra.pro.push(itemcar);
        })
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

        onViewTotal() {
            let total = 0;
            this.listCompra.pro.map((data)=>{
                total = total + (data.cantidad * data.precio);
            });
            return this.convertMoney(total);
        },

        swalMessage(message) {
            Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: message,
                    showConfirmButton: false,
                    timer: 1500
                })
        },

        cambiaProducto()  {
            axios.get(route('precios', this.proform.producto_id.id))
                    .then(res => {
                        this.proform.precio = res.data;
                    })
                    .catch(error => console.log(error))
        },

        isExist(id) {
    
            for(var i=0; i < this.listCompra.pro.length; i++){
                if( this.listCompra.pro[i].id == id){
                return true
                }
            }
            return false
        },

        addCart() {

            if(!this.proform.producto_id.id){
                this.swalMessage('Elija un producto!')
            } else if (this.proform.cantidad == '' && this.proform.cantidad == 0) {
                this.swalMessage('Coloque cantidad!')
            } else if (this.proform.precio == '' && this.proform.precio == 0){
                this.swalMessage('Coloque precio!')        
            } else {
                let exist = this.isExist(this.proform.producto_id.id);

                if(exist){
                    this.swalMessage('El producto existe!')
                } else {
                        const itemcar = {
                            id : this.proform.producto_id.id,
                            producto : this.proform.producto_id.text,
                            cantidad: this.proform.cantidad,
                            precio: this.proform.precio
                        }
                        this.listCompra.pro.push(itemcar);
                        this.proform.reset();
                    }
            }
        },

        deleteItem(i) {
            this.listCompra.pro.splice(i,1)
        },

        submit() {

            this.form.put(this.route('compras.update', [this.compra, this.listCompra]),{
            onSuccess: () => {

                Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500
                        });
            }
            })
        }
    }

}
</script>

<style>

</style>