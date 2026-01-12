<?php

namespace DuaNaga\DragonLicense\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class CanUpdate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $installed = Storage::disk('storage')->exists('installed');
        
        if (!$installed) {
            return redirect('/install');
        }

        return $next($request);
    }
}
