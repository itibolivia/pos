<template>
    <div>
        <Fullcalendar :options="calendarOptions"></Fullcalendar>
    </div>
</template>

<script>
import Fullcalendar from '@fullcalendar/vue3'
import daygrid from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
import timeGrid from '@fullcalendar/timegrid'
import esLocale from '@fullcalendar/core/locales/es';

import EventBus from '@/EventBus'

export default {
    components:{
        Fullcalendar,
        EventBus
    },
    data(){
        return {
            calendarOptions: {
                plugins : [daygrid, interactionPlugin, timeGrid],
                initialView : 'dayGridMonth',
                headerToolbar : {
                    left: 'prev, next, today',
                    center: 'title',
                    right: 'dayGridMonth, timeGridWeek, timeGridDay'
                },
                height: 'auto',
                allDaySlot: false,
                slotMinTime: '08:00:00',
                slotMaxTime: '20:00:00',
                dateClick: this.handleDateClick,
                locale: esLocale,
            }
        }
    },
    beforeMount(){
        this.$data.calendarOptions.events = {
            url: route('agendas.index'),
            method: 'GET',
            failure: error => {
                console.log(error.message);
            }
        };
    },
    mounted(){
        EventBus.on('reinicarCalendario', function(){
            this.reinicarCalendario()
        });
    },
    methods: {
        handleDateClick(clickInfo){
            this.$emit('dateClick', clickInfo);
        },
        reinicarCalendario(){
            console.log('ok');
        }
    }
}
</script>

<style>

</style>