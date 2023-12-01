<template>
    <DataTable :options="options" class="display">
      <thead>
        <tr>
          <th v-for="column in columns" :key="column.name" >
            {{ column.label }}
          </th>
          <th>Reactivar</th>
        </tr>
      </thead>
  
      <tbody>
          <tr v-for="baja in bajas" :key="baja.id">
            <td v-for="value in baja" :key="value">{{ value }}</td>
            <td>
                <button class="btn btn-success me-md-2" type="button"
                @click="reactivar(baja.id)">
                    <span style="color: White;">
                        <i class="fa fa-refresh"></i>
                    </span>
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

  import Swal from 'sweetalert2'
  import { Inertia } from '@inertiajs/inertia'

  import { Link } from '@inertiajs/inertia-vue3'
  
  pdfmake.vfs = pdfFonts.pdfMake.vfs;
  
  window.JSZip = JSZip;
  
  DataTable.use(DataTablesLib);
  DataTable.use(Responsive);
  DataTable.use(pdfmake);
  DataTable.use(ButtonsHtml5);
  
  export default {
    name: "BajaTable",
    components: {
      DataTable,
      Link
    },
    props: ["columns", "bajas"],
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
              title: "Bajas",
              extend: "excelHtml5",
              text: '<i class="fa-solid fa-file-excel"></i> Excel',
              className:
                "btn-sm font-medium tracking-wide text-white bg-green-600 rounded-md hover:bg-green-500 focus:outline-none",
            },
            {
              title: "Bajas",
              extend: "pdfHtml5",
              text: '<i class="fa-solid fa-file-pdf"></i> Pdf',
              className:
                "btn-sm font-medium tracking-wide text-white bg-red-600 rounded-md hover:bg-red-500 focus:outline-none",
            },
            {
              title: "Bajas",
              extend: "print",
              text: '<i class="fa-solid fa-file-print"></i> Imprimir',
              className:
                "btn-sm font-medium tracking-wide text-white bg-cyan-600 rounded-md hover:bg-cyan-500 focus:outline-none",
            },
            {
              title: "Bajas",
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
      reactivar(id){
            let swalWithBootstrapButtons = Swal.mixin({
                buttonsStyling : true
            })
            swalWithBootstrapButtons.fire({
                title:'Seguro que desea reactivar?',
                text:'Volverá a aparecer en PROSPECTOS',
                icon:'question',
                showCancelButton:true,
                confirmButtonText:'<i class="fa fa-solid fa-check"></i> si, reactivar',
                cancelButtonText:'<i class="fa fa-solid fa-ban"></i> cancelar'
            }).then((result)=> {
                if(result.isConfirmed){
                    Inertia.get(route('bajas.edit', id),{
                        
                        onSuccess : () => {

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
        }
    }
  };
  </script>
  
  <style>
  @import "datatables.net-dt";
  </style>