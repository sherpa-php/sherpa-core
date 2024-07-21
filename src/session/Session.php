<?php

namespace Sherpa\Core\session;

use Sherpa\Core\csrf\CSRF;
use Sherpa\Core\utilities\generators\uuid\UUID;

class Session
{
    public static function getCSRFToken(): ?UUID
    {
        return $_SESSION["sherpa-csrf-token"] ?? null;
    }
}