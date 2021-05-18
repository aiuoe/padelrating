<p>&nbsp;</p>
<p>&nbsp;</p>
<!-- Nav inferior -->
<nav class="botnav fixed-bottom">
  <div class="row" style="margin:0;">
    <div class="col-div-abajo div-abajo">
		<a href="{{ route('player.home') }}"><img class="imagen-abajo mx-auto d-block" src="/resources/home.png" alt="Inicio" title="Inicio"></a>
	</div>
	<div class="col-div-abajo div-abajo">
		<a href="{{ route('player.getsearchplayers') }}"><img class="imagen-abajo mx-auto d-block" src="/resources/lupaAbajo.png" alt=" "></a>
	</div>
	<div class="col-div-abajo div-abajo">
		<a href="{{ route('player.scores.create') }}"><img class="imagen-abajo-mas mx-auto d-block" src="/resources/mas.png" alt="Registrar resultado" title="Registrar resultado"></a>
	</div>
	<div class="col-div-abajo div-abajo">
		<a href="{{ route('player.messenger.showInbox') }}"><img class="imagen-abajo mx-auto d-block" src="/resources/bocadillo.png" alt=" ">
			<?php 
			$userplayer = Auth()->user()->userPlayers()->first();
			if ($userplayer)
				$unreads = $userplayer->unreadTopics();
			else
				$unreads = 0;
			?>
			@if ($unreads>0)
			<span class="unreadmessages">{{ Auth()->user()->userPlayers()->first()->unreadTopics() }}</span>
    		@endif
</a>
	</div>
	<div class="col-div-abajo div-abajo">
		<a href="{{ route('player.myplayer') }}"><img class="imagen-abajo mx-auto d-block" src="/resources/persona.png" alt=" "></a>
	</div>
  </div>
</nav>
