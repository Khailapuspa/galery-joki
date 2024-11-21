<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckEmailDomain
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Pastikan user sudah login
        if (auth()->check()) {
            // Cek apakah domain email pengguna adalah @corporateui.com
            $email = auth()->user()->email;
            if (strpos($email, '@corporateui.com') !== false) {
                // User dengan domain corporateui.com bisa akses semua route
                return $next($request);
            } else {
                // User tanpa domain corporateui.com hanya bisa akses dashboard
                if ($request->path() !== 'dashboard') {
                    return redirect()->route('dashboard');
                }
            }
        }

        return $next($request);
    }
}
