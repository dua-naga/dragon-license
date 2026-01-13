<?php

namespace DuaNaga\DragonLicense\Controllers;

use App\Models\Admin\License;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Validator;

class LicenseItemController extends Controller
{
    public function welcome()
    {
        return view('dragon-license::welcome');
    }

    public function validation()
    {
        return view('dragon-license::input');
    }

    public function checkValidation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'purchase' => 'required',
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json([
                    'errors' => $validator->errors(),
                    'message' => 'error'
                ]);
            }
        }

        $deviceName = getHostName();
        $domain = $this->getDomain();

        if (!dragon_check_connection() && config('dragon-license.offline_mode', true)) {
            return $this->saveLicenseOffline($request, $domain);
        }

        return $this->verifyLicenseOnline($request, $domain, $deviceName);
    }

    protected function getDomain(): string
    {
        $root = FacadesRequest::root();
        return preg_replace('#^https?://#', '', $root);
    }

    protected function saveLicenseOffline(Request $request, string $domain)
    {
        $newlicense = new License();
        $newlicense->purchase = $request->purchase;
        $newlicense->email = $request->email;
        $newlicense->ip_or_domain = $domain;
        $newlicense->name = $request->product;
        $newlicense->save();

        return response()->json([
            'pesan' => 'Success Verification Purchase Code',
            'status' => 'success'
        ]);
    }

    protected function verifyLicenseOnline(Request $request, string $domain, string $deviceName)
    {
        try {
            $toServer = Http::withHeaders([
                'businessId' => config('dragon-license.business_id'),
            ])->post(dragon_license_url() . config('dragon-license.endpoints.check'), [
                'purchase' => $request->purchase,
                'email' => $request->email,
                'product' => $request->product,
                'domain' => $domain,
                'device' => $deviceName
            ]);

            $callback = json_decode($toServer->body());

            $isSuccess = $toServer->successful() && 
                         $callback && 
                         (($callback->status ?? null) === 'success' || ($callback->status ?? null) == 200);

            if ($isSuccess) {
                License::create([
                    'purchase' => $request->purchase,
                    'email' => $request->email,
                    'ip_or_domain' => $domain,
                    'name' => $request->product,
                    'version_name' => '1.0.0',
                    'version_code' => 1
                ]);

                return response()->json([
                    'pesan' => 'Success Verification Purchase Code',
                    'status' => 'success'
                ]);
            } else {
                return response()->json([
                    'pesan' => $callback->pesan ?? $callback->message ?? 'License validation failed',
                    'status' => 'error'
                ]);
            }
        } catch (\Exception $e) {
            if (config('dragon-license.offline_mode', true)) {
                return $this->saveLicenseOffline($request, $domain);
            }
            
            return response()->json([
                'pesan' => 'Unable to connect to license server',
                'status' => 'error'
            ]);
        }
    }

    public function updateLicense()
    {
        $license = License::first();
        return view('dragon-license::update', ["page" => "Update License"], compact('license'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'purchase' => 'required',
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json([
                    'errors' => $validator->errors(),
                    'message' => 'error'
                ]);
            }
        }

        $deviceName = getHostName();
        $domain = $this->getDomain();

        if (!dragon_check_connection() && config('dragon-license.offline_mode', true)) {
            return $this->updateLicenseOffline($request, $domain);
        }

        return $this->updateLicenseOnline($request, $domain, $deviceName);
    }

    protected function updateLicenseOffline(Request $request, string $domain)
    {
        License::first()->update([
            'purchase' => $request->purchase,
            'email' => $request->email,
            'ip_or_domain' => $domain,
            'name' => $request->product
        ]);

        return response()->json([
            'pesan' => 'Success Verification Purchase Code',
            'status' => 'success'
        ]);
    }

    protected function updateLicenseOnline(Request $request, string $domain, string $deviceName)
    {
        try {
            $toServer = Http::withHeaders([
                'businessId' => config('dragon-license.business_id'),
            ])->post(dragon_license_url() . config('dragon-license.endpoints.check'), [
                'purchase' => $request->purchase,
                'email' => $request->email,
                'product' => $request->product,
                'domain' => $domain,
                'device' => $deviceName
            ]);

            $callback = json_decode($toServer->body());

            $isSuccess = $toServer->successful() && 
                         $callback && 
                         (($callback->status ?? null) === 'success' || ($callback->status ?? null) == 200);

            if ($isSuccess) {
                License::first()->update([
                    'purchase' => $request->purchase,
                    'email' => $request->email,
                    'ip_or_domain' => $domain,
                    'name' => $request->product
                ]);

                return response()->json([
                    'pesan' => 'Success Verification Purchase Code',
                    'status' => 'success'
                ]);
            } else {
                return response()->json([
                    'pesan' => $callback->pesan ?? $callback->message ?? 'License validation failed',
                    'status' => 'error'
                ]);
            }
        } catch (\Exception $e) {
            if (config('dragon-license.offline_mode', true)) {
                return $this->updateLicenseOffline($request, $domain);
            }
            
            return response()->json([
                'pesan' => 'Unable to connect to license server',
                'status' => 'error'
            ]);
        }
    }
}
