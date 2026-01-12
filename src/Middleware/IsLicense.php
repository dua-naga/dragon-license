<?php

namespace DuaNaga\DragonLicense\Middleware;

use App\Models\Admin\License;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsLicense
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $license = License::first();
        
        if ($license != null) {
            return redirect('/');
        }

        return $next($request);
    }
}
