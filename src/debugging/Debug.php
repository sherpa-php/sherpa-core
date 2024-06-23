<?php

namespace Sherpa\Core\debugging;

class Debug
{

    private const DUMP_TEMPLATE = "
    <link rel='stylesheet' href='../precepts/sherpa-css/styles.css' />
    <div id='sherpa_debug_layout'>
        Hello! :D
    </div>
    ";

    /**
     * Dump given values.
     *
     * @param mixed ...$values
     */
    public static function dump(mixed ...$values): void
    {
        echo self::DUMP_TEMPLATE;
    }

    /**
     * Dump given values and die.
     * "Dump and Die"
     *
     * @param mixed ...$values
     */
    public static function dd(mixed ...$values): void
    {
        self::dump(...$values);
        die;
    }

}