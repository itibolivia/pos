<template>
    <DataTable :options="options" class="display">
      <thead>
        <tr>
          <th v-for="column in columns" :key="column.name">
            {{ column.label }}
          </th>
          <th>Acciones</th>
        </tr>
      </thead>
  
      <tbody>
          <tr v-for="user in users" :key="user.id">
            <td v-for="value in user" :key="value">{{ value }}</td>
            <td>
              <button class="me-2 btn btn-sm btn-warning" 
              @click="updated(user)">
                <i class="fa fa-solid fa-edit"></i>
              </button>
  
              <button class="me-2 btn btn-sm btn-danger" 
              @click="deleted(user.id)">
                <i class="fa fa-solid fa-trash" style="color:white"></i>
              </button>
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
  
  pdfmake.vfs = pdfFonts.pdfMake.vfs;
  
  window.JSZip = JSZip;
  
  DataTable.use(DataTablesLib);
  DataTable.use(Responsive);
  DataTable.use(pdfmake);
  DataTable.use(ButtonsHtml5);
  
  export default {
    name: "Asesores",
    components: {
      DataTable,
    },
    props: ["columns", "users"],
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
              title: "Compras",
              extend: "excelHtml5",
              text: '<i class="fa-solid fa-file-excel"></i> Excel',
              className:
                "btn-sm font-medium tracking-wide text-white bg-green-600 rounded-md hover:bg-green-500 focus:outline-none",
            },
            {
              title: "Compras",
              extend: "pdfHtml5",
              text: '<i class="fa-solid fa-file-pdf"></i> Pdf',
              className:
                "btn-sm font-medium tracking-wide text-white bg-red-600 rounded-md hover:bg-red-500 focus:outline-none",
            },
            {
              title: "Compras",
              extend: "print",
              text: '<i class="fa-solid fa-file-print"></i> Imprimir',
              className:
                "btn-sm font-medium tracking-wide text-white bg-cyan-600 rounded-md hover:bg-cyan-500 focus:outline-none",
            },
            {
              title: "Compras",
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
      updated(id){
        this.$emit('updated', id);
      },
      deleted(id){
        this.$emit('deleted', id);
      }
    }
  };
  </script>
  
  <style>
  @import "datatables.net-dt";
  </style>