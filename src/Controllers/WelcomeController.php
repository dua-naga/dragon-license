<?php

namespace DuaNaga\DragonLicense\Controllers;

use Illuminate\Routing\Controller;

class WelcomeController extends Controller
{
    /**
     * Display the installer welcome page.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view('dragon-license::installer.welcome');
    }

    public function offlineMode()
    {
        if (dragon_check_connection()) {
            return redirect()->back();
        }

        $connected = @fsockopen("www.google.com", 80, $errno, $errstr, 5);
        if ($connected) {
            $is_conn = true;
            fclose($connected);
        } else {
            $is_conn = false;
        }

        return view('dragon-license::upgrade.offline', compact('is_conn'));
    }
}
