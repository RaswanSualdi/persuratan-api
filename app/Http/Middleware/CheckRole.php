<?php

namespace App\Http\Middleware;

use App\Http\Controllers\API\ResponseFormatter;
use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if(in_array($request->user()->role, $roles)){
         return $next($request);
        }

        return ResponseFormatter::error(null, 'Anda tidak punya hak akses', 401);
    }
}
