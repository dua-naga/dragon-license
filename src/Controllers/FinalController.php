<?php

namespace DuaNaga\DragonLicense\Controllers;

use App\Models\Admin\License;
use Illuminate\Routing\Controller;
use DuaNaga\DragonLicense\Events\DragonLicenseFinished;
use DuaNaga\DragonLicense\Helpers\EnvironmentManager;
use DuaNaga\DragonLicense\Helpers\FinalInstallManager;
use DuaNaga\DragonLicense\Helpers\InstalledFileManager;
use Illuminate\Support\Facades\Request as FacadesRequest;

class FinalController extends Controller
{
    /**
     * Update installed file and display finished view.
     *
     * @param \DuaNaga\DragonLicense\Helpers\InstalledFileManager $fileManager
     * @param \DuaNaga\DragonLicense\Helpers\FinalInstallManager $finalInstall
     * @param \DuaNaga\DragonLicense\Helpers\EnvironmentManager $environment
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function finish(InstalledFileManager $fileManager, FinalInstallManager $finalInstall, EnvironmentManager $environment)
    {
        $finalMessages = $finalInstall->runFinal();

        $deviceName = getHostName();
        $domain = $this->getDomain();

        $finalStatusMessage = $fileManager->update();
        $finalEnvFile = $environment->getEnvContent();

        event(new DragonLicenseFinished);

        $license = License::create([
            'name' => session('product_type'),
            'email' => session('storage_username'),
            'purchase' => session('storage_license'),
            'version_name' => session('version_name', '1.0.0'),
            'version_code' => session('version_code', 1),
            'ip_or_domain' => $domain,
            'type' => 'online'
        ]);

        session()->put('license_activation', $license->purchase);
        session()->put('username_activation', $license->name);

        return view('vendor.dragon-license.installer.finished', compact('finalMessages', 'finalStatusMessage', 'finalEnvFile'));
    }

    protected function getDomain(): string
    {
        $root = FacadesRequest::root();
        return preg_replace('#^https?://#', '', $root);
    }
}
