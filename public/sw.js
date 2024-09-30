// const preLoad = function () {
//     return caches.open("offline").then(function (cache) {
//         // caching index and important routes
//         return cache.addAll(filesToCache);
//     });
// };

// self.addEventListener("install", function (event) {
//     event.waitUntil(preLoad());
// });

// const filesToCache = [
//     '/',
//     '/offline.html'
// ];

// const checkResponse = function (request) {
//     return new Promise(function (fulfill, reject) {
//         fetch(request).then(function (response) {
//             if (response.status !== 404) {
//                 fulfill(response);
//             } else {
//                 reject();
//             }
//         }, reject);
//     });
// };

// const addToCache = function (request) {
//     return caches.open("offline").then(function (cache) {
//         return fetch(request).then(function (response) {
//             return cache.put(request, response);
//         });
//     });
// };

// const returnFromCache = function (request) {
//     return caches.open("offline").then(function (cache) {
//         return cache.match(request).then(function (matching) {
//             if (!matching || matching.status === 404) {
//                 return cache.match("offline.html");
//             } else {
//                 return matching;
//             }
//         });
//     });
// };

// self.addEventListener("fetch", function (event) {
//     event.respondWith(checkResponse(event.request).catch(function () {
//         return returnFromCache(event.request);
//     }));
//     if(!event.request.url.startsWith('http')){
//         event.waitUntil(addToCache(event.request));
//     }
// });


const CACHE_NAME = 'v1.0.0';

const cacheAssets = [
    '/favicon.ico',
];

self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(CACHE_NAME).then(cache => {
            cache.addAll(cacheAssets);
        })
    );
});

self.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys().then(keyList => {
            return Promise.all(keyList.map(key => {
                if (key !== CACHE_NAME) {
                    return caches.delete(key);
                }
            }));
        })
    );
});

self.addEventListener('fetch', event => {
    event.respondWith(
        caches.open(CACHE_NAME).then(cache => {
            return cache.match(event.request).then(response => {
                return response || fetch(event.request);
            });
        })
    );
});
