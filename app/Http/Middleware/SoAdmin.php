<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SoAdmin
{
    public function handle(Request $request, Closure $next)
    {
        $u = $request->user();
        abort_unless($u && $u->admin, 404);
        return $next($request);
    }
}
