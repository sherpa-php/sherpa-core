<?php

namespace Sherpa\Core\utilities\generators\uuid\exceptions;

use Sherpa\Core\exceptions\SherpaException;

class InvalidUUIDException extends SherpaException
{

    protected $code = "SHERPA_001_UUID";

    public function __construct(string $expression)
    {
        $this->message = "
        <span class='code-quote font-mono'>$expression</span> is not a valid UUID token.
        ";

        parent::__construct($this);
    }

}