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
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role === 'admin') {
                // If admin is not on admin routes, redirect to admin
                if (!$request->is('admin') && !$request->is('admin/*')) {
                    return redirect('/admin');
                }
            } elseif ($user->role === 'user') {
                // If user tries to access admin routes, redirect to home
                if ($request->is('admin') || $request->is('admin/*')) {
                    return redirect('/');
                }
            }
        }
        return $next($request);
    }
}
