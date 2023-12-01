<template>
  <breeze-authenticated-layout>
    <template #header>
      <h2 class="h4 font-weight-bold">Reporte Venta</h2>
    </template>

    <div class="card my-4 shadow-sm">
      <div class="card-body">
        <div class="row">
          <div class="col-md-3">
            <h4 class="m-0 text-primary">Información</h4>

            <hr />

            <div class="form-group">
              <h6 class="mb-0">Persona</h6>
              <h4 class="b text-secondary">
                {{ persona.nombre }}
              </h4>
            </div>

            <hr />

            <div class="form-group">
              <h6 class="mb-0">Producto</h6>
              <h4 class="b text-secondary">
                {{ producto.nombre }}
              </h4>
            </div>

            <hr />

            <div class="form-group">
              <h6 class="mb-0">Precio de venta</h6>
              <h4 class="b text-secondary">
                {{ cliente.precio }}
              </h4>
            </div>

            <hr />

            <div class="form-group">
              <h6 class="mb-0">Rubro</h6>
              <h4 class="b text-secondary">
                {{ cliente.rubro }}
              </h4>
            </div>

            <hr />

            <div class="form-group">
              <h6 class="mb-0">Padre</h6>
              <h4 class="b text-secondary">
                {{ cliente.padre }}
              </h4>
            </div>

            <hr />

            <div class="form-group">
              <h6 class="mb-0">Cumpleaños</h6>
              <h4 class="b text-secondary">
                {{ moment(cliente.cumpleanos).format("DD/MM/YYYY") }}
              </h4>
            </div>

            <hr />
          </div>

          <div class="col-md-9">
            <h4 class="m-0 text-primary">Gestión Comercial</h4>

            <hr />

            <div v-if="venta.documento">
              <div class="row">
                <div class="col-sm-9 media mb-4 mt-1">
                  <div class="media-body">
                    <h4 class="m-0 text-primary">Documentos</h4>
                    <small class="text-muted"
                      >Asesor: {{ user_documento.name }}</small
                    >
                  </div>
                </div>
                <div class="col-sm-3">
                  <span class="d-grid gap-2 d-md-flex justify-content-md-end">
                    {{ moment(venta.documento).format("DD/MM/YYYY HH:mm") }}
                  </span>
                </div>
              </div>

              <h5 class="m-b-15">NOTA:</h5>

              <p>
                <strong>{{ venta.nota_documento }}</strong>
              </p>

              <h6 class="p-t-15">
                <i class="fa fa-download mb-2"></i> Adjunto <span></span>
              </h6>

              <div class="row m-b-30">
                <div v-for="(documento, i) in documentos" :key="i">
                  <label>{{ documento.adjunto }}</label><br>
                  <a :href="documento.ruta_documento" target="_blank">
                    {{ documento.archivo }}
                  </a><br>
                </div>
              </div>

              <hr />
            </div>

            <div v-if="venta.test">
              <div class="row">
                <div class="col-sm-9 media mb-4 mt-1">
                  <div class="media-body">
                    <h4 class="m-0 text-primary">Test Drive</h4>
                    <small class="text-muted"
                      >Asesor: {{ user_test.name }}</small
                    >
                  </div>
                </div>
                <div class="col-sm-3">
                  <span class="d-grid gap-2 d-md-flex justify-content-md-end">
                    {{ moment(venta.test).format("DD/MM/YYYY HH:mm") }}
                  </span>
                </div>
              </div>

              <h5 class="m-b-15">NOTA:</h5>

              <p>
                <strong>{{ venta.nota_test }}</strong>
              </p>

              <hr />
            </div>

            <div v-if="venta.proforma">
              <div class="row">
                <div class="col-sm-9 media mb-4 mt-1">
                  <div class="media-body">
                    <h4 class="m-0 text-primary">Proformas</h4>
                    <small class="text-muted"
                      >Asesor: {{ user_proforma.name }}</small
                    >
                  </div>
                </div>
                <div class="col-sm-3">
                  <span class="d-grid gap-2 d-md-flex justify-content-md-end">
                    {{ moment(venta.proforma).format("DD/MM/YYYY HH:mm") }}
                  </span>
                </div>
              </div>

              <h5 class="m-b-15">NOTA:</h5>

              <p>
                <strong>{{ venta.nota_proforma }}</strong>
              </p>

              <h6 class="p-t-15">
                <i class="fa fa-download mb-2"></i> Adjunto <span></span>
              </h6>

              <div class="row m-b-30">
                <div>
                  <div v-for="(proforma, i) in proformas" :key="i">
                  <label>{{ proforma.adjunto }}</label><br>
                  <a :href="proforma.ruta_proforma" target="_blank">
                    {{ proforma.archivo }}
                  </a><br>
                </div>
                </div>
              </div>

              <hr />
            </div>

            <div v-if="venta.pago">
              <div class="row">
                <div class="col-sm-9 media mb-4 mt-1">
                  <div class="media-body">
                    <h4 class="m-0 text-primary">Depósitos</h4>
                    <small class="text-muted"
                      >Asesor: {{ user_pago.name }}</small
                    >
                  </div>
                </div>
                <div class="col-sm-3">
                  <span class="d-grid gap-2 d-md-flex justify-content-md-end">
                    {{ moment(venta.pago).format("DD/MM/YYYY HH:mm") }}
                  </span>
                </div>
              </div>

              <h5 class="m-b-15">NOTA:</h5>

              <p>
                <strong>{{ venta.nota_pago }}</strong>
              </p>

              <h6 class="p-t-15">
                <i class="fa fa-download mb-2"></i> Adjunto <span></span>
              </h6>

              <div class="row m-b-30">
                <div>
                  <div v-for="(pago, i) in pagos" :key="i">
                    <label>{{ pago.adjunto }}</label><br>
                    <a :href="pago.ruta_pago" target="_blank">
                      {{ pago.archivo }}
                    </a><br>
                  </div>
                </div>
              </div>

              <hr />
            </div>

            <div v-if="venta.carta">
              <div class="row">
                <div class="col-sm-9 media mb-4 mt-1">
                  <div class="media-body">
                    <h4 class="m-0 text-primary">Carta</h4>
                    <small class="text-muted"
                      >Asesor: {{ user_carta.name }}</small
                    >
                  </div>
                </div>
                <div class="col-sm-3">
                  <span class="d-grid gap-2 d-md-flex justify-content-md-end">
                    {{ moment(venta.carta).format("DD/MM/YYYY HH:mm") }}
                  </span>
                </div>
              </div>

              <h5 class="m-b-15">NOTA:</h5>

              <p>
                <strong>{{ venta.nota_carta }}</strong>
              </p>

              <h6 class="p-t-15">
                <i class="fa fa-download mb-2"></i> Adjunto <span></span>
              </h6>

              <div class="row m-b-30">
                <div>
                  <div v-for="(carta, i) in cartas" :key="i">
                    <label>{{ carta.adjunto }}</label><br>
                    <a :href="carta.ruta_carta" target="_blank">
                      {{ carta.archivo }}
                    </a><br>
                  </div>
                </div>
              </div>

              <hr />
            </div>

            <div v-if="venta.chasis">
              <div class="row">
                <div class="col-sm-9 media mb-4 mt-1">
                  <div class="media-body">
                    <h4 class="m-0 text-primary">Reserva Chasis</h4>
                    <small class="text-muted"
                      >Asesor: {{ user_chasis.name }}</small
                    >
                  </div>
                </div>
                <div class="col-sm-3">
                  <span class="d-grid gap-2 d-md-flex justify-content-md-end">
                    {{ moment(venta.chasis).format("DD/MM/YYYY HH:mm") }}
                  </span>
                </div>
              </div>

              <h5 class="m-b-15">NOTA:</h5>

              <p>
                <strong>{{ venta.nota_chasis }}</strong>
              </p>

              <hr />
            </div>

            <div v-if="venta.factura">
              <div class="row">
                <div class="col-sm-9 media mb-4 mt-1">
                  <div class="media-body">
                    <h4 class="m-0 text-primary">Factura</h4>
                    <small class="text-muted"
                      >Asesor: {{ user_factura.name }}</small
                    >
                  </div>
                </div>
                <div class="col-sm-3">
                  <span class="d-grid gap-2 d-md-flex justify-content-md-end">
                    {{ moment(venta.factura).format("DD/MM/YYYY HH:mm") }}
                  </span>
                </div>
              </div>

              <h5 class="m-b-15">NOTA:</h5>

              <p>
                <strong>{{ venta.nota_factura }}</strong>
              </p>

              <h6 class="p-t-15">
                <i class="fa fa-download mb-2"></i> Adjunto <span></span>
              </h6>

              <div class="row m-b-30">
                <div>
                  <div v-for="(factura, i) in facturas" :key="i">
                    <label>{{ factura.adjunto }}</label><br>
                    <a :href="factura.ruta_factura" target="_blank">
                      {{ factura.archivo }}
                    </a><br>
                  </div>
                </div>
              </div>

              <hr />
            </div>
          </div>
        </div>
      </div>
    </div>
  </breeze-authenticated-layout>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import moment from "moment";

export default {
  name: "Reporte",
  components: {
    BreezeAuthenticatedLayout
  },
  props: ['cliente', 'venta', 'persona', 'producto', 
          'documentos', 'proformas', 'pagos', 'cartas', 'facturas',
          'user_documento','user_test','user_proforma','user_pago',
          'user_carta','user_chasis','user_factura'
        ],
  data() {
        return {
            moment: moment
        }
    } 
};
</script>

<style>
</style>