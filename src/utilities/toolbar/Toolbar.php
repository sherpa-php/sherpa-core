<?php

namespace Sherpa\Core\utilities\toolbar;

class Toolbar
{

    public static function render(): void
    {
        $loadingTime = 100;     // in milliseconds (ms)

        include "toolbar.c.php";
    }

}