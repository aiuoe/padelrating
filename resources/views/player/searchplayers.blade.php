@extends('layouts.player')
@section('styles')
	<link rel="stylesheet" href="/css/wrunner-html-range-slider-with-2-handles/css/wrunner-default-theme.css">
	<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/gijgo@1.9.6/css/gijgo.min.css'>
	<script src="/css/wrunner-html-range-slider-with-2-handles/js/wrunner-native.js"></script>
	<script src='https://cdn.jsdelivr.net/npm/gijgo@1.9.6/js/gijgo.min.js'></script>
	<script src='https://cdn.jsdelivr.net/npm/gijgo@1.9.6/js/messages/messages.es-es.js'></script>
	<script  src="/js/datapicker.js"></script>
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
	<form id="formFilter">
		@csrf
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
		<div class="row diaFechas">
			<div class="col-12 divFiltros">
			   <div class="form-group">
				<h6 class="h6-dia" style="color:#1B3967; font-weight: bold;">Seleccionar rango de fechas</h6>
				<div class="datapiker-class">
					<label for="datepicker">Fecha de inicio</label>
					<input id="datepicker" width="276" name="fechaInicio" />
				</div>
				<div class="datapiker-class">
					<label for="datepicker_1">Fecha de fin</label>
					<input id="datepicker_1" width="276" name="fechaFin"  />
				</div>
			   </div>
			</div>
		</div>
		<div class="row horaSemana">
			<div class="col-12 divFiltros">
			   <div class="form-group">
				<h6 class="h6-dia" style="color:#1B3967; font-weight: bold;">Seleccionar Hora</h6>
				 <select class="form-control" name="hora">
				   <option value="" selected> -- Hora --</option>
				   <option value="07:00-08:30">07:00 - 08:30</option>
				   <option value="08:30-10:00">08:30 - 10:00</option>
				   <option value="10:00-11:30">10:00 - 11:30</option>
				   <option value="11:30-13:00">11:30 - 13:00</option>
				   <option value="13:00-14:30">13:00 - 14:30</option>
				   <option value="14:30-16:00">14:30 - 16:00</option>
				   <option value="16:00-17:30">16:00 - 17:30</option>
				   <option value="17:30-19:00">17:30 - 19:00</option>
				   <option value="19:00-20:30">19:00 - 20:30</option>
				   <option value="20:30-22:00">20:30 - 22:00</option>
				   <option value="22:00-23:30">22:00 - 23:30</option>
				 </select>
			   </div>
			</div>
		</div>
		<button id="btnAplicarFiltros" class="btnDesplegables" style="display: none">Aplicar filtros</button>
	</form>

<!--     <div class="row col-12 divOrden">
		<i class="fa fa-align-center"></i>
		<select name="sexo" class="selectpicker mySelectBusqueda">
				<option selected>Ordenar por</option>
				<option value="pr">PR</option>
				<option value="distancia">Distancia</option>
				<option value="alfabetico">Alfab??tico</option>
		</select>
	</div> -->

	<form action="{{ action('Player\HomeController@postSearchPlayers') }}" method="POST" id="busqueda">
	  @csrf
	  <input type="hidden" name="playername" id="playername" value="{{ isset($playernamesearched)?$playernamesearched:'' }}">
	  <input type="hidden" name="mindistance" id="mindistance">
	  <input type="hidden" name="maxdistance" id="maxdistance">
	  <input type="hidden" name="minpr" id="minpr">
	  <input type="hidden" name="maxpr" id="maxpr">
	  <input type="hidden" name="filtrosexo" id="filtrosexo">
	  <input type="hidden" name="orden" id="orden">	  
	  <input type="hidden" name="datapicker_start" id="datapicker_start">
	  <input type="hidden" name="datapicker_end" id="datapicker_end">
	  <input type="hidden" name="hora_filter" id="hora_filter">
	</form>
	
	<div class="row col-12 col-jugadores">
		@if (count($players)==0)
			<div class="col-12 filaBusquedaJugadores">
				<h5>No se han encontrado resultados</h5>
			</div>
		@endif

	<!-- list users -->
<div class="row col-12 col-jugadores" id="jugadoresLista">
  @foreach ($players as $player)
  <div class="col-12 fila-jugadores">
    <div class="row">
      <div class="col-6 inline jugadores-nombre">
        <p>
        	<a href="{{ action('Player\PlayersController@getPlayer', $player->id) }}">{{ $player->name}} {{ $player->surname}}</a>
        </p>
      </div>
      <div class="col-2 inline jugadores-atributos">
          <p>{{ round($player->distance, 1) }}km</p>
      </div>
      <div class="col-2 inline jugadores-atributos">
        <p>{{ round($player->pr, 1)}}</p>
      </div>
      <div class="col-2 inline">
        <div class="jugadores-foto" style="background-size: cover;background-image: url('{{ $player->avatar? '/avatars/'.$player->avatar : '/resources/persona.png' }}')">
        </div>
      </div>
  	</div>            
	</div>
  @endforeach
</div>
		
	</div>

</div>
@endsection
@section('scripts')
@parent
<script>
	$('#formFilter').submit(function (e)
	{
		e.preventDefault()

		let data = $(this).serializeArray(),
				rawMin = data[1]['value'].split('-'),
				rawMax = data[2]['value'].split('-'),
				dateMin = new Date(`${rawMin[0]}-${rawMin[2]}-${rawMin[1]} 00:00:00`),
				dateMax = new Date(`${rawMax[0]}-${rawMax[2]}-${rawMax[1]} 23:59:59`)

		if (data[1]['value'] == '' && data[2]['value'] == '')
		{
			data.push({name: 'distanceMin', value: $('.wrunner__valueNote')[0].textContent})
			data.push({name: 'distanceMax', value: $('.wrunner__valueNote')[1].textContent})
			data.push({name: 'prMin', value: $('.wrunner__valueNote')[2].textContent})
			data.push({name: 'prMax', value: $('.wrunner__valueNote')[3].textContent})
			$.ajax({
				url: `${location.origin}/player/searchplayers`,
				data: data,
				type: "POST"
			})
			.done((data) => {
				if (data.length)
				{
					$('.filaBusquedaJugadores').hide()
					$('#jugadoresLista').show()
					$('#jugadoresLista').empty()
					data.map(player => {
						$('#jugadoresLista').append(`<div class="col-12 fila-jugadores">
					    <div class="row">
					      <div class="col-6 inline jugadores-nombre"><p><a href="${location.origin + '/player/player/' + player.id}">${player.name} ${player.surname}</a></p></div>
					      <div class="col-2 inline jugadores-atributos"><p>${Math.round(player.distance)}km</p></div>
					      <div class="col-2 inline jugadores-atributos"><p>${Math.round(player.pr)}</p></div>
					      <div class="col-2 inline">
					        <div class="jugadores-foto" style="background-size: cover;background-image: url('${ (player.avatar)? '/avatars/' + player.avatar : '/resources/persona.png' }')"></div>
					      </div>
					  	</div>            
						</div>`)
					})
				}
				else
				{
					$('.filaBusquedaJugadores').show()
					$('#jugadoresLista').hide()
					$('#jugadoresLista').empty()
				}
			})
			.fail((error) => console.log(error))
		}
		else
		{
			if (dateMin < dateMax)
			{
				data.push({name: 'distanceMin', value: $('.wrunner__valueNote')[0].textContent})
				data.push({name: 'distanceMax', value: $('.wrunner__valueNote')[1].textContent})
				data.push({name: 'prMin', value: $('.wrunner__valueNote')[2].textContent})
				data.push({name: 'prMax', value: $('.wrunner__valueNote')[3].textContent})
				$.ajax({
					url: `${location.origin}/player/searchplayers`,
					data: data,
					type: "POST"
				})
				.done((data) => {
					if (data.length)
					{
						$('#jugadoresLista').show()
						$('.filaBusquedaJugadores').hide()
						$('#jugadoresLista').empty()
						data.map(player => {
							$('#jugadoresLista').append(`<div class="col-12 fila-jugadores">
						    <div class="row">
						      <div class="col-6 inline jugadores-nombre"><p><a href="${location.origin + '/player/player/' + player.id}">${player.name} ${player.surname}</a></p></div>
						      <div class="col-2 inline jugadores-atributos"><p>${player.distance}km</p></div>
						      <div class="col-2 inline jugadores-atributos"><p>${player.pr}</p></div>
						      <div class="col-2 inline">
										<div class="jugadores-foto" style="background-size: cover;background-image: url('${ (player.avatar)? '/avatars/' + player.avatar : '/resources/persona.png' }')"></div>
						      </div>
						  	</div>            
							</div>`)
						})
					}
					else
					{
						$('.filaBusquedaJugadores').show()
						$('#jugadoresLista').hide()
						$('#jugadoresLista').empty()
					}
				})
				.fail((error) => console.log(error))
			}
			else
				alert('La fecha de fin no puede ser menor a la fecha de inicio')
		}
	})

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
