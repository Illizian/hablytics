importScripts('https://storage.googleapis.com/workbox-cdn/releases/4.3.1/workbox-sw.js');

// Cache JS files.
workbox.routing.registerRoute(
  /\.js\?.*$/,
  // Use cache but update in the background.
  new workbox.strategies.StaleWhileRevalidate({
    cacheName: 'js-cache',
  })
);

// Cache CSS files.
workbox.routing.registerRoute(
  /\.css\?.*$/,
  // Use cache but update in the background.
  new workbox.strategies.StaleWhileRevalidate({
    cacheName: 'css-cache',
  })
);

// Cache image files.
workbox.routing.registerRoute(
  /\.(?:png|jpg|jpeg|svg|gif)$/,
  // Use the cache if it's available.
  // Cache only 20 images for a maximum of a week.
  new workbox.strategies.CacheFirst({
    cacheName: 'image-cache',
    plugins: [
      new workbox.expiration.Plugin({
        maxEntries: 20,
        maxAgeSeconds: 7 * 24 * 60 * 60,
      })
    ],
  })
);

// Cache audio files.
workbox.routing.registerRoute(
  /\.(?:ac3|m4a|mp3|ogg)$/,
  // Use the cache if it's available.
  new workbox.strategies.CacheFirst({
    cacheName: 'audio-cache'
  })
);

// Cache the Google Fonts stylesheets
workbox.routing.registerRoute(
  /^https:\/\/fonts\.googleapis\.com/,
  // Use cache but update in the background.
  new workbox.strategies.StaleWhileRevalidate({
    cacheName: 'google-fonts-stylesheets',
  })
);

// Cache the Google font files
workbox.routing.registerRoute(
  /^https:\/\/fonts\.gstatic\.com/,
  // Use the cache if it's available.
  // Cache only 30 fonts for a maximum of a year.
  new workbox.strategies.CacheFirst({
    cacheName: 'google-fonts-webfonts',
    plugins: [
      new workbox.cacheableResponse.Plugin({
        statuses: [0, 200],
      }),
      new workbox.expiration.Plugin({
        maxAgeSeconds: 60 * 60 * 24 * 365,
        maxEntries: 30,
      }),
    ],
  })
);

self.addEventListener('push', function(e) {
    let { title, ...options } = e.data.json();

    return e.waitUntil(self.registration.showNotification(title, options));
});

self.addEventListener('notificationclick', function(e) {
    if (!e.action) return e.notification.close();

    // The only actions sent will be URLs
    clients.openWindow(e.action);
    e.notification.close();
});
