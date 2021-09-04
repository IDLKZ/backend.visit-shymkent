<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LocaleMiddleware
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
        if($request->header("Accept-Language")){
            $locale = $request->header("Accept-Language");
            in_array($locale,["kz","en","ru"]) ? app()->setLocale($locale) : app()->setLocale("en");
        }
        return $next($request);
    }
}
