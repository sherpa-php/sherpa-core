<?php

namespace Sherpa\Core\exceptions;

use Exception;
use Sherpa\Core\debugging\Debug;

class SherpaException extends Exception
{
    protected $message = "A Sherpa exception occurred…";
    protected $code = "SHERPA_00";

    public function __construct()
    {
        $this->render();
    }

    private function render(): void
    {
        Debug::error($this);
    }
}