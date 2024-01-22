<template>
  <breeze-authenticated-layout>
    <template #header>
      <div class="row d-flex align-items-baseline">
        <div class="col-md-3 float-end">
          <button class="btn btn-light text-capitalize border-0" data-mdb-ripple-color="dark"
          v-if="estado_caja == '' " @click="abrirCaja()">
            <i class="fas fa-print text-primary"></i> Abrir Caja</button>
          <a class="btn btn-light text-capitalize" data-mdb-ripple-color="dark"
          v-if="estado_caja == 'abrir' ">
            <i class="far fa-file-pdf text-danger"></i> Cerrar Caja</a>
        </div>
        <div class="col-md-3 float-end">
          <button class="btn btn-light text-capitalize border-0" data-mdb-ripple-color="dark"
          v-if="estado_caja == 'abrir' " @click="abrirNota()">
            <i class="fas fa-print text-success"></i> Nueva Nota</button>
        </div>
        <hr>
      </div>
    </template>

    <div class="container p-3">
      <div class="row mt-1">
          <div v-for="nota in notas" :key="nota.id" class="col-md-1">
            <button v-if="notaActiva.id==nota.id" class="btn btn-success btn-circle btn-xl">
                 {{ nota.nota }}</button>
            <button v-if="notaActiva.id!=nota.id" class="btn btn-secondary btn-circle btn-xl"
            @click="cambiarNota(nota)">
                {{ nota.nota }}</button>
        </div>

        <div class="row mt-1">
          <div class="col-md-7 order-md-1">
            <pos-productos :categorias="categorias" :productos="productos" @agregarProducto="agregarProducto"/>
          </div>
          <div v-if="notaActiva.id != 0" class="col-md-5 order-md-2 mb-4">
            <pos-nota :nota="notaActiva" :carrito="carrito" @pagar="pagar"
             @detalleNota="detalleNota" @eliminarNota="eliminarNota"/>
          </div>
          
        </div>

        
      </div>


    </div>
  </breeze-authenticated-layout>

  <abrir-caja v-if="showAbrir" :form="formAbrir" @guardarAbrir="guardarAbrir" @closeAbrir="closeAbrir" />

  <nueva-nota v-if="showNota" :form="formNota" @guardarNota="guardarNota" @closeNota="closeNota" />

  <pagar-nota v-if="showPagar" :nota="notaActiva" :carrito="carrito" 
  :form="formPagar" @pagarNota="pagarNota" @closePagar="closePagar"/>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import AbrirCaja from '@/Components/POS/AbrirCaja.vue'
import NuevaNota from '@/Components/POS/NuevaNota.vue'
import PosProductos from '@/Components/POS/PosProductos.vue'
import PosNota from '@/Components/POS/PosNota.vue'
import PagarNota from '@/Components/POS/PagarNota.vue'
import { Inertia } from '@inertiajs/inertia'
import Swal from 'sweetalert2'

export default {
    name: 'Pos',
    components: {
        BreezeAuthenticatedLayout,
        AbrirCaja, NuevaNota, PosProductos, PosNota, PagarNota
    },
    props: [
      'id_caja','estado_caja','notas','categorias','productos'
    ],
    data() {
      return {
        showAbrir: false,
        showNota: false,
        showPagar: false,
        notaActiva: 0,
        formAbrir: this.$inertia.form({
          estado:'',
          monto: ''
        }),
        formNota: this.$inertia.form({
          fecha:'',
          nota: ''
        }),
        formPagar: this.$inertia.form({
          nota: '',
          pro: [],
          fecha:'',
          entrega: '',
          numero: '',
          nit: '',
          nombre: '',
          tipo: '',
          pago: '',
          cambio: 0
        }),
        formCarrito: this.$inertia.form({
          nota: '',
          pro: []
        }),
        carrito: []
      }

    },
    methods: {
      abrirCaja(){
          this.formAbrir.estado = 'abrir';
          this.showAbrir = true;
      },
      closeAbrir(){
        this.showAbrir = false;
      },
      guardarAbrir(){
        Inertia.post(route('cajas.store'), this.formAbrir, {
          onSuccess: () => {
            this.formAbrir.monto = '';
            this.closeAbrir();
            Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      showConfirmButton: false,
                      timer: 1500
                      });             
          }
        })
      },

      abrirNota(){
          this.showNota = true;
      },
      closeNota(){
        this.showNota = false;
      },
      closePagar(){
        this.showPagar = false;
      },

      guardarNota(){
        Inertia.post(route('notas.store'), this.formNota, {
          onSuccess: () => {
            this.formNota.nota = '';
            this.closeNota();
            Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      showConfirmButton: false,
                      timer: 1500
                      });             
          }
        })
      },

      isExist(id){
    
          for(var i=0; i < this.carrito.length; i++){
              if( this.carrito[i].productoid == id){
                return true
              }
            }
            return false
      },

      agregarProducto(producto){
        
        if(this.notaActiva==0){
          Swal.fire({
              position: 'top-end',
              icon: 'error',
              text: 'No tiene nota seleccionada!',
              showConfirmButton: false,
              timer: 1500
              }); 
        } else {

          let exist = this.isExist(producto.id);

          if(exist){
            Swal.fire({
              position: 'top-end',
              icon: 'error',
              text: 'El producto ya existe!',
              showConfirmButton: false,
              timer: 1500
              });

          } else {
              const itemcar = {
                id: 0,
                productoid : producto.id,
                nombre : producto.nombre,
                categoria: producto.categoria_id,
                cantidad: 1,
                nota: this.notaActiva.id,
                precio: producto.precio
              }
              this.carrito.push(itemcar);

          }
        }
      },

      cambiarNota(nota){
        this.notaActiva=nota;
        this.carrito=[];

        axios.get(route('carrito', this.notaActiva.id))
              .then(res => {
                  this.carrito = res.data;
              })
              .catch(error => console.log(error));
      },

      eliminarNota(nota){        

        let swalWithBootstrapButtons = Swal.mixin({
                buttonsStyling : true
            })
            swalWithBootstrapButtons.fire({
                title:'Seguro que desea eliminar?',
                text:'se perderá la información',
                icon:'question',
                showCancelButton:true,
                confirmButtonText:'<i class="fa fa-solid fa-check"></i> si, eliminar',
                cancelButtonText:'<i class="fa fa-solid fa-ban"></i> cancelar'
            }).then((result)=> {
                if(result.isConfirmed){
                  Inertia.delete(route('notas.destroy', nota.id),{
                    onSuccess: page => {

                      this.notaActiva=0;
                      this.carrito=[];

                      Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500
                        });
                    }
                  });
                }    
            })

        
      },

      detalleNota(carrito){

        this.formCarrito.nota = this.notaActiva.id;
        this.formCarrito.pro = carrito;

        Inertia.post(route('detallenota'), this.formCarrito, {
          onSuccess: () => {
            this.formNota.nota = '';
            this.closeNota();
            Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      showConfirmButton: false,
                      timer: 1500
                      });             
          }
        })
      },

      pagar(carrito){
        console.log('pagar');
        this.showPagar = true;
      },

      pagarNota(form){
        
        this.formPagar.nota = this.notaActiva.id;
        this.formPagar.fecha = form.fecha;
        this.formPagar.entrega = form.entrega;
        this.formPagar.numero = form.numero;
        this.formPagar.nit = form.nit;
        this.formPagar.nombre = form.nombre;
        this.formPagar.tipo = form.tipo;
        this.formPagar.pago = form.pago;
        this.formPagar.cambio = form.cambio;
        this.formPagar.pro = this.carrito;

        Inertia.post(route('ventas.store'), this.formPagar, {
          onSuccess: () => {
            this.formNota.nota = '';
            this.closeNota();
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
    .btn-circle.btn-sm {
        width: 30px;
        height: 30px;
        padding: 6px 0px;
        border-radius: 15px;
        font-size: 8px;
        text-align: center;
    }
    .btn-circle.btn-md {
        width: 50px;
        height: 50px;
        padding: 7px 10px;
        border-radius: 25px;
        font-size: 10px;
        text-align: center;
    }
    .btn-circle.btn-xl {
        width: 70px;
        height: 70px;
        padding: 10px 16px;
        border-radius: 35px;
        font-size: 12px;
        text-align: center;
    }

    #printable { 
        display: none; 
        font-size: 8px;
    }
</style>