<?php

namespace Sherpa\Core\csrf\exceptions;

use Sherpa\Core\exceptions\SherpaException;

class SessionWithoutCSRFException extends SherpaException
{

    protected $code = "SHERPA_002_CSRF";

    protected $message = "Current session does no longer have any CSRF token.";

}