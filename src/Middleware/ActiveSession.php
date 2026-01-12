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

        // Optional: Verify license with server periodically
        if (config('dragon-license.offline_mode') === false && dragon_check_connection()) {
            $isValid = $this->verifyLicenseWithServer($license);
            if (!$isValid) {
                return redirect('/license-key')->with('error', 'License validation failed');
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
            $response = Http::withHeaders([
                'businessId' => config('dragon-license.business_id'),
            ])->post(dragon_license_url() . config('dragon-license.endpoints.check'), [
                'purchase' => $license->purchase,
                'email' => $license->email,
                'domain' => $license->ip_or_domain,
            ]);

            $callback = json_decode($response->body());
            return $callback->status == 200;
        } catch (\Exception $e) {
            // If server is unreachable, allow access in offline mode
            return config('dragon-license.offline_mode', true);
        }
    }
}
