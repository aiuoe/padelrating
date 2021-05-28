<link rel="stylesheet" href="/lib/main.css">
<link rel="stylesheet" href="/lib/custom.css">
<script src="/lib/main.js"></script>
<script src="/lib/locales/es.js"></script>



<script>

    document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar');

        const calendar = new FullCalendar.Calendar(calendarEl, {
            selectable: true,
            initialView: 'timeGridWeek',
            locale: 'es',
            slotDuration: '01:30:00',
            slotMinTime: "07:00:00",
            slotMaxTime: "23:00:00" ,
            allDaySlot: false,
            expandRows: true,
            eventBackgroundColor: '#1fbf1f',
            eventBorderColor: '#1fbf1f', 
            displayEventTime: false ,
            slotLabelFormat: [
                {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12:false
                }
            ],
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'timeGridWeek,timeGridDay'
            },

            events: "{{ route('schedule.index') }}",

          
            
        });

        calendar.setOption('locale' , 'Es');

        calendar.render();
    });

</script>

<style>
    .fc-header-toolbar.fc-toolbar{
        display: flex;
        flex-direction: column;
    }

    .fc-toolbar-chunk {
        margin-bottom: 10px;
    }

    .fc-view-harness.fc-view-harness-active {
        height: 310px !important;
    
    }

    .spinner-hidden {
        text-align: center;
        margin-top: 30px;
        font-size: 30px;
        display: none;
    }

    .spinner-show {
        text-align: center;
        margin-top: 30px;
        font-size: 30px;
        display: none;
    }

    .fc-event-title.fc-sticky {
        text-align: center;
    }

    .calendar-disponibilidad {
        margin-top: 30px;
        margin-bottom: 30px;
    }
    
    a {
        color: #212529
    }
    

</style>