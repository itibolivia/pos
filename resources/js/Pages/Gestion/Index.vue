<template>
  <breeze-authenticated-layout>
  <template #header>
    <h2 class="h4 font-weight-bold">
      Gestión Comercial
    </h2>
  </template>

  <div class="card my-4 shadow-sm">
    <div class="card-body">
      <div class="row mb-3">
          <div class="col-sm-5">
            <div class="form-group">
              <h6 class="mb-0">Persona</h6>
              <h4 class="b text-secondary">
                {{ persona }}
              </h4>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <h6 class="mb-0">Producto</h6>
              <h4 class="b text-secondary">
                {{ producto }}
              </h4>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <h6 class="mb-0">Precio</h6>
              <h4 class="b text-secondary">
                {{ precio }}
              </h4>
            </div>
          </div>
        </div>
    </div>
  </div>

  <div class="card my-4 shadow-sm">
      <div class="card-body">

        <div class="row">
          <div class="col-md-3 mb-3 d-flex align-items-start">
            <ul class="nav flex-column nav-pills me-3">
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="#"
                @click.prevent="activetab = 1" :class="[ activetab === 1 ? 'active' : '' ]">
                  Documentos
                  <span v-if="venta.documento" class="badge bg-success ms-2">
                    <i class="fa fa-check" aria-hidden="true"></i>
                  </span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"
                @click.prevent="activetab = 2" :class="[ activetab === 2 ? 'active' : '' ,
                venta.documento ? '' : 'disabled']">
                  Test Drive
                  <span v-if="venta.test" class="badge bg-success ms-2">
                    <i class="fa fa-check" aria-hidden="true"></i>
                  </span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"
                @click.prevent="activetab = 3" :class="[ activetab === 3 ? 'active' : '',
                venta.test ? '' : 'disabled']">
                  Proforma
                  <span v-if="venta.proforma" class="badge bg-success ms-2">
                    <i class="fa fa-check" aria-hidden="true"></i>
                  </span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"
                @click.prevent="activetab = 4" :class="[ activetab === 4 ? 'active' : '',
                venta.proforma ? '' : 'disabled' ]">
                  Depósito
                  <span v-if="venta.pago" class="badge bg-success ms-2">
                    <i class="fa fa-check" aria-hidden="true"></i>
                  </span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"
                @click.prevent="activetab = 5" :class="[ activetab === 5 ? 'active' : '' ,
                  venta.pago ? '' : 'disabled', venta.tipo_pago === 'credito' ? '' : 'disabled']">
                  Carta de Aprobación
                  <span v-if="venta.carta" class="badge bg-success ms-2">
                    <i class="fa fa-check" aria-hidden="true"></i>
                  </span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"
                @click.prevent="activetab = 6" :class="[ activetab === 6 ? 'active' : '' ,
                  venta.tipo_pago === 'contado' ? (venta.pago ? '' : 'disabled') : (venta.carta ? '' : 'disabled')]">
                  Reserva Chasis
                  <span v-if="venta.chasis" class="badge bg-success ms-2">
                    <i class="fa fa-check" aria-hidden="true"></i>
                  </span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"
                @click.prevent="activetab = 7" :class="[ activetab === 7 ? 'active' : '' ,
                  venta.chasis ? '' : 'disabled']">
                  Factura
                  <span v-if="venta.factura" class="badge bg-success ms-2">
                    <i class="fa fa-check" aria-hidden="true"></i>
                  </span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"
                @click.prevent="activetab = 8" :class="[ activetab === 8 ? 'active' : '' ,
                  venta.factura ? '' : 'disabled']">
                  Venta
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"
                @click.prevent="activetab = 9" :class="[ activetab === 9 ? 'active' : '']">
                  Dar de Baja
                </a>
              </li>
            </ul>
          </div>
          <div class="col-md-9 mb-3">
            <div class="content">
              <div v-if="activetab === 1" class="tabcontent">
                <carnet :venta="venta" :documentos="documentos"/>
              </div>
              <div v-if="activetab === 2" class="tabcontent">
                <test :venta="venta"/>
              </div>
              <div v-if="activetab === 3" class="tabcontent">
                <proforma :venta="venta" :proformas="proformas"/>
              </div>
              <div v-if="activetab === 4" class="tabcontent">
                <pago :venta="venta" :pagos="pagos"/>
              </div>
              <div v-if="activetab === 5" class="tabcontent">
                <carta :venta="venta" :cartas="cartas"/>
              </div>
              <div v-if="activetab === 6" class="tabcontent">
                <chasis :venta="venta"/>
              </div>
              <div v-if="activetab === 7" class="tabcontent">
                <factura :venta="venta" :facturas="facturas"/>
              </div>
              <div v-if="activetab === 8" class="tabcontent">
                <venta :venta="venta"/>
              </div>
              <div v-if="activetab === 9" class="tabcontent">
                <baja :venta="venta"/>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    
</breeze-authenticated-layout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import Carnet from '@/Components/GestionComercial/Carnet.vue'
import Test from '@/Components/GestionComercial/Test.vue'
import Proforma from '@/Components/GestionComercial/Proforma.vue'
import Carta from '@/Components/GestionComercial/Carta.vue'
import Pago from '@/Components/GestionComercial/Pago.vue'
import Chasis from '@/Components/GestionComercial/Chasis.vue'
import Factura from '@/Components/GestionComercial/Factura.vue'
import Venta from '@/Components/GestionComercial/Venta.vue'
import Baja from '@/Components/GestionComercial/Baja.vue'

export default {
  name: 'Gestion',
  components: {
    BreezeAuthenticatedLayout,
    Carnet, Test, Proforma, Carta, Pago, Chasis, Factura, Venta, Baja
  },
  props: ['venta', 'persona', 'producto', 'precio', 'documentos', 'proformas', 'cartas', 'pagos', 'facturas'],
  data() {
    return {
      activetab: 1
    }
  }
}
 
</script>

<style>

</style>