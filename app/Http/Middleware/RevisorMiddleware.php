<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RevisorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Blocca l'accesso se l'utente non è loggato o non è revisore
        if (!auth()->check() || !auth()->user()->isRevisor()) {
            abort(403, 'Accesso riservato ai revisori.');
        }
        return $next($request);
    }
}
