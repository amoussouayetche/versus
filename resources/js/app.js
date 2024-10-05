import './bootstrap';
import Echo from "laravel-echo";
window.Pusher = require('pusher-js');


if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/sw.js', { scope: '/' }).then(function (registration) {
        console.log(`SW registered successfully!`);
    }).catch(function (registrationError) {
        console.log(`SW registration failed`);
    });
}


window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY, // Assurez-vous d'avoir défini cette clé dans votre .env
    cluster: process.env.MIX_PUSHER_APP_CLUSTER, // Cluster correspondant dans votre .env
    forceTLS: true
});
