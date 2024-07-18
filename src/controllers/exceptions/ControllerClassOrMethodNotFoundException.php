<?php

namespace Sherpa\Core\controllers\exceptions;

use Sherpa\Core\exceptions\SherpaException;

class ControllerClassOrMethodNotFoundException extends SherpaException
{

    protected $code = "SHERPA_001_CTL";

    public function __construct(string $controller, string $method)
    {
        parent::__construct($this);

        $this->message = "
        <span class='font-mono code-quote'>$controller</span> 
        controller or 
        <span class='font-mono code-quote'>$method</span>
        method do no longer exist.
        ";
    }

}