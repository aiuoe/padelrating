<!-- Barra superior / buscador -->
<div class="topnav">
  <div class="row">
    <div class="col-3">
    <a href="{{ route('player.home') }}"><img class="logotipo mx-auto d-block" src="/resources/logo.png" alt=" " width="70px" height="70px"></a> 
  </div>
    <div class="col-9" style="background-color:#1B3967; padding: 0;">
    @can('player_edit')
    <div class="search-container">
      <form action="{{ action('Player\HomeController@postSearchPlayers') }}" method="POST">
        @csrf
        <button type="submit"><img src="/resources/lupa.png" alt=" " width="20px" height="20px"></button>
        <input type="text" placeholder="Buscar jugadores" name="playername" value="{{ isset($playernamesearched)?$playernamesearched:'' }}">
      </form>
    </div>
    @endcan
  </div>
  </div>
</div>