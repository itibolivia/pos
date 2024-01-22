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
              <h5 class="modal-title" id="myModalLabel">Pagar</h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
                @click="closePagar"
              ></button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-4">
                  <label for="fecha">Fecha</label>
                  <input
                    v-model="form.fecha"
                    type="date"
                    class="form-control"
                    v-bind:class="{ 'is-invalid' : $page.props.errors.fecha}"
                    id="fecha"
                    aria-describedby="fechaHelp"
                  />
                </div>
                <div class="col-md-4">
                  <label for="nombre">Entrega</label>
                  <select class="form-select mx-auto" v-model="form.entrega"> 
                      <option value="recibo" selected>Recibo</option>
                      <option value="factura">Factura</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <label for="numero">Número</label>
                  <input
                    v-model="form.numero"
                    type="text"
                    class="form-control"
                    v-bind:class="{ 'is-invalid' : $page.props.errors.numero}"
                    id="numero"
                    aria-describedby="numeroHelp"
                  />
                </div>
              </div>
              <div class="row" v-show="form.entrega == 'factura'">
                <div class="col-md-4">
                  <label for="nit">NIT</label>
                  <input
                    v-model="form.nit"
                    type="text"
                    class="form-control"
                    v-bind:class="{ 'is-invalid' : $page.props.errors.nit}"
                    id="nit"
                    aria-describedby="nitHelp"
                  />
                </div>
                <div class="col-md-8">
                  <label for="nombre">Nombre</label>
                  <input
                    v-model="form.nombre"
                    type="text"
                    class="form-control"
                    v-bind:class="{ 'is-invalid' : $page.props.errors.nombre}"
                    id="nombre"
                    aria-describedby="nombreHelp"
                  />
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-4">
                  <h4><span>Total (PESOS)</span></h4>
                </div>
                <div class="col-md-8">
                  <h4><strong> {{onViewTotal()}}</strong></h4>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <label for="nombre">Forma de pago</label>
                  <select class="form-select mx-auto" 
                  v-bind:class="{ 'is-invalid' : $page.props.errors.tipo}"
                  v-model="form.tipo"> 
                      <option value="efectivo">Efectivo</option>
                      <option value="transferencia">Transferencia</option>
                      <option value="pedidosya">PedidosYa</option>
                      <option value="pago_qr">Pago QR</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <label for="pago">Pago</label>
                  <input
                    v-model="form.pago"
                    type="number"
                    class="form-control"
                    v-bind:class="{ 'is-invalid' : $page.props.errors.pago}"
                    id="pago"
                    aria-describedby="pagoHelp"
                    @change="calculateChange()"
                  />
                </div>
                <div class="col-md-4">
                  <label for="pago">Cambio</label>
                  <div><h4><strong> {{onViewChange()}}</strong></h4></div>
                  <input
                    v-model="form.cambio"
                    type="hidden"
                    class="form-control"
                    v-bind:class="{ 'is-invalid' : $page.props.errors.cambio}"
                    id="cambio"
                    aria-describedby="cambioHelp"
                  />
                </div>
              </div>
  
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary"
                data-bs-dismiss="modal"
                @click="closePagar"
              >
                Cerrar
              </button>
              <button 
                @click.prevent="pagar(form)"
                type="button" 
                class="btn btn-success"
                style="color:white">
                  Pagar
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
    name: "PagarNota",
    components: {
      BreezeLabel,
      BrezzeInput,
      BreezeValidationErrors,
    },
    props: ['nota', 'carrito'],
    data() {
      return {
        form: {
          type: Object,
          default: () => {},
        },
        pagoTotal: 0
      };
    },
    created() {
      this.form.fecha = this.currentDate();
    },
    methods: {
      currentDate() {
        let current = new Date();
        let date = `${current.getFullYear()}-${('0' + (current.getMonth()+1)).slice(-2)}-${('0' + current.getDate()).slice(-2)}`;
        return date;
      },

      convertMoney(value){

      const formatterPeso = new Intl.NumberFormat('es-BO', {
      style: 'currency',
      currency: 'BOB',
      minimumFractionDigits: 1
      })
      let valueFinal = formatterPeso.format(value);


      return valueFinal

      },

      calculateChange(){
        this.form.cambio = this.pagoTotal - this.form.pago;
      },

      onViewChange() {
        let cambio = 0;

        cambio = this.form.pago - this.pagoTotal;

        if (cambio > 0) {
            this.form.cambio = cambio;
            return this.convertMoney(cambio)
        }
        else {
            this.form.cambio = 0;
            return this.convertMoney(0)
        }
    },

      onViewTotal(){
        let total = 0;
        this.carrito.map((data)=>{
            total = total + (data.cantidad * data.precio);
        })

        this.pagoTotal = total;

        return this.convertMoney(total);
      },
      closePagar() {
        this.$page.props.errors = [];
        this.$emit("closePagar");
      },
      pagar(form) {
        this.$emit("pagarNota", form);
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
      