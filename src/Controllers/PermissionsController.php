<?php

namespace DuaNaga\DragonLicense\Controllers;

use Illuminate\Routing\Controller;
use DuaNaga\DragonLicense\Helpers\PermissionsChecker;

class PermissionsController extends Controller
{
    /**
     * @var PermissionsChecker
     */
    protected $permissions;

    /**
     * @param PermissionsChecker $checker
     */
    public function __construct(PermissionsChecker $checker)
    {
        $this->permissions = $checker;
    }

    /**
     * Display the permissions check page.
     *
     * @return \Illuminate\View\View
     */
    public function permissions()
    {
        $permissions = $this->permissions->check(
            config('dragon-license.permissions')
        );

        return view('dragon-license::installer.permissions', compact('permissions'));
    }
}
