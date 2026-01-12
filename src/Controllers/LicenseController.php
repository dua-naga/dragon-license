<?php

namespace DuaNaga\DragonLicense\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Request as FacadesRequest;

class LicenseController extends Controller
{
    /**
     * Display the installer license page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dragon-license::installer.license');
    }

    public function savingCredencial(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'purchase' => 'required|string',
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

        // Offline mode - skip server verification
        if (!dragon_check_connection() && config('dragon-license.offline_mode', true)) {
            return $this->saveToSession($request);
        }

        // Online mode - verify with server
        return $this->verifyAndSave($request);
    }

    protected function saveToSession(Request $request)
    {
        session()->put('storage_license', $request->purchase);
        session()->put('storage_username', $request->email);
        session()->put('product_type', $request->product);
        session()->put('version_code', 1);
        session()->put('version_name', '1.0.0');

        return redirect()->route('DragonLicense::requirements');
    }

    protected function getDomain(): string
    {
        $root = FacadesRequest::root();
        return preg_replace('#^https?://#', '', $root);
    }

    protected function verifyAndSave(Request $request)
    {
        try {
            $deviceName = getHostName();
            $domain = $this->getDomain();

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

            if ($callback->status == 200) {
                session()->put('storage_license', $request->purchase);
                session()->put('storage_username', $request->email);
                session()->put('product_type', $request->product);

                return redirect()->route('DragonLicense::requirements');
            } else {
                return redirect()->back()->with(['failed' => $callback->message]);
            }
        } catch (\Exception $e) {
            // Fallback to offline mode
            if (config('dragon-license.offline_mode', true)) {
                return $this->saveToSession($request);
            }
            
            return redirect()->back()->with(['failed' => 'Unable to connect to license server']);
        }
    }
}
