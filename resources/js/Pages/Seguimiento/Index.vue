<template>
    <Head title="Calendario" />

<breeze-authenticated-layout>
  <template #header>
    <h2 class="h4 font-weight-bold">
      Calendario
    </h2>
  </template>

  <div class="card my-4 shadow-sm">
    <div class="card-body">
      <Calendar @dateClick="dateClick"/>
    </div>
  </div>

  <modal-calendar v-if="showModal" :form="nuevaAccion" :prospectos="prospectos" 
  @closeModal="closeModal" @saveAgenda="saveAgenda"/>
</breeze-authenticated-layout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head } from '@inertiajs/inertia-vue3'
import Calendar from '../../Components/Calendar.vue'
import ModalCalendar from '../../Components/Modals/CalendarModal.vue'

export const EventBus = new Vue();

import { Inertia } from '@inertiajs/inertia'

import Swal from 'sweetalert2'

export default {
    name: 'Index',
    components: {
        BreezeAuthenticatedLayout,
        Head,
        Calendar,
        ModalCalendar,
        EventBus
    },
    props: ['prospectos'],
    data () {
      return {
          showModal: false,
          nuevaAccion: this.$inertia.form({
            prospecto: '',
            accion: '',
            fecha: '',
            hora: '',
          })
      }
    },
    methods: {
        dateClick(arg){
            this.showModal = true;
            this.setModalOpen(arg);
        },
        closeModal(){
          this.showModal = false
        },
        setModalOpen(obj){
          let dateAndTime = obj.dateStr.split("T")

          this.nuevaAccion.fecha = dateAndTime[0]
          this.nuevaAccion.hora = dateAndTime[1].substr(0, 8)
          return
        },
        saveAgenda(param){

          this.nuevaAccion.post(route('agendas.store', param),{

            onSuccess: () => {

              this.closeModal();

              Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: this.$page.props.flash.success,
                  showConfirmButton: false,
                  timer: 1500
                  });

              //usar eventBus para emitir un evento
              EventBus.$emit('reinicarCalendario');
              
            }

          })

        }
      }
}
</script>

<style>

</style>