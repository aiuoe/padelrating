@extends('layouts.player')
@section('content')

<!-- RESULTADOS -->
<div class="row">
    <div class="col-12 col-jugadores">
        <h5 class="perfilNombreJugador" style="margin-bottom: 10px;">
            Resultado a verificar
        </h5>

        <div class="contenedorPerfilLleno">
            <div class="fechaPartidoPequeño">{{ $score->created_at }}</div>
            <div class="filaSuperiorResultados">
                <div class="colResultados" style="width: 33%;">
                    <img class="fotoFilaResultados" src="/resources/persona.png">
                    <div class="mediaFilaResultadosNombre">
                        <a href="{{ action('Player\PlayersController@getPlayer', $score->team_1_player_1->id) }}">{{ substr($score->team_1_player_1->name, 0, 1) }}. {{ explode(' ',ucfirst(strtolower($score->team_1_player_1->surname)))[0] }}</a>
                    </div>
                    <div class="mediaFilaResultadosPR">
                        PR {{ round($score->team_1_player_1->pr, 1) }}
                    </div>
                </div>
                <div class="colResultados" style="width: 33%;">
                    <img class="fotoFilaResultados" src="/resources/persona.png">
                    <div class="mediaFilaResultadosNombre">
                        <a href="{{ action('Player\PlayersController@getPlayer', $score->team_1_player_2->id) }}">{{ substr($score->team_1_player_2->name, 0, 1) }}. {{ explode(' ',ucfirst(strtolower($score->team_1_player_2->surname)))[0] }}</a>
                    </div>
                    <div class="mediaFilaResultadosPR">
                        PR {{ round($score->team_1_player_2->pr, 1) }}
                    </div>
                </div>
                <div class="colResultados" style="width:10%">
                    <?php
                        $sets_team_1 = 0;$sets_team_2 = 0;
                        if ($score->set_1_team_1 > $score->set_1_team_2) $sets_team_1++;
                        if ($score->set_2_team_1 > $score->set_2_team_2) $sets_team_1++;
                        if ($score->set_3_team_1 > $score->set_3_team_2) $sets_team_1++;
                        if ($score->set_1_team_2 > $score->set_1_team_1) $sets_team_2++;
                        if ($score->set_2_team_2 > $score->set_2_team_1) $sets_team_2++;
                        if ($score->set_3_team_2 > $score->set_3_team_1) $sets_team_2++;
                    ?>
                    @if($sets_team_1>$sets_team_2)
                        <img class="fotoTrofeoResultados" src="/resources/trofeo.png">
                    @else
                        &nbsp;
                    @endif
                </div>
                <div class="colResultados" style="width: 24%;">
                    <div class="{{ ($score->set_1_team_1>$score->set_1_team_2?'setGanado':'setPerdido') }}">
                        {{ $score->set_1_team_1 }}
                    </div>
                    <div class="{{ ($score->set_2_team_1>$score->set_2_team_2?'setGanado':'setPerdido') }}">
                        {{ $score->set_2_team_1 }}
                    </div>
                    <div class="{{ ($score->set_3_team_1>$score->set_3_team_2?'setGanado':'setPerdido') }}">
                        {{ $score->set_3_team_1 }}
                    </div>
                </div>
            </div>
            <div class="filaInferiorResultados"> 
                <div class="colResultados" style="width: 33%;">
                    <img class="fotoFilaResultados" src="/resources/persona.png">
                    <div class="mediaFilaResultadosNombre">
                        <a href="{{ action('Player\PlayersController@getPlayer', $score->team_2_player_1->id) }}">{{ substr($score->team_2_player_1->name, 0, 1) }}. {{ explode(' ',ucfirst(strtolower($score->team_2_player_1->surname)))[0] }}</a>
                    </div>
                    <div class="mediaFilaResultadosPR">
                        PR {{ round($score->team_2_player_1->pr, 1) }}
                    </div>
                </div>
                <div class="colResultados" style="width: 33%;">
                    <img class="fotoFilaResultados" src="/resources/persona.png">
                    <div class="mediaFilaResultadosNombre">
                        <a href="{{ action('Player\PlayersController@getPlayer', $score->team_2_player_2->id) }}">{{ substr($score->team_2_player_2->name, 0, 1) }}. {{ explode(' ',ucfirst(strtolower($score->team_2_player_2->surname)))[0] }}</a>
                    </div>
                    <div class="mediaFilaResultadosPR">
                        PR {{ round($score->team_2_player_2->pr, 1) }}
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
                    <div class="{{ ($score->set_1_team_2>$score->set_1_team_1?'setGanado':'setPerdido') }}">
                        {{ $score->set_1_team_2 }}
                    </div>
                    <div class="{{ ($score->set_2_team_2>$score->set_2_team_1?'setGanado':'setPerdido') }}">
                        {{ $score->set_2_team_2 }}
                    </div>
                    <div class="{{ ($score->set_3_team_2>$score->set_3_team_1?'setGanado':'setPerdido') }}">
                        {{ $score->set_3_team_2 }}
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <a href="{{ route('player.scores.confirmverify', $score) }}" class="btnCrearPerfil btnPerfilJugador">Verificar</a>
    <a href="{{ route('player.scores.confirmunverify', $score) }}" class="btnCrearPerfil btnPerfilJugador">Descartar</a>

</div>
@endsection
