<?php

namespace Sherpa\Core\utilities\toolbar;

class Toolbar
{

    /**
     * Render Sherpa development toolbar component.
     *
     * @param float $loadingTime Current page loading time in milliseconds
     */
    public static function render(float $loadingTime = 0.): void
    {
        include "toolbar.c.php";
    }

}