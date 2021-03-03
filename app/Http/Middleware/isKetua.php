<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isKetua
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
        if(!(auth()->user()->jabatan == 'K')){
            abort(code:403);
        }

        return $next($request);
    }
}
