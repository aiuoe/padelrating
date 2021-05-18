<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ trans('panel.site_title') }}</title>
	
    <link rel="manifest" href="/manifest.json">

    <meta name="application-name" content="My Padel Rating">
    <link rel="icon" sizes="16x16 32x32 48x48 72x72" href="/images/icons/icon-72x72.png">
    <link rel="icon" sizes="96x96" href="/images/icons/icon-96x96.png">
    <link rel="icon" sizes="128x128" href="/images/icons/icon-128x128.png">
    <link rel="icon" sizes="144x144" href="/images/icons/icon-144x144.png">
    <link rel="icon" sizes="152x152" href="/images/icons/icon-152x152.png">
    <link rel="icon" sizes="192x192" href="/images/icons/icon-192x192.png">
    <link rel="icon" sizes="384x384" href="/images/icons/icon-384x384.png">
    <link rel="icon" sizes="512x512" href="/images/icons/icon-512x512.png">
	
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style> 
    @font-face {
        font-family: fuenteBold;
        src: url(/resources/fonts/FiraSans-Bold.ttf);
        }
    div {
        font-family: fuenteBold;
        }
        
    </style>
    @yield('styles')
</head>

<body class="fondoInicio">
    <div class="row col-12">
        <img class="logoRegistro-grande" src="/resources/padelRating.png" alt="Logo My Padel Rating">
    </div>

    @yield('content')
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
		});
	}
	</script>
</body>

</html>