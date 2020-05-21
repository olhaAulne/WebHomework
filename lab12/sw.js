
var cacheName = 'hotel';

var filesToCache = [
  '/',
  '/index.php',
  '/css/form.css',
  '/css/style.css',
  '/js/daypilot-all.min.js',
  '/js/jquery-3.4.1.min.js',
  '/icon.png',
  '/icon16.png',
  '/edit.php',
  '/new.php',
  '/room_new.php',
];

self.addEventListener('install', function(e) {
  console.log('[ServiceWorker] Install');
  e.waitUntil(
    caches.open(cacheName).then(function(cache) {
      console.log('[ServiceWorker] Caching app shell');
      return cache.addAll(filesToCache);
    })
  );
});

self.addEventListener('activate', function(e) {
  console.log('[ServiceWorker] Activate');
  e.waitUntil(
    caches.keys().then(function(keyList) {
      return Promise.all(keyList.map(function(key) {
        if (key !== cacheName) {
          console.log('[ServiceWorker] Removing old cache', key);
          return caches.delete(key);
        }
      }));
    })
  );
});

self.addEventListener('fetch', function(e) {
	console.log('[ServiceWorker] Fetch', e.request.url);
	e.respondWith(
	    caches.match(e.request).then(function(response) {
	    	return response || fetch(e.request);
		})
	);
});