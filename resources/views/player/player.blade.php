@extends('layouts.player')


@section('styles')


    @include('partials.styles_script')
   
@endsection


@section('content')


<div class="row centrarCarousel">
    <div class="col-6">
        <div class="fotoPerfil" style="background-size: cover;background-image: url('{{ $player->avatar? '/avatars/'.$player->avatar : '/resources/persona.png' }}')"></div>
    </div>
    <div class="col-6">
        <div class="c100 p{{ 100 - round(round($player->pr, 2)/14 * 100, 0) }}">
            <span>PR<br><span class="prtext">{{ round($player->pr, 2) }}</span></span>
            <div class="slice">
                <div class="bar"></div>
                <div class="fill"></div>
            </div>
        </div>
<!--
        <img class="fotoCirculo" src="/resources/circulo.png">
        <div class="textoDentro">{{ round($player->pr, 2) }}</div>
        <div class="textoDentroArriba">PR</div> -->
    </div>
</div>

<div class="col-12 centrarCarousel">
    <h3 class="perfilNombreJugador" style="text-transform: capitalize;">
        {{ strtolower($player->name) }} {{ strtolower($player->surname) }}
    </h3>
</div>

<div class="row col-12 centrarCarousel">
      <img class="imgLocalizacion" src="/resources/ubicacionSinCirculo.png" height="20px"> 
      <div class="jugadores-cercanos" style="float:left;">
          <h6 class="perfilNombreJugador">{{( ($player->distance==0)? $player->city:'A '.round($player->distance, 1).' km de ti' )}}</h6>
      </div>
</div>

<div class="row col-12 centrarCarousel">
        <div class="textoGolpes col-5">Mejores golpes</div>

        @foreach ($player->bestshots as $shot)
        <div class="golpesFicha">{{ $shot }}</div>
        @endforeach
</div>

<div class="row col-12 centrarCarousel">
        <div class="textoGolpes col-5">Lado habitual</div>
        <div class="textoGolpesAzul">{{ $player->side }}</div>
</div>

<div class="row col-12 centrarCarousel">
            @if($edit)
                <a href="{{ route('player.players.edit', $player->id) }}" class="btnCrearPerfil btnPerfilJugador">Editar</a>
            @else
                <a href="{{ action('Player\MessengerController@getConversation', $player->id) }}" class="btnCrearPerfil btnPerfilJugador">Invitar a jugar</a>
            @endif
            <button class="btnCrearPerfil btnPerfilJugador share-button">Compartir perfil</button>
</div>

<div class="calendar-disponibilidad">
    <h5 class="perfilNombreJugador" style="margin-bottom: 10px;">
        Disponibilidad
    </h5>


    <div id="spinner-hidden" class="spinner spinner-hidden" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>

    <div class="form-group">
            <div id='calendar'></div>
    </div>
</div>

<!-- RESULTADOS -->
<div class="row">
    <div class="col-12 col-jugadores">
        <h5 class="perfilNombreJugador" style="margin-bottom: 10px;">
            Resultados
        </h5>
        @if (count($lastscores)==0)
        <div class="contenedorPerfilVacío">
            <h4 style="line-height: 100px; font-weight: bold;">Sin resultados</h4>
        </div>
        @endif

        @foreach($lastscores as $lastscore)
        <div class="contenedorPerfilLleno">
            <div class="fechaPartidoPequeño">{{ $lastscore->created_at }}</div>
            <div class="filaSuperiorResultados">
                <div class="colResultados" style="width: 33%;">
                    <div class="fotoFilaResultados" style="background-size: cover;background-image: url('{{ $lastscore->team_1_player_1->avatar? '/avatars/'.$lastscore->team_1_player_1->avatar : '/resources/persona.png' }}')"></div>
                    <div class="mediaFilaResultadosNombre">
                        <a href="{{ action('Player\PlayersController@getPlayer', $lastscore->team_1_player_1->id) }}">{{ substr($lastscore->team_1_player_1->name, 0, 1) }}. {{ explode(' ',ucfirst(strtolower($lastscore->team_1_player_1->surname)))[0] }}</a>
                    </div>
                    <div class="mediaFilaResultadosPR">
                        PR {{ round($lastscore->team_1_player_1->pr, 1) }}
                    </div>
                </div>
                <div class="colResultados" style="width: 33%;">
                    <div class="fotoFilaResultados" style="background-size: cover;background-image: url('{{ $lastscore->team_1_player_2->avatar? '/avatars/'.$lastscore->team_1_player_2->avatar : '/resources/persona.png' }}')"></div>
                    <div class="mediaFilaResultadosNombre">
                        <a href="{{ action('Player\PlayersController@getPlayer', $lastscore->team_1_player_2->id) }}">{{ substr($lastscore->team_1_player_2->name, 0, 1) }}. {{ explode(' ',ucfirst(strtolower($lastscore->team_1_player_2->surname)))[0] }}</a>
                    </div>
                    <div class="mediaFilaResultadosPR">
                        PR {{ round($lastscore->team_1_player_2->pr, 1) }}
                    </div>
                </div>
                <div class="colResultados" style="width:10%">
                    <?php
                        $sets_team_1 = 0;$sets_team_2 = 0;
                        if ($lastscore->set_1_team_1 > $lastscore->set_1_team_2) $sets_team_1++;
                        if ($lastscore->set_2_team_1 > $lastscore->set_2_team_2) $sets_team_1++;
                        if ($lastscore->set_3_team_1 > $lastscore->set_3_team_2) $sets_team_1++;
                        if ($lastscore->set_1_team_2 > $lastscore->set_1_team_1) $sets_team_2++;
                        if ($lastscore->set_2_team_2 > $lastscore->set_2_team_1) $sets_team_2++;
                        if ($lastscore->set_3_team_2 > $lastscore->set_3_team_1) $sets_team_2++;
                    ?>
                    @if($sets_team_1>$sets_team_2)
                        <img class="fotoTrofeoResultados" src="/resources/trofeo.png">
                    @else
                        &nbsp;
                    @endif
                </div>
                <div class="colResultados" style="width: 24%;">
                    <div class="{{ ($lastscore->set_1_team_1>$lastscore->set_1_team_2?'setGanado':'setPerdido') }}">
                        {{ $lastscore->set_1_team_1 }}
                    </div>
                    <div class="{{ ($lastscore->set_2_team_1>$lastscore->set_2_team_2?'setGanado':'setPerdido') }}">
                        {{ $lastscore->set_2_team_1 }}
                    </div>
                    <div class="{{ ($lastscore->set_3_team_1>$lastscore->set_3_team_2?'setGanado':'setPerdido') }}">
                        {{ $lastscore->set_3_team_1 }}
                    </div>
                </div>
            </div>
            <div class="filaInferiorResultados"> 
                <div class="colResultados" style="width: 33%;">
                    <div class="fotoFilaResultados" style="background-size: cover;background-image: url('{{ $lastscore->team_2_player_1->avatar? '/avatars/'.$lastscore->team_2_player_1->avatar : '/resources/persona.png' }}')"></div>
                    <div class="mediaFilaResultadosNombre">
                        <a href="{{ action('Player\PlayersController@getPlayer', $lastscore->team_2_player_1->id) }}">{{ substr($lastscore->team_2_player_1->name, 0, 1) }}. {{ explode(' ',ucfirst(strtolower($lastscore->team_2_player_1->surname)))[0] }}</a>
                    </div>
                    <div class="mediaFilaResultadosPR">
                        PR {{ round($lastscore->team_2_player_1->pr, 1) }}
                    </div>
                </div>
                <div class="colResultados" style="width: 33%;">
                    <div class="fotoFilaResultados" style="background-size: cover;background-image: url('{{ $lastscore->team_2_player_2->avatar? '/avatars/'.$lastscore->team_2_player_2->avatar : '/resources/persona.png' }}')"></div>
                    <div class="mediaFilaResultadosNombre">
                        <a href="{{ action('Player\PlayersController@getPlayer', $lastscore->team_2_player_2->id) }}">{{ substr($lastscore->team_2_player_2->name, 0, 1) }}. {{ explode(' ',ucfirst(strtolower($lastscore->team_2_player_2->surname)))[0] }}</a>
                    </div>
                    <div class="mediaFilaResultadosPR">
                        PR {{ round($lastscore->team_2_player_2->pr, 1) }}
                    </div>
                </div>
                <div class="colResultados" style="width:10%">
                    @if($sets_team_2>$sets_team_1)
                        <img class="fotoTrofeoResultados" src="/resources/trofeo.png">
                    @else
                        &nbsp;
                    @endif
                </div>
                <div class="colResultados" style="width: 24%;">
                    <div class="{{ ($lastscore->set_1_team_2>$lastscore->set_1_team_1?'setGanado':'setPerdido') }}">
                        {{ $lastscore->set_1_team_2 }}
                    </div>
                    <div class="{{ ($lastscore->set_2_team_2>$lastscore->set_2_team_1?'setGanado':'setPerdido') }}">
                        {{ $lastscore->set_2_team_2 }}
                    </div>
                    <div class="{{ ($lastscore->set_3_team_2>$lastscore->set_3_team_1?'setGanado':'setPerdido') }}">
                        {{ $lastscore->set_3_team_2 }}
                    </div>
                </div>
            </div>
            
        </div>
        @endforeach
    </div>

    @if($edit)
        <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
        <a href="#" class="btnCrearPerfil btnPerfilJugador" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">{{ trans('global.logout') }}</a>
    @endif
    
</div>
@endsection

@section('scripts')
@parent


<script src="/js/dom-to-image.min.js"/></script>
<script type="text/javascript">
const shareButton = document.querySelector('.share-button');
shareButton.addEventListener('click', event => {
    domtoimage.toBlob(document.querySelector(".container"))
    .then(function (blob) {
        let file = new File([blob], "my-padel-rating-profile.png", {
            type: "image/png",
        });
        if (navigator.share) {
            navigator.share({
                files: [file],
                title: 'Echa un ojo a mi perfil',
                //url: '{{ action("ShareController@getPlayer", $player->id) }}'
            }).then(() => {
                console.log('Compartido!');
            })
            .catch(console.error);
        } else {
            // fallback
        }
    });
}); 
</script>
@endsection