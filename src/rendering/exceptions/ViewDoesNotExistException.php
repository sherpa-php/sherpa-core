<?php

namespace Sherpa\Core\rendering\exceptions;

use Sherpa\Core\exceptions\SherpaException;

class ViewDoesNotExistException extends SherpaException
{

    protected $code = "SHERPA_001_VW";

    public function __construct(string $view)
    {
        parent::__construct();

        $this->message = "
        <span class='font-mono code-quote'>$view</span>
        view does no longer exist.
        ";
    }

}