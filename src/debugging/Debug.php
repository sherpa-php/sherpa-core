<?php

namespace Sherpa\Core\debugging;

class Debug
{

    /**
     * Dump given values.
     *
     * @param mixed ...$values
     */
    public static function dump(mixed ...$values): void
    {
        self::loadCss();
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

    private static function loadCss(): void
    {
        echo "<style>";

        include_once ROOT . "/vendor/sherpa/core/src/precepts/sherpa-css/styles.css";

        echo "</style>";
    }

}