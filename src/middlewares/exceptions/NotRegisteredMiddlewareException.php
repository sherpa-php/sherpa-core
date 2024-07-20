<?php

namespace Sherpa\Core\middlewares\exceptions;

use Sherpa\Core\exceptions\SherpaException;

class NotRegisteredMiddlewareException extends SherpaException
{

    protected $code = "SHERPA_001_MDLW";

    public function __construct(string $middlewareName)
    {
        $this->message = "
        <span class='font-mono code-quote'>$middlewareName</span>
        middleware is not registered or does no longer exist.
        ";

        parent::__construct();
    }

}