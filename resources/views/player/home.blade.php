@extends('layouts.player')
@section('content')
<!-- Jugadores recomendados -->
<div class="centrarCarousel">
<div class="row col-12">
      <img src="resources/assetEstrella.png" width="20px" height="20px"> 
      <h6 style="color:#1B3967;">Jugadores Recomendados</h6>
</div>

<!-- Carrusel de Jugadores -->
<section class="carousel slide" data-interval="false" data-ride="carousel" id="postsCarousel">
    <div class="container">
        <div class="row">
        <i class="fa fa-lg fa-chevron-left prev" style="float:right; margin-top: 85px; margin-inline: 5px;"></i></a>

        <div class="container p-t-0 m-t-2 carousel-inner col-10">
            @foreach($recommendedplayers as $recommendedplayer)
                @if ($loop->index % 2 == 0)
                <div class="carousel-item {{ $loop->first?'active':'' }}">
                    <div class="card-deck">
                @endif
                    <div class="card">
                        <img class="estrella" src="/resources/estrellita.png" width="15px" height="15px" style="float:right;">
                        <div class="card-img-top" style="background-size: cover;background-image: url('{{ $recommendedplayer->avatar? '/avatars/'.$recommendedplayer->avatar : '/resources/persona.png' }}')"></div>
                        <div class="card-body">
                            <p class="card-title"><a href="{{ action('Player\PlayersController@getPlayer', $recommendedplayer->id) }}">{{ $recommendedplayer->name }} {{ $recommendedplayer->surname }}</a></p>
                            <p class="card-text">
                                @if ($recommendedplayer->distance)
                                A {{ round($recommendedplayer->distance, 2) }}km de ti
                                @endif
                            </p>
                            <p class="card-text">PR {{ round($recommendedplayer->pr, 1) }}</p>
                            <a href="{{ route('player.playerinfo', $recommendedplayer->id) }}"><img class="img-info-card" src="/resources/info.png" width="15px" height="15px"></a> 
                        </div>
                    </div>
                @if ($loop->index % 2 == 1)
                    </div>
                </div>
                @endif
            @endforeach
        </div>
        <i class="fa fa-lg fa-chevron-right next" style="float:right; margin-top: 85px; margin-inline: 5px;"></i>
     </div>
     </div>
</section>

<!-- Jugadores Cercanos -->
<div class="row col-12" style="display: contents;">
      <img class="imgLocalizacion" src="/resources/ubicacionSinCirculo.png" height="20px"> 
      <div class="jugadores-cercanos" style="float:left;">
          <h6 style="color:#1B3967;">Jugadores cerca de ti</h6>
          <p>Encuentra jugadores cerca de tu ubicación</p>
      </div>
</div>

<div class="row col-12 col-jugadores">
    @foreach ($nearplayers as $nearplayer)
    <div class="col-12 fila-jugadores">
        <div class="row">
            <div class="col-6 inline jugadores-nombre">
                <p><a href="{{ action('Player\PlayersController@getPlayer', $nearplayer->id) }}">{{ $nearplayer->name}} {{ $nearplayer->surname}}</a></p>
            </div>
            <div class="col-2 inline jugadores-atributos">
                <p>{{ round($nearplayer->distance, 1) }}km</p>
            </div>
            <div class="col-2 inline jugadores-atributos">
                <p>{{ round($nearplayer->pr, 1)}}</p>
            </div>
            <div class="col-2 inline">
                <div class="jugadores-foto" style="background-size: cover;background-image: url('{{ $nearplayer->avatar? '/avatars/'.$nearplayer->avatar : '/resources/persona.png' }}')"></div>
            </div>
        </div>            
    </div>
    @endforeach
</div>
</div>
@endsection

@section('scripts')
@parent
<script>
    //controles carrusel
    (function($) {
        "use strict";

        // manual carousel controls
        $('.next').click(function(){ $('.carousel').carousel('next');return false; });
        $('.prev').click(function(){ $('.carousel').carousel('prev');return false; });
        
    })(jQuery);

    var saveUserLocation = function(latitude, longitude){
        let data={
            'latitude': latitude,
            'longitude': longitude
        }
        fetch('{{ action("Player\HomeController@postSaveUserLocation") }}', {
            headers:{
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            method:'POST',
            body: JSON.stringify(data)
        })
        .then(function(result){
            if (result == -1)
            {
                alert("No se ha podido guardar la localización");
            }
        })
        .catch(function (error) {
            console.log(error);
        });
    }

    if ("geolocation" in navigator) {
      navigator.geolocation.getCurrentPosition(function(position) {
        saveUserLocation(position.coords.latitude, position.coords.longitude);
      });
    }
</script>
@endsection