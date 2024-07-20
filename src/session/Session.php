<?php

namespace Sherpa\Core\session;

use Sherpa\Core\csrf\CSRF;

class Session
{
    public static function getCSRFToken(): ?CSRF
    {
        return $_SESSION["sherpa-csrf-token"] ?? null;
    }
}