// Perform install steps
let CACHE_NAME = 'my-cache';
let urlsToCache = [
    'https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css',
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css',
    'https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js',
    'https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js',
    '/images/icons/icon-72x72.png',
    '/images/icons/icon-96x96.png',
    '/images/icons/icon-128x128.png',
    '/images/icons/icon-144x144.png',
    '/images/icons/icon-152x152.png',
    '/images/icons/icon-192x192.png',
    '/images/icons/icon-384x384.png',
    '/images/icons/icon-512x512.png',
    '/js/main.js',
    '/js/app.js',
    '/js/dom-to-image.min.js',
    '/resources/assetEstrella.png',
    '/resources/bocadillo.png',
    '/resources/circulo.png',
    '/resources/estrellita.png',
    '/resources/fondo.jpg',
    '/resources/home.png',
    '/resources/info.png',
    '/resources/logo.png',
    '/resources/lupa.png',
    '/resources/lupaAbajo.png',
    '/resources/mas.png',
    '/resources/padelRating.png',
    '/resources/persona.png',
    '/resources/trofeo.png',
    '/resources/ubicacion.png',
    '/resources/ubicacionSinCirculo.png',
    '/resources/fonts/FiraSans-Black.ttf',
    '/resources/fonts/FiraSans-Bold.ttf',
    '/resources/fonts/FiraSans-Medium.ttf',
    '/resources/fonts/FiraSans-Regular.ttf'
];

self.addEventListener('install', function(event) {
  // Perform install steps
    event.waitUntil(
        caches.open(CACHE_NAME)
        .then(function(cache) {
            console.log('Opened cache');
			return cache.addAll(urlsToCache);
        })
    );
});

self.addEventListener('fetch', function(event) {
  event.respondWith(
    caches.match(event.request)
      .then(function(response) {
        // Cache hit - return response
        if (response) {
          return response;
        }
        return fetch(event.request);
      }
    )
  );
});

self.addEventListener('activate', function(event) {
  var cacheWhitelist = ['pigment'];
  event.waitUntil(
    caches.keys().then(function(cacheNames) {
      return Promise.all(
        cacheNames.map(function(cacheName) {
          if (cacheWhitelist.indexOf(cacheName) === -1) {
            return caches.delete(cacheName);
          }
        })
      );
    })
  );
});