<?php

namespace DuaNaga\DragonLicense\Controllers;

use Illuminate\Routing\Controller;
use DuaNaga\DragonLicense\Helpers\RequirementsChecker;

class RequirementsController extends Controller
{
    /**
     * @var RequirementsChecker
     */
    protected $requirements;

    /**
     * @param RequirementsChecker $checker
     */
    public function __construct(RequirementsChecker $checker)
    {
        $this->requirements = $checker;
    }

    /**
     * Display the requirements page.
     *
     * @return \Illuminate\View\View
     */
    public function requirements()
    {
        $phpSupportInfo = $this->requirements->checkPHPversion('8.1');
        $requirements = $this->requirements->check(
            config('dragon-license.requirements')
        );

        return view('vendor.dragon-license.installer.requirements', compact('requirements', 'phpSupportInfo'));
    }
}
