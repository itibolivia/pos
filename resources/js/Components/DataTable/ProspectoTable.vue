<template>
    <DataTable :options="options" class="display">
      <thead>
        <tr>
          <th v-for="column in columns" :key="column.name" >
            {{ column.label }}
          </th>
          <th>Acciones</th>
        </tr>
      </thead>
  
      <tbody>
          <tr v-for="prospecto in prospectos" :key="prospecto.id">
            <td v-for="value in prospecto" :key="value">{{ value }}</td>
            <td>
              <div v-if="$page.props.auth.user.name === prospecto.asesor">
              <Link :href="route('gestion', prospecto.id)">
                <button class="btn btn-success me-md-2" type="button"
                  >  
                    <span style="color: White;">
                        <i class="fa fa-address-book"></i>
                    </span>
                </button>
              </Link>
            </div>
            </td>
          </tr>
      </tbody>
    </DataTable>
  </template>
  
  <script>
  import DataTable from "datatables.net-vue3";
  import DataTablesLib from "datatables.net-bs5";
  import Buttons from "datatables.net-buttons-bs5";
  import ButtonsHtml5 from "datatables.net-buttons/js/buttons.html5";
  import print from "datatables.net-buttons/js/buttons.print";
  import pdfmake from "pdfmake";
  import pdfFonts from "pdfmake/build/vfs_fonts";
  import Responsive from "datatables.net-responsive-dt";
  import JSZip from "jszip";

  import { Link } from '@inertiajs/inertia-vue3'
  
  pdfmake.vfs = pdfFonts.pdfMake.vfs;
  
  window.JSZip = JSZip;
  
  DataTable.use(DataTablesLib);
  DataTable.use(Responsive);
  DataTable.use(pdfmake);
  DataTable.use(ButtonsHtml5);
  
  export default {
    name: "ProspectoTable",
    components: {
      DataTable,
      Link
    },
    props: ["columns", "prospectos"],
    data() {
      return {
        options: {
          dom: "Bfrtip",
          responsive: true,
          autoWidth: false,
          language: {
            search: "Buscar",
            zeroRecords: "No hay registros para mostrar",
            info: "Mostrando del _START_ a _END_ de _TOTAL_ registros",
            paginate: {
              first: "Primero",
              previous: "Anterior",
              next: "Siguiente",
              last: "Último",
            },
          },
          columnDefs: [
            { "visible": false, "targets": 0 }
          ],
          buttons: [
            {
              title: "Prospectos",
              extend: "excelHtml5",
              text: '<i class="fa-solid fa-file-excel"></i> Excel',
              className:
                "btn-sm font-medium tracking-wide text-white bg-green-600 rounded-md hover:bg-green-500 focus:outline-none",
            },
            {
              title: "Prospectos",
              extend: "pdfHtml5",
              text: '<i class="fa-solid fa-file-pdf"></i> Pdf',
              className:
                "btn-sm font-medium tracking-wide text-white bg-red-600 rounded-md hover:bg-red-500 focus:outline-none",
            },
            {
              title: "Prospectos",
              extend: "print",
              text: '<i class="fa-solid fa-file-print"></i> Imprimir',
              className:
                "btn-sm font-medium tracking-wide text-white bg-cyan-600 rounded-md hover:bg-cyan-500 focus:outline-none",
            },
            {
              title: "Prospectos",
              extend: "copy",
              text: '<i class="fa-solid fa-file-copy"></i> Copiar',
              className:
                "btn-sm font-medium tracking-wide text-white bg-gray-600 rounded-md hover:bg-gray-500 focus:outline-none",
            },
          ],
        },
      };
    },
    methods: {

    }
  };
  </script>
  
  <style>
  @import "datatables.net-dt";
  </style>