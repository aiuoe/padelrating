@extends('layouts.player')
@section('content')
<!-- Barra superior / buscador -->
<div class="topnavMensajes dropdown">
  <div class="row">
    <div class="col-2">
        <a href="{{ route('player.messenger.showInbox') }}"><i class='fa fa-angle-left atrasIcono'></i></a>
    </div>
    <div class="col-8">
            <div class="mensaje-foto" style="background-size: cover;background-image: url('{{ $player->avatar? '/avatars/'.$player->avatar : '/resources/persona.png' }}')"></div>
            <h5 class="nombreContacto">{{ $player->name }} {{ $player->surname }}</h5>
    </div>
    <div class="col-2">
        <button class="fa fa-ellipsis-v myElipsis" type="button" data-toggle="dropdown" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu" style="margin-right: 120px;">
          <li class="dropdown-header">Opciones</li>
          <li><a href="#">Compartir ubicación</a></li>
          <li><a href="#">Borrar conversación</a></li>
          <li><a href="#">Bloquear usuario</a></li>
          <li class="divider"></li>
        </ul>
    </div>
  </div>
</div>

<!-- Fecha -->
<div class="row">
    <label class="labelFecha">{{ $topic->created_at }}</label>
</div>

<!-- Mensajes -->
<div class="col-12 contenedorMensajes">
    @foreach ($topic->messages as $message)
    <div class="col-10 mensaje {{ (($message->sender_id==$player->id)?'otro':'tu') }}">
        <p>{{ $message->content }}</p>
        <label class="hora">{{ $message->created_at }}</label>
    </div>
    @endforeach
</div>

<div class="hacerEspacio" style="height: 120px">
    &nbsp
<div>
<nav class="botnav fixed-bottom" style="bottom: 60px;">
    <div class="row" style="margin-inline: 10px;">
        <form action="{{ route('player.messenger.reply', [$topic->id]) }}" method="POST" style="width:100%">
            @csrf
            <input class="escribirTexto col-10" type="text" placeholder="Escribe tu mensaje..." name="content">
            <button type="submit" class="btn fa fa-angle-double-right btnEnviarMensaje"></button>
        </form>
    </div>
</nav>
@endsection

@section('scripts')
@parent
<script type="text/javascript">
window.setTimeout(function () {
  window.location.reload();
}, 30000);
window.setTimeout(function () {
  window.scrollTo(0,document.body.scrollHeight);
}, 1000);
</script>
@endsection