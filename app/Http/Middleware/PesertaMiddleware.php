<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PesertaMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || !auth()->user()->isPeserta()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthorized'], 403);
            }

            abort(403, 'Akses ditolak. Halaman ini khusus untuk peserta.');
        }

        return $next($request);
    }
}
