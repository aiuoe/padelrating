@extends('layouts.player')
@section('content')
<div class="cartaPerfilHard cartaFicha">
	<a href="{{ route('player.home') }}"><i class="fa fa-times"></i></a>
	<img class="info" src="/resources/info.png" style="float:left;">
	<div class="row col-12">
		<img class="estrellaFicha" src="/resources/estrellita.png" style="float:right;">
		<div class="imgFichaJugador" style="background-size: cover;background-image: url('{{ $player->avatar? '/avatars/'.$player->avatar : '/resources/persona.png' }}')"></div>
	</div>
	<div class="container containerCartaPerfil">
		<h2 class="textoTituloCartaFicha">{{ $player->name }} {{ $player->surname }}</h2>
		<p class="bajoNombre">Miembro destacado</p>
		<a href="{{ route('player.player', $player->id) }}">Ver perfil</a>
		<p class="descripCionJugador">{{ $player->description }}</p>
	</div>
	
	<div class="filaJugador">
		<div class="inline tdFicha">
			{{ $player->city }}
		</div>
		<div class="inline tdFicha">
			
		</div>
		<div class="inline tdFicha">
			PR {{ round($player->pr, 2) }}
		</div>
	</div>
	
	<div class="filaJugador">
		<div class="inline tdFichaCorto">
			Lado habitual:
		</div>
		<div class="inline tdFichaLargo">
			{{ $player->side }}
		</div>
	</div>
	
	<div class="filaGolpes">
		<div class="tdFichaEntero">
			Mejores golpes:
		</div>
		<div class="col-12">
			@foreach ($player->bestshots as $shot)
			<div class="golpes">{{ $shot }}</div>
			@endforeach
		</div>
	</div>
	
</div>
@endsection
