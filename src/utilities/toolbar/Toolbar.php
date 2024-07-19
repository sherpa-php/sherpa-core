<?php

namespace Sherpa\Core\utilities\toolbar;

use Sherpa\Core\FrameworkInformation;
use Sherpa\Core\router\Route;

class Toolbar
{

    /**
     * Render Sherpa development toolbar component.
     *
     * @param float $serverLoadingTime Current page loading time in milliseconds
     */
    public static function render(Route $currentRoute,
                                  float $serverLoadingTime = 0.): void
    {
        $sherpaVersion = FrameworkInformation::VERSION;

        include "toolbar.c.php";
    }

}