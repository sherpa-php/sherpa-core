<?php

namespace Sherpa\Core\exceptions;

use Exception;
use Sherpa\Core\debugging\Debug;
use Throwable;

class SherpaException extends Exception
{
    protected $message = "A Sherpa exception occurred…";
    protected $code = "SHERPA_00";

    public function __construct()
    {
        parent::__construct();

        self::render($this);
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
    public static function isSherpaException(Throwable $exception): bool
    {
        return is_a($exception, self::class);
    }
}