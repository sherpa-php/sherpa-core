<?php

namespace Sherpa\Core\exceptions;

use Exception;
use Sherpa\Core\debugging\Debug;

class SherpaException extends Exception
{
    protected $message = "A Sherpa exception occurred…";
    protected $code = "SHERPA_00";

    public function __construct(SherpaException $exception)
    {
        parent::__construct();

        self::render($exception);
    }

    private static function render(SherpaException $exception): void
    {
        Debug::error($exception);
    }
}