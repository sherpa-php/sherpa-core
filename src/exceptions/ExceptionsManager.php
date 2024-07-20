<?php

namespace Sherpa\Core\exceptions;

use Exception;
use Sherpa\Core\debugging\Debug;

class ExceptionsManager
{
    /**
     * Create an exception handler to use Sherpa internal debugging interface
     * to display all thrown exception (inside and outside Sherpa framework).
     */
    public static function useExceptionHandler(): void
    {
        set_exception_handler(function (Exception $exception)
        {
            Debug::error($exception);
        });
    }
}