const staticCacheName = "site-static-v2";
const dynamicCacheName = "site-dynamic-v2";
const cacheSize = 500;

const assets = ["", "/"];

//cache limit
const limitCacheSize = (name, size) => {
  caches.open(name).then((cache) => {
    cache.keys().then((keys) => {
      if (keys.length > size) {
        cache.delete(keys[0]).then(limitCacheSize(name, size));
      }
    });
  });
};

// install service worker
self.addEventListener("install", (evt) => {
  // console.log("service worker has been instaled");
  evt.waitUntil(
    caches.open(staticCacheName).then((cache) => {
      // console.log('caching');
      cache.addAll(assets);
    })
  );
});

//activate service worker
self.addEventListener("activate", (evt) => {
  // console.log("service worker has been activated");
  evt.waitUntil(
    caches.keys().then((keys) => {
      //console.log(keys);
      return Promise.all(
        keys
          .filter((key) => key !== staticCacheName && key !== dynamicCacheName)
          .map((key) => caches.delete(key))
      );
    })
  );
});

//fetch events
self.addEventListener("fetch", (evt) => {
  //console.log("fetch event", evt);
  evt.respondWith(
    fetch(evt.request)
      .then((fetchRes) => {
        return caches.open(dynamicCacheName).then((cache) => {
          cache.put(evt.request.url, fetchRes.clone());
          limitCacheSize(dynamicCacheName, cacheSize);
          return fetchRes;
        });
      })
      .catch(() => {
        return caches.match(evt.request);
      })
  );
});
