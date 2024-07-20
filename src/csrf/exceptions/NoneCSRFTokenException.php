<?php

namespace Sherpa\Core\csrf\exceptions;

use Sherpa\Core\exceptions\SherpaException;

class NoneCSRFTokenException extends SherpaException
{

    protected $code = "SHERPA_001_CSRF";

    protected $message = "Current request does not have any CSRF token. Request aborted.";

}