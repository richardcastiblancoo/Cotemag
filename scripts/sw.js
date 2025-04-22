const CACHE_NAME = 'cotemag-v1';
const urlsToCache = [
  '/',
  '/index.php',
  '/styles/style.css',
  '/scripts/main.js'
];

self.addEventListener('install', event => {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(cache => cache.addAll(urlsToCache))
  );
});

self.addEventListener('fetch', event => {
  // Don't cache PHP files to ensure dynamic content is always fresh
  if (event.request.url.includes('.php')) {
    event.respondWith(fetch(event.request));
    return;
  }

  event.respondWith(
    caches.match(event.request)
      .then(response => response || fetch(event.request))
  );
});