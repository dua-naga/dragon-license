<?php

namespace DuaNaga\DragonLicense\Controllers;

use App\Models\Admin\License;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request as FacadesRequest;

trait ItemPurchase
{

    public static function serverConnection()
    {
        return dragon_check_connection();
    }

    public static function getCredential()
    {
        $getLicense = License::first();
        $deviceName = getHostName();
        $root = FacadesRequest::root();
        $domain = preg_replace('#^https?://#', '', $root);

        try {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'businessId' => config('dragon-license.business_id', 'duanaga'),
            ])->post(dragon_license_url() . config('dragon-license.endpoints.credential', '/api/license/get-credential'), [
                'purchase' => $getLicense->purchase,
                'email' => $getLicense->email,
                'product' => $getLicense->name,
                'domain' => $domain,
                'device' => $deviceName
            ]);

            $callback = json_decode($response->body());

            $isSuccess = $response->successful() && 
                         $callback && 
                         (($callback->status ?? null) === 'success' || ($callback->status ?? null) == 200);

            if ($isSuccess) {
                session()->put('active_session', $callback->token ?? null);
                return $callback->token ?? true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }
}
