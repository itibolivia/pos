<template>
    <BreezeAuthenticatedLayout>

        <div class="card">
  <div class="card-body">
    <div class="container mb-5 mt-3">
      <div class="row d-flex align-items-baseline">
        <!--div class="col-xl-3 float-end">
          <a class="btn btn-light text-capitalize border-0" data-mdb-ripple-color="dark"><i
              class="fas fa-print text-primary"></i> Imprimir</a>
          <a class="btn btn-light text-capitalize" data-mdb-ripple-color="dark"><i
              class="far fa-file-pdf text-danger"></i> Exportar</a>
        </div-->
        <hr>
      </div>

      <div class="container">
        <div class="col-md-12">
          <div class="text-center">
            <p class="pt-0 text-capitalize" style="font-size: 20px;">Detalle de Compra</p>
          </div>

        </div>


        <div class="row">
            <ul class="list-unstyled">
              <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                  class="fw-bold">Fecha:</span>{{ compra.fecha }}</li>
              <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                  class="fw-bold">Factura: </span>{{ compra.factura }}</li>
              <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                  class="me-1 fw-bold">Recibo:</span>{{ compra.recibo }}<!--span class="badge bg-warning text-black fw-bold">
                    {{ compra.recibo }}</span--></li>
            </ul>
        </div>

        <div class="row my-2 mx-1 justify-content-center">
          <table class="table table-striped table-borderless">
            <thead style="background-color:#84B0CA ;" class="text-white">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Producto</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Precio</th>
                <th scope="col">Sub Total</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(detalle,i) in detalles" :key="i">
                <th scope="row">{{ i+1 }}</th>
                <td>{{ detalle.producto.nombre }}</td>
                <td>{{ detalle.cantidad }}</td>
                <td>{{ convertMoney(detalle.precio) }}</td>
                <td>{{ convertMoney(detalle.cantidad * detalle.precio)}}</td>
              </tr>
            </tbody>

          </table>
        </div>
        <div class="row">
          <div class="col-md-7">
            <!--p class="ms-3">Add additional notes and payment information</p-->

          </div>
          <div class="col-md-5">
            <!--ul class="list-unstyled">
              <li class="text-muted ms-3"><span class="text-black me-4">SubTotal</span>$1110</li>
              <li class="text-muted ms-3 mt-2"><span class="text-black me-4">Tax(15%)</span>$111</li>
            </ul-->
            <p class="text-black float-start"><span class="text-black me-3"> </span><span
                style="font-size: 20px;">Total {{ onViewTotal() }}</span></p>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-md-10">
            <!--p>Thank you for your purchase</p-->
          </div>
          <div class="col-md-2">
            <button type="button" class="btn btn-primary text-capitalize"
              style="background-color:#60bdf3 ;" @click="back">Volver</button>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
  
    </BreezeAuthenticatedLayout>
  </template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';

export default {
    name: 'ShowCompra',
    components: {
        BreezeAuthenticatedLayout
    },
    props: ['compra', 'detalles'],
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
            this.detalles.map((data)=>{
                total = total + (data.cantidad * data.precio);
            });
            return this.convertMoney(total);
        },
        back() {
            window.history.back();
        },
    }

}
</script>

<style>

</style>