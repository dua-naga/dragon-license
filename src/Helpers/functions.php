<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

if (! function_exists('isActive')) {
    /**
     * Set the active class to the current opened menu.
     *
     * @param  string|array $route
     * @param  string       $className
     * @return string
     */
    function isActive($route, $className = 'active')
    {
        if (is_array($route)) {
            return in_array(Route::currentRouteName(), $route) ? $className : '';
        }
        if (Route::currentRouteName() == $route) {
            return $className;
        }
        if (strpos(URL::current(), $route)) {
            return $className;
        }
    }
}

if (! function_exists('dragon_check_connection')) {
    /**
     * Check if license server is reachable
     *
     * @return bool
     */
    function dragon_check_connection()
    {
        $url = dragon_license_url();
        $host = parse_url($url, PHP_URL_HOST);
        $port = parse_url($url, PHP_URL_PORT) ?: 80;
        
        $connected = @fsockopen($host, $port, $errno, $errstr, 5);
        if ($connected) {
            $is_conn = true;
            fclose($connected);
        } else {
            $is_conn = false;
        }

        return $is_conn;
    }
}

if (! function_exists('dragon_license_url')) {
    /**
     * Get the license server URL from config or env
     *
     * @return string
     */
    function dragon_license_url()
    {
        return config('dragon-license.server_url');
    }
}
