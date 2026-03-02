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
                    'error' => 'Cannot connect to license server. Please check your internet connection.',
                    'network_error' => true,
                ], 503);
            }
            
            $verification = $this->verifyLicenseWithServer($license);

            if ($verification['network_error']) {
                return response()->view('dragon-license::invalid', [
                    'license' => $license,
                    'error' => $verification['message'],
                    'network_error' => true,
                ], 503);
            }

            if (!$verification['valid']) {
                return response()->view('dragon-license::invalid', [
                    'license' => $license,
                    'error' => 'License verification failed. Please update your license.',
                    'network_error' => false,
                ], 403);
            }
        }

        return $next($request);
    }

    /**
     * Verify license with remote server.
     * 
     * @return array{valid: bool, network_error: bool, message: string}
     */
    protected function verifyLicenseWithServer(License $license): array
    {
        try {
            $request = Http::timeout(10)->withHeaders([
                'businessId' => config('dragon-license.business_id'),
            ]);

            if (config('dragon-license.verify_ssl') === false) {
                $request->withoutVerifying();
            }

            $response = $request->post(dragon_license_url() . config('dragon-license.endpoints.check'), [
                'purchase' => $license->purchase,
                'email' => $license->email,
                'domain' => $license->ip_or_domain,
            ]);

            if (!$response->successful()) {
                return [
                    'valid' => false,
                    'network_error' => true,
                    'message' => 'License server is not responding. Please try again shortly.',
                ];
            }

            $callback = json_decode($response->body());
            
            $valid = $callback && 
                   (($callback->status ?? null) === 'success' || ($callback->status ?? null) == 200);

            return [
                'valid' => $valid,
                'network_error' => false,
                'message' => '',
            ];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            return [
                'valid' => false,
                'network_error' => true,
                'message' => 'License server timeout. Please check your connection and retry.',
            ];
        } catch (\Exception $e) {
            return [
                'valid' => false,
                'network_error' => true,
                'message' => 'License server is temporarily unavailable. Please try again later.',
            ];
        }
    }
}
