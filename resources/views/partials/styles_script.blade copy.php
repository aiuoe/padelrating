<link rel="stylesheet" href="/lib/main.css">
<link rel="stylesheet" href="/lib/custom.css">
<script src="/lib/main.js"></script>
<script src="/lib/locales/es.js"></script>


<script>

    document.addEventListener('DOMContentLoaded', function() {

        const calendarEl = document.getElementById('calendar');

        const calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'es',
            dateClick: (info) => {

                const schedule = {};
                const fecha = info.dateStr;
                schedule.fecha = info.dateStr;
                schedule.dia = new Date(schedule.fecha).getDay();
                schedule.usuario_id =  @json( auth()->user()->id );
                schedule.usuario_nombre =  @json( auth()->user()->name );
                schedule.disponiblilidad = [] ;
                console.log(schedule);

                
                $("#newModal").modal("show");

                $('.switch').on('click' , 'span.slider' , function(e) {
                    // console.log( e );
                    // console.log( e.target.previousElementSibling.attributes.value.nodeValue);

                    let horaDisponible = e.target.previousElementSibling.attributes.value.nodeValue ;
                    var arreglo = schedule.disponiblilidad;
                    let existencia = arreglo.indexOf(horaDisponible);

                    if(existencia === -1){
                        arreglo.push(horaDisponible);
                        console.log('elemento agregado');
                        schedule.disponiblilidad = arreglo;
                        console.log(schedule);
                        localStorage.setItem('horarios', JSON.stringify(schedule));
                    }else{
                        arreglo.splice( existencia , 1 )
                        console.log('elemento Eliminado'); 
                        schedule.disponiblilidad = arreglo;
                        localStorage.setItem('horarios', JSON.stringify(schedule));
                    }
                })

                let horarios = localStorage.getItem('horarios');
                console.log('horarios:', JSON.parse(horarios));

                $('#formularioaenviar').on('click' , function(){
                    
                    let horarios = localStorage.getItem('horarios');
                    console.log('horarios:', JSON.parse(horarios));

                    
                    // $.ajaxSetup({
                    //     headers: {
                    //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    //     }
                    // }); 

                    // var route="{{action('ScheduleController@store')}}";

                    // $.ajax({
                    //     url: route,
                    //     type:'POST',
                    //     dataType:'json',
                    //     data: horarios,
                    //     success: function(data){
                    //         console.log(data)
                    //     },
                        
                    //     error:function(error){
                    //         console.error(error);
                    //     }
                    
                    // });








                    localStorage.removeItem('horarios');




                });

                

            }
        });

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