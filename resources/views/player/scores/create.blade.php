@extends('layouts.player')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection

@section('content')
<div class="centrarCarousel">
    <h4 style="color:#1B3967; font-weight: bold;margin-bottom: 30px">Registrar partido</h4>

    <form method="POST" action="{{ route('player.scores.store') }}" enctype="multipart/form-data">
        @csrf
        <?php 
        $user = \Auth::user();
        $players = \App\Models\Player::where('user_id', $user->id)->get();
        ?>
        <input type="hidden" name="tournament_id" value="11">

        <div class="row cuerpoRegistro">
            <div id="equipo1" class="col-12 equipo">
                <!-- Jugador 1 -->
                <div class="row rowTextoEquipos">
                    <h6 style="color:#1B3967; font-weight: bold;">Equipo 1</h6>
                </div>
                
                <div class="col-12 filaRegistroJugador">
                    <div class="row">
                        <div class="col-10 inline registroNombreJugador">
                            <select class="form-control select2 {{ $errors->has('team_1_player_1') ? 'is-invalid' : '' }}" name="team_1_player_1_id" id="team_1_player_1_id" required>
                                @foreach($players as $id => $player)
                                    <option selected value="{{ $player->id }}">Yo ({{ $player->name }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-2 inline">
                            <img class="partidoFoto" src="/resources/persona.png">
                        </div>
                    </div>                
                </div>
                <!-- Jugador 2 -->
                <div class="col-12 filaRegistroJugador">
                    <div class="row">
                        <div class="col-10 inline registroNombreJugador">
                            <select class="form-control select2 {{ $errors->has('team_1_player_2') ? 'is-invalid' : '' }}" name="team_1_player_2_id" id="team_1_player_2_id" required>
                                @foreach($team_1_player_2s as $id => $team_1_player_2)
                                    <option value="{{ $id }}" {{ old('team_1_player_2_id') == $id ? 'selected' : '' }}>{{ $team_1_player_2 }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-2 inline">
                            <img class="partidoFoto" src="/resources/persona.png">
                        </div>
                    </div>                
                </div>
            </div>
            <!-- Sets -->
            <div class="col-12">
                <div class="row setsRow">
                    <div class="col-1 colSets">
                        <div class="set">
                            SET
                        </div>
                        <div class="numeroSet">
                            1
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="resultadoSet">
                            <input class="set form-control {{ $errors->has('set_1_team_1') ? 'is-invalid' : '' }}" type="number" name="set_1_team_1" id="set_1_team_1" value="{{ old('set_1_team_1', '') }}" step="1">
                        </div>
                        <div class="resultadoSet">
                            <input class="form-control {{ $errors->has('set_1_team_2') ? 'is-invalid' : '' }}" type="number" name="set_1_team_2" id="set_1_team_2" value="{{ old('set_1_team_2', '') }}" step="1" required>
                        </div>
                    </div>
                    <div class="col-1 colSets">
                        <div class="set">
                            SET
                        </div>
                        <div class="numeroSet">
                            2
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="resultadoSet">
                            <input class="form-control {{ $errors->has('set_2_team_1') ? 'is-invalid' : '' }}" type="number" name="set_2_team_1" id="set_2_team_1" value="{{ old('set_2_team_1', '') }}" step="1">
                        </div>
                        <div class="resultadoSet">
                            <input class="form-control {{ $errors->has('set_2_team_2') ? 'is-invalid' : '' }}" type="number" name="set_2_team_2" id="set_2_team_2" value="{{ old('set_2_team_2', '') }}" step="1" required>
                        </div>
                    </div>
                    <div class="col-1 colSets" style="margin-left: -5px">
                        <div class="set">
                            SET
                        </div>
                        <div class="numeroSet">
                            3
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="resultadoSet">
                            <input class="form-control {{ $errors->has('set_3_team_1') ? 'is-invalid' : '' }}" type="number" name="set_3_team_1" id="set_3_team_1" value="{{ old('set_3_team_1', '') }}" step="1">
                        </div>
                        <div class="resultadoSet">
                            <input class="form-control {{ $errors->has('set_3_team_2') ? 'is-invalid' : '' }}" type="number" name="set_3_team_2" id="set_3_team_2" value="{{ old('set_3_team_2', '') }}" step="1">
                        </div>
                    </div>
                </div>
            </div>
                
            <!-- Jugador 3 -->
            <div id="equipo2" class="col-12 equipo">
            
                <div class="row rowTextoEquipos">
                    <h6 style="color:#1B3967; font-weight: bold;">Equipo 2</h6>
                    <img class="iconoTrofeo" src="/resources/trofeo.png">
                </div>
            
                <div class="col-12 filaRegistroJugador">
                    <div class="row">
                        <div class="col-10 inline registroNombreJugador">
                            <select class="form-control select2 {{ $errors->has('team_2_player_1') ? 'is-invalid' : '' }}" name="team_2_player_1_id" id="team_2_player_1_id" required>
                                @foreach($team_2_player_1s as $id => $team_2_player_1)
                                    <option value="{{ $id }}" {{ old('team_2_player_1_id') == $id ? 'selected' : '' }}>{{ $team_2_player_1 }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-2 inline">
                            <img class="partidoFoto" src="/resources/persona.png">
                        </div>
                    </div>                
                </div>
                <!-- Jugador 4 -->
                <div class="col-12 filaRegistroJugador">
                    <div class="row">
                        <div class="col-10 inline registroNombreJugador">
                            <select class="form-control select2 {{ $errors->has('team_2_player_2') ? 'is-invalid' : '' }}" name="team_2_player_2_id" id="team_2_player_2_id" required>
                                @foreach($team_2_player_2s as $id => $team_2_player_2)
                                    <option value="{{ $id }}" {{ old('team_2_player_2_id') == $id ? 'selected' : '' }}>{{ $team_2_player_2 }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-2 inline">
                            <img class="partidoFoto" src="/resources/persona.png">
                        </div>
                    </div>                
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 textosRegistroPartidos">
                <h6 style="color:#1B3967; font-weight: bold;">Fecha y hora del partido</h6>
            </div>
            <div class="col-12">
                <input type="date" id="date" class="divDeFecha">
            </div>
            <div class="col-12 mt-3">
                <div class="row">
                    <div class="col-5">
                        <input class="form-control divHora" type="time" value="00:00:00" id="starttime">
                    </div>
                    <div class="col-2 inline registroNombreJugador" style="text-align: center;">
                        A
                    </div>
                    <div class="col-5">
                        <input class="form-control divHora" type="time" value="00:00:00" id="endtime">
                    </div>
                    <input type="hidden" id="start" name="start" value="">
                    <input type="hidden" id="end" name="end" value="">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 textosRegistroPartidos">
                <h6 style="color:#1B3967; font-weight: bold;">Lugar</h6>
            </div>
            <div class="col-12 filaRegistroJugador">
                <select class="form-control select2 {{ $errors->has('location_club_id') ? 'is-invalid' : '' }}" name="location_club_id" id="location_club_id" required>
                    @foreach($clubs as $id => $clubname)
                    <option value="{{ $id }}" {{ old('location_club_id') == $id ? 'selected' : '' }}>{{ $clubname }}</option>
                    @endforeach
                    <option value="" {{ old('location_club_id') == null ? 'selected' : '' }}>Otro</option>
                </select>
            </div>

            <div class="col-12 mt-3">
                <input type="text" id="other_location" name="other_location" class="divDeFecha" placeholder="Escriba donde ha jugado">
            </div>

        </div>
        <div class="row mt-4">
            <div class="col-12">
                <button class="btn btn-lg btn-danger d-block mx-auto" type="submit">{{ trans('global.save') }}</button>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2();
    });

    $("#location_club_id").on("change", function(){
        if ($(this).val()=="")
        {
            $("#other_location").fadeIn();
        }
        else
        {
            $("#other_location").hide();
        }
    });

    $(".resultadoSet input").on("change", function(){
        var sets_team_1 = 0, sets_team_2 = 0;
        if (parseInt($("#set_1_team_1").val()||0) > parseInt($("#set_1_team_2").val()||0))
        {
            sets_team_1++;
            $("#set_1_team_1").addClass("setGanado");
            $("#set_1_team_2").removeClass("setGanado");
        }
        if (parseInt($("#set_2_team_1").val()||0) > parseInt($("#set_2_team_2").val()||0))
        {
            sets_team_1++;
            $("#set_2_team_1").addClass("setGanado");
            $("#set_2_team_2").removeClass("setGanado");
        }
        if (parseInt($("#set_3_team_1").val()||0) > parseInt($("#set_3_team_2").val()||0))
        {
            sets_team_1++;
            $("#set_3_team_1").addClass("setGanado");
            $("#set_3_team_2").removeClass("setGanado");
        }
        if (parseInt($("#set_1_team_2").val()||0) > parseInt($("#set_1_team_1").val()||0))
        {
            sets_team_2++;
            $("#set_1_team_2").addClass("setGanado");
            $("#set_1_team_1").removeClass("setGanado");
        }        
        if (parseInt($("#set_2_team_2").val()||0) > parseInt($("#set_2_team_1").val()||0))
        {
            sets_team_2++;
            $("#set_2_team_2").addClass("setGanado");
            $("#set_2_team_1").removeClass("setGanado");
        }
        if (parseInt($("#set_3_team_2").val()||0) > parseInt($("#set_3_team_1").val()||0))
        {
            sets_team_2++;
            $("#set_3_team_2").addClass("setGanado");
            $("#set_3_team_1").removeClass("setGanado");
        }

        if (sets_team_1 > sets_team_2)
        {
            $("#equipo1").addClass("equipoGanador");
            $("#equipo2").removeClass("equipoGanador");
        }
        else if (sets_team_2 > sets_team_1)
        {
            $("#equipo2").addClass("equipoGanador");
            $("#equipo1").removeClass("equipoGanador");
        }
        else
        {
            $("#equipo1, #equipo2").removeClass("equipoGanador");
        }
    });
   

    $("#date, #starttime").on("change", function(){
        $("#start").val($("#date").val() + " " + $("#starttime").val());
    })
    $("#date, #endtime").on("change", function(){
        $("#end").val($("#date").val() + " " + $("#endtime").val());
    })
</script>
@endsection