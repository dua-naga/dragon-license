<?php

namespace DuaNaga\DragonLicense\Middleware;

use App\Models\Admin\License;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Symfony\Component\HttpFoundation\Response;

class ActiveSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $license = License::first();
        
        if ($license == null) {
            return redirect('/license-key');
        }

        if (config('dragon-license.offline_mode') === false) {
            if (!dragon_check_connection()) {
                return response()->view('dragon-license::invalid', [
                    'license' => $license,
                    'error' => 'Cannot connect to license server. Please check your internet connection.'
                ], 503);
            }
            
            $isValid = $this->verifyLicenseWithServer($license);
            if (!$isValid) {
                return response()->view('dragon-license::invalid', [
                    'license' => $license,
                    'error' => 'License verification failed. Please update your license.'
                ], 403);
            }
        }

        return $next($request);
    }

    /**
     * Verify license with remote server
     */
    protected function verifyLicenseWithServer(License $license): bool
    {
        try {
            $response = Http::timeout(10)->withHeaders([
                'businessId' => config('dragon-license.business_id'),
            ])->post(dragon_license_url() . config('dragon-license.endpoints.check'), [
                'purchase' => $license->purchase,
                'email' => $license->email,
                'domain' => $license->ip_or_domain,
            ]);

            $callback = json_decode($response->body());
            return isset($callback->status) && $callback->status == 200;
        } catch (\Exception $e) {
            return false;
        }
    }
}
