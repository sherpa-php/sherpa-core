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

    /**
     * Render the Sherpa internal exception UI.
     *
     * @param SherpaException $exception Exception to show in UI
     */
    private static function render(SherpaException $exception): void
    {
        Debug::error($exception);
    }

    /**
     * @param Exception $exception Given exception
     * @return bool If given exception is inherited or an object
     *              of SherpaException class
     */
    public static function isSherpaException(Exception $exception): bool
    {
        return is_a($exception, self::class);
    }
}