<link rel="stylesheet" href="/lib/main.css">
<link rel="stylesheet" href="/lib/custom.css">
<script src="/lib/main.js"></script>
<script src="/lib/locales/es.js"></script>


<script>

    document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar');

        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'timeGridWeek',
            locale: 'es',
            slotDuration: '01:30:00',
            slotMinTime: "07:00:00",
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },

            events: "{{ route('schedule.index') }}",

            dateClick: (info) => {

                const schedule = {};
                schedule.user_id =  @json( auth()->user()->id );
                schedule.start = info.dateStr;
                schedule.end = info.dateStr;
                let posicion = (schedule.start.indexOf('T') + 1);
                console.log(schedule);
                console.log(info);


                // localStorage.setItem('horarios', JSON.stringify(schedule))
                // let horarios = localStorage.getItem('horarios');
                // console.log('horarios:', JSON.parse(horarios));
                // let horarios_objeto = schedule
                
                // $('.day').attr('value', horarios_objeto.day);                            
                // $('.user_id').attr('value',horarios_objeto.user_id);                
                // $('.start').attr('value', horarios_objeto.start);
                // $('.end').attr('value', horarios_objeto.end); 
                // $('.hour').attr('value', horarios_objeto.hour); 
                // $('#formularioEnviar').submit();
                // $('#formularioEnviar').submit(function (e) { 
                //     $('.day').attr('value', horarios_objeto.day);                            
                //     $('.user_id').attr('value',horarios_objeto.user_id);                
                //     $('.start').attr('value', horarios_objeto.start);
                //     $('.end').attr('value', horarios_objeto.end); 
                //     $('.hour').attr('value', horarios_objeto.hour); 

                    
                // });
                
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
                        success: function (data) {
                            calendar.refetchEvents();
                            console.log(data)
                        },
                        error: function (data) {
                            console.log(data);
                        }
        });

            },
          
            
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

</style>