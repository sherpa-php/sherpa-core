<?php

namespace Sherpa\Core\utilities\toolbar;

class Toolbar
{

    /**
     * Render Sherpa development toolbar component.
     *
     * @param float $serverLoadingTime Current page loading time in milliseconds
     */
    public static function render(float $serverLoadingTime = 0.,
                                  float $clientLoadingTime = 0.): void
    {
        include "toolbar.c.php";
    }

}