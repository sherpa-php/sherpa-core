<?php

namespace Sherpa\Core\exceptions;

use Exception;
use Sherpa\Core\debugging\Debug;

class ExceptionsManager
{
    public static function useExceptionHandler()
    {
        set_exception_handler(function (Exception $exception)
        {
            Debug::error($exception);
        });
    }
}