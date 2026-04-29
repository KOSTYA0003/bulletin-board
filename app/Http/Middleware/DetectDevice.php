<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DetectDevice
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $isMobile = $request->header('User-Agent') &&
            preg_match('/android|iphone|ipad|mobile/i', $request->header('User-Agent'));

        $request->merge(['is_mobile' => $isMobile]);

        return $next($request);
    }
}
