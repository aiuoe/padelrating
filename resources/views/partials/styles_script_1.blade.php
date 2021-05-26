<link rel="stylesheet" href="/lib/main.css">
<link rel="stylesheet" href="/lib/custom.css">
<script src="/lib/main.js"></script>
<script src="/lib/locales/es.js"></script>



<script>


    document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar');

        $('.home-btn-disponibilidad').on('click', function () {
                setTimeout(() => {
                    $('.fc-timeGridWeek-button').click()
                }, 500);
               
        });

        $('.home-btn-disponibilidad').on('click' , function(){
            let url = $(this).parent().children().first().attr('href');
            let id = url.substring(url.lastIndexOf('/') + 1);
            localStorage.setItem('id_usuario', JSON.stringify(id))
        })


        let id_usuario =  JSON.parse(localStorage.getItem('id_usuario'));
        console.log(id_usuario);

        let url = '/schedule/';
        console.log(url)

        const calendar = new FullCalendar.Calendar(calendarEl, {
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
                    hour12:true
                }
            ],
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'timeGridWeek,timeGridDay'
            },
            events: function(start, end, timeZoneStr, callback) {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                        type: "GET",
                        url: url + id_usuario,
                        dataType: 'json',
                        success: function (data) {
                            console.log(data);
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