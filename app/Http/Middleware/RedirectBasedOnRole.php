<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectBasedOnRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();

            // Jika user biasa mencoba buka halaman admin → tendang ke /
            if (in_array($user->role, ['user']) && ($request->is('admin') || $request->is('admin/*'))) {
                return redirect('/');
            }

            // Jika admin, biarkan akses /admin berjalan normal
        }

        return $next($request);
    }
}
