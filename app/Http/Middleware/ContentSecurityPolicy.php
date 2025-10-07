<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ContentSecurityPolicy
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Skip CSP for checkout to allow Midtrans
        if ($request->route() && in_array($request->route()->getName(), ['checkout'])) {
            return $response;
        }

        $response->headers->set('Content-Security-Policy', "default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval' http://localhost:5173 http://127.0.0.1:5173 https://app.sandbox.midtrans.com https://app.midtrans.com https://snap-popup-app.sandbox.midtrans.com; connect-src 'self' http://localhost:5173 http://127.0.0.1:5173 https://api.sandbox.midtrans.com; img-src 'self' data:; style-src 'self' 'unsafe-inline' http://localhost:5173 http://127.0.0.1:5173;");

        return $response;
    }
}
