<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureWWW
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
        $host = $request->getHost();

        // Ajouter www si absent dans le domaine
        if (strpos($host, 'www.') !== 0) {
            $url = $request->getScheme() . '://www.' . $request->getHttpHost() . $request->getRequestUri();
            return redirect($url, 301);
        }
        return $next($request);
    }
}



