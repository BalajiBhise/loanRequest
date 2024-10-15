<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckIP
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $IPArry = ["::1", "192.168.45.123", "172.24.11.56"];
        if (in_array($request->ip(), $IPArry)) {
            $response = $next($request);
            return $response;
        } else {
            return redirect()->route("error.accessDenied");
        }
    }
}
