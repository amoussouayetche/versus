 {{-- PWA script --}}
 <script>
     if ("serviceWorker" in navigator) {
         // Register a service worker hosted at the root of the
         // site using the default scope.
         navigator.serviceWorker.register("/sw.js").then(
             (registration) => {
                 console.log("Service worker registration succeeded:", registration);
             },
             (error) => {
                 console.error(`Service worker registration failed: ${error}`);
             },
         );
     } else {
         console.error("Service workers are not supported.");
     }
 </script>

 {{-- bootstrap Js --}}
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
     integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
 </script>

@vite(['resources/js/app.js'])