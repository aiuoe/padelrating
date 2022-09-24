<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ trans('panel.site_title') }}</title>
	
    <link rel="manifest" href="/manifest.json">

    <meta name="application-name" content="MyPadelRating">
    <meta name="apple-mobile-web-app-title" content="MyPadelRating">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="apple-touch-startup-image" href="/resources/fondo.jpg">

    <link rel="icon" sizes="16x16 32x32 48x48 72x72" href="/images/icons/icon-72x72.png">
    <link rel="icon" sizes="96x96" href="/images/icons/icon-96x96.png">
    <link rel="icon" sizes="128x128" href="/images/icons/icon-128x128.png">
    <link rel="icon" sizes="144x144" href="/images/icons/icon-144x144.png">
    <link rel="icon" sizes="152x152" href="/images/icons/icon-152x152.png">
    <link rel="icon" sizes="192x192" href="/images/icons/icon-192x192.png">
    <link rel="icon" sizes="384x384" href="/images/icons/icon-384x384.png">
    <link rel="icon" sizes="512x512" href="/images/icons/icon-512x512.png">
    <link rel="apple-touch-icon" sizes="16x16 32x32 48x48 72x72" href="/images/icons/icon-72x72.png">
    <link rel="apple-touch-icon" sizes="96x96" href="/images/icons/icon-96x96.png">
    <link rel="apple-touch-icon" sizes="128x128" href="/images/icons/icon-128x128.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/images/icons/icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/images/icons/icon-152x152.png">
    <link rel="apple-touch-icon" sizes="192x192" href="/images/icons/icon-192x192.png">
    <link rel="apple-touch-icon" sizes="384x384" href="/images/icons/icon-384x384.png">
    <link rel="apple-touch-icon" sizes="512x512" href="/images/icons/icon-512x512.png">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="/css/styles.css?v=20210422" rel="stylesheet" />
    <link href="/css/morestyles.css?v=20210422" rel="stylesheet" />
    <link href="/css/custom.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    @yield('styles')
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

<body>
  @include('player.partials.header')
  <div class="container" style="background-color: whitesmoke;">
    @yield('content')
  </div>
  
  @include('player.partials.footer')
  @yield('scripts')

	<script>
  	if (navigator.serviceWorker.controller) {
  		console.log("Active service worker found");
  	} else {
  		navigator.serviceWorker
  		.register("serviceworker.js", {
  		scope: "./"
  		})
  		.then(function (reg) {
  		console.log("Service worker  registered");
      //reg.update();
  		});
  	}
	</script>
</body>

</html>