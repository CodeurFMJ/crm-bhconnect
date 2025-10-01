<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\LoginLog;
use Illuminate\Support\Facades\Auth;

class TrackUserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Enregistrer la déconnexion si l'utilisateur était connecté et se déconnecte
        if (Auth::check() && $request->is('logout')) {
            $this->logUserActivity(Auth::user(), 'logout', $request);
        }
        
        $response = $next($request);
        
        // Enregistrer la connexion après une authentification réussie
        if (Auth::check() && $request->is('login') && $request->method() === 'POST') {
            $this->logUserActivity(Auth::user(), 'login', $request);
        }
        
        return $response;
    }
    
    /**
     * Enregistrer l'activité de l'utilisateur
     */
    private function logUserActivity($user, $action, Request $request)
    {
        LoginLog::create([
            'user_id' => $user->id,
            'action' => $action,
            'logged_at' => now(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);
    }
}
