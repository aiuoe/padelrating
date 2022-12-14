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

            select: function(info) {
                const schedule = {};
                schedule.player_id =  @json( auth()->user()->id );
                schedule.start = info.startStr;
                schedule.end = info.endStr;
                                
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                
                $.ajax({
                        type: "POST",
                        url: "{{ route('schedule.store') }}",
                        data: schedule,
                        dataType: 'json',

                        beforeSend: function() {
                        //    $('#spinner-hidden').css( 'display', 'block'); 
                        //    $('#calendar').css( 'display', 'none'); 
                        $("#overlay").fadeIn(300);
                        },

                        success: function (data) {
                            calendar.refetchEvents();
                            $('#spinner-hidden').css( 'display', 'none');
                            $('#calendar').css( 'display', 'block');
                        },
                        error: function (data) {
                            console.log(data);
                        },

                        complete: function () { 
                            setTimeout(function(){
                                $("#overlay").fadeOut(300);
                            },500);
                        },
                });
            },

            eventClick: function(info){

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                let url = `${location.origin}/schedule/${info.event._def.publicId}`

                let id_usuario =  {
                    id: info.event._def.publicId
                }
                $.ajax({
                        type: "DELETE",
                        url: url,
                        data: id_usuario,
                        dataType: 'json',
                        beforeSend: function() {
                           $('#spinner-hidden').css( 'display', 'block'); 
                           $('#calendar').css( 'display', 'none'); 
                        },
                        success: function (data) {
                            $('#spinner-hidden').css( 'display', 'none');
                            $('#calendar').css( 'display', 'block');
                            calendar.refetchEvents();
                        },
                        error: function (data) {
                            console.log(data);
                        }
                });
            }
          
            
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