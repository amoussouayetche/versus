<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Si l'utilisateur n'est pas authentifié 
        if (!Auth::guard('admin')->check()) {
            // Empêcher la boucle de redirection
            if (!$request->is('page-connexion')) {
                return redirect('/page-connexion'); // Redirige vers la page de connexion
            }
        }
        return $next($request); // Continue avec la requête
    }
}
