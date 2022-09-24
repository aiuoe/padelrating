<!DOCTYPE html>
<html lang="es">
<head>
  <title>Soy yo</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
<style> 
    @font-face {
        font-family: fuente;
        src: url(/resources/fonts/FiraSans-Regular.ttf);
        }
    @font-face {
        font-family: fuente;
        src: url(/resources/fonts/FiraSans-Bold.ttf);
        font-weight: bold;
        }
    body {
        font-family: fuente;
        }
</style>
  
</head>
<body class="fondoInicio">
    <div class="row col-12">
        <img class="logoRegistro" style="margin-bottom: 25px;" src="/resources/padelRating.png" alt=" "> 
    </div>
    
    <!-- Tiene un tamaño no responsive, porque si se ve en una pantalla de ordenador queda MUY distorsionado, así simplemente se verá más pequeño -->
    <div class="cartaPerfilHard">
        <i class="fa fa-times"></i>
        @if (count($candidates)>0)
        <div class="container containerCartaPerfil">
            <h2 class="textoTituloCartaPerfil">¡Ya eres uno de los nuestros!</h2>
            <p>Ayúdanos a comprobar si este es tu perfil:</p>
        </div>
        
        <table class="table">
          <tbody>
            @foreach ($candidates as $candidate)
            <tr>
              <td><img class="jugadores-fotoEresTu" src="/resources/persona.png"></td>
              <td class="tdNombre">{{ $candidate->name }} {{ $candidate->surname }}</td>
              <td style="width: 80px;"><a class="soyYo" href="{{ action('Player\HomeController@getLinkPlayer', $candidate->id) }}">¡Soy yo!</a></td>
            </tr>
            @endforeach
          </tbody>
        </table>
        
        <div class="container noSoyYo">
            <p>No soy ninguno de los anteriores</p>
            <a href="{{ action('Player\HomeController@getFirstQuestionary') }}" class="btnCrearPerfil" style="color: #fff;">Crear perfil</a>
        </div>
        @else
        <div class="container noSoyYo">
            <p>Necesitamos saber algo mas de ti</p>
            <a href="{{ action('Player\HomeController@getFirstQuestionary') }}" class="btnCrearPerfil" style="color: #fff;">Crear perfil</a>
        </div>
        @endif
    </div>
    
</body>


</html>