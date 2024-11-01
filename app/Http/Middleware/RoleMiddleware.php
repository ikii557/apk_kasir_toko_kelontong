<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        // Pastikan pengguna memiliki salah satu dari peran yang diizinkan
        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        // Redirect atau tampilkan pesan error jika peran tidak diizinkan
        return redirect('/index')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }
}
