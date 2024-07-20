<?php

namespace Sherpa\Core\csrf\exceptions;

use Sherpa\Core\exceptions\SherpaException;

class InvalidCSRFTokenException extends SherpaException
{

    protected $code = "SHERPA_003_CSRF";

    protected $message = "Request and session CSRF tokens are not identical.";

}