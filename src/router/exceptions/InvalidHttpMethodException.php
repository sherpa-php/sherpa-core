<?php

namespace Sherpa\Core\router\exceptions;

use Sherpa\Core\exceptions\SherpaException;

class InvalidHttpMethodException extends SherpaException
{

    protected $code = "SHERPA_001_RTR";

    public function __construct(string $httpMethod)
    {

        parent::__construct();

        $this->message = "
        <span class='font-mono code-quote'>$httpMethod</span>
        HTTP method does no longer exist.
        ";

    }

}