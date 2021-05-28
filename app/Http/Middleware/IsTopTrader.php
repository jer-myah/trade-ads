<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsTopTrader
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
        if($request->user()->role != 'top-trader'){
            return redirect()->back();
        }
        
        return $next($request);
    }
}
