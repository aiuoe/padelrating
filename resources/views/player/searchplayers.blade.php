@extends('layouts.player')
@section('styles')
    <link rel="stylesheet" href="/css/wrunner-html-range-slider-with-2-handles/css/wrunner-default-theme.css">
    <script src="/css/wrunner-html-range-slider-with-2-handles/js/wrunner-native.js"></script>
@endsection
@section('content')
<div class="centrarCarousel">
    <?php /*
    <div class="row">
        <div class="buscadorDistanciaContainer" style="display: block;">
            <h6 style="color:#1B3967; font-weight: bold;">Nombre y/o apellidos</h6>
            <div class="centrarCarousel">
            <button class="botonProvincia" type="submit"><img src="/resources/lupa.png" alt=" " width="20px" height="20px"></button>
            <input type="text" placeholder="Buscar jugadores" name="playername" value="{{ isset($playernamesearched)?$playernamesearched:'' }}">
            </div>
        </div>
    </div>*/?>

    <div class="col-12 divFiltros">
      <h6 style="color:#1B3967; font-weight: bold;">Filtros disponibles</h6>
      <div class="row" style="margin-left: 0;">
        <div class="golpes" onclick="desplegarDistancia()">Local</div>
        <div class="golpes" onclick="desplegarPR()">PR</div>
        <div class="golpes" onclick="desplegarSexo()">Sexo</div>
      </div>
    </div>

    <!-- buscadores -->
    <div class="row">
        <div id="bDistancia" class="buscadorDistanciaContainer">
              <h6 style="color:#1B3967; font-weight: bold;">Distancia (Km)</h6>
              <div class="my-js-sliderDistancia"></div>
        </div>
    </div>
    
    <div class="row">
        <div id="bPR" class="buscadorDistanciaContainer">
              <h6 style="color:#1B3967; font-weight: bold;">PR</h6>
              <div class="my-js-sliderPr"></div>
        </div>
    </div>
    
    <div class="row">
        <div id="bSexo" class="buscadorDistanciaContainer">
            <h6 style="color:#1B3967; font-weight: bold;">Sexo</h6>
            <div class="sexosFiltro">
             <input type="checkbox" id="filtromujer" name="filtromujer" value="Mujer">
             <label for="filtromujer">Mujer</label>
            </div>
            <div class="sexosFiltro">
             <input type="checkbox" id="filtrohombre" name="filtrohombre" value="Hombre">
             <label for="filtrohombre">Hombre</label><br>
            </div> 
            <div class="sexosFiltro">
             <input type="checkbox" id="filtrootro" name="filtrootro" value="Otro">
             <label for="filtrootro">Otro</label>
            </div> 
        </div>
    </div>

    <button id="btnAplicarFiltros" class="btnDesplegables" style="display: none">Aplicar filtros</button>

    
    <div class="row col-12 divOrden">
        <i class="fa fa-align-center"></i>
        <select name="sexo" class="selectpicker mySelectBusqueda">
                <option selected>Ordenar por</option>
                <option value="pr">PR</option>
                <option value="distancia">Distancia</option>
                <option value="alfabetico">Alfabético</option>
        </select>
    </div>

    <form action="{{ action('Player\HomeController@postSearchPlayers') }}" method="POST" id="busqueda">
      @csrf
      <input type="hidden" name="playername" id="playername" value="{{ isset($playernamesearched)?$playernamesearched:'' }}">
      <input type="hidden" name="mindistance" id="mindistance">
      <input type="hidden" name="maxdistance" id="maxdistance">
      <input type="hidden" name="minpr" id="minpr">
      <input type="hidden" name="maxpr" id="maxpr">
      <input type="hidden" name="filtrosexo" id="filtrosexo">
      <input type="hidden" name="orden" id="orden">
    </form>
    
    <div class="row col-12 col-jugadores">
        @if (count($players)==0)
            <div class="col-12 filaBusquedaJugadores">
                <h5>No se han encontrado resultados</h5>
            </div>
        @endif

        @foreach ($players as $player)
        <div class="col-12 filaBusquedaJugadores">
            <table class="col-8" style="margin-top: 4px;">
                <tr>
                    <th colspan="2" class="nombreEnMensaje">
                        <a href="{{ action('Player\PlayersController@getPlayer', $player->id) }}">{{ $player->name }} {{ $player->surname }}</a></th>
              </tr>
              <tr>
                <td class="jugadoresAtributos">{{ $player->genre == 'male' ? 'Hombre':'Mujer' }}</td>
                <td class="jugadoresAtributos">{{ round($player->distance, 2) }}km</td>
              </tr>
            </table>
            <div class="col-3 inline">
                <div class="c100 small p{{ 100 - round(round($player->pr, 2)/14 * 100, 0) }}">
                    <span>{{ round($player->pr, 2) }}</span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>
            </div>
            <div class="col-1 inline">
                <div class="fotoBusquedaJugadores" style="background-size: cover;background-image: url('{{ $player->avatar? '/avatars/'.$player->avatar : '/resources/persona.png' }}')"></div>
            </div>
        </div>
        @endforeach
        
    </div>

</div>
@endsection

@section('scripts')
@parent
<script>
    var prapplies=false;
    var distanceapplies=false;
    document.getElementById("btnAplicarFiltros").addEventListener("click", function(){
        var distance = sliderD.getValue();
        var pr = sliderPR.getValue();

        if (distanceapplies)
        {
            document.getElementById("mindistance").value = distance.minValue;
            document.getElementById("maxdistance").value = distance.maxValue;
        }
        if (prapplies)
        {
            document.getElementById("minpr").value = pr.minValue;
            document.getElementById("maxpr").value = pr.maxValue;
        }
            
        document.getElementById("busqueda").submit();
    });
    function desplegarDistancia() {
        var x = document.getElementById("bDistancia");
        if (x.style.display === "block") {
            x.style.display = "none";
            distanceapplies=false;
        } else {
            x.style.display = "block";
            distanceapplies=true;
        }
        document.getElementById("btnAplicarFiltros").style.display = "block";
        @if ( ($mindistance!=null) && ($maxdistance!=null) )
            sliderD.setRangeValue({minValue:{{$mindistance}}, maxValue:{{$maxdistance}}});
        @endif
    }
    
    function desplegarPR() {
        var x = document.getElementById("bPR");
        if (x.style.display === "block") {
            x.style.display = "none";
            prapplies=false;
        } else {
            x.style.display = "block";
            prapplies=true;
        }
        document.getElementById("btnAplicarFiltros").style.display = "block";
        @if( ($minpr!=null) && ($maxpr!=null) )
            sliderPR.setRangeValue({minValue:{{$minpr}}, maxValue:{{$maxpr}} });
        @endif
    }
    
    function desplegarSexo() {
        var x = document.getElementById("bSexo");
        if (x.style.display === "block") {
            x.style.display ="none";
        } else {
            x.style.display = "block";
        }
        document.getElementById("btnAplicarFiltros").style.display = "block";
    }

    @if ($genre!=null)
        desplegarSexo();
    @endif
    
    var settingD = {
        roots: document.querySelector('.my-js-sliderDistancia'),
        type: 'range',
        step: 2,
        limits: {minLimit: 0,maxLimit: 50},
        }
    var sliderD = wRunner(settingD);
    
    // set/get value(Distancia)
    //sliderD.setSingleValue(value);
    //sliderD.setRangeValue([values]);
    //sliderD.getValue();
    @if( ($mindistance!=null) || ($maxdistance!=null) )
        desplegarDistancia();
        sliderD.setRangeValue({minValue:{{$mindistance}}, maxValue:{{$maxdistance}} });
    @endif
    
    var settingPR = {
        roots: document.querySelector('.my-js-sliderPr'),
        type: 'range',
        step: 0.5,
        limits: {minLimit: 1,maxLimit: 14.5},
        }
    var sliderPR = wRunner(settingPR);


    @if( ($minpr!=null) || ($maxpr!=null) )
        desplegarPR();
        sliderPR.setRangeValue({minValue:{{$minpr}}, maxValue:{{$maxpr}} });
    @endif
    
    // set/get value(PR)
    //sliderPR.setSingleValue(value);
    //sliderPR.setRangeValue([values]);
    //sliderPR.getValue();

</script>
@endsection