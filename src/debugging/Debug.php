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

        echo "
        <div sherpa-ui='fluid:debug'>
          <h1 style='margin-top: 0;'>Debug</h1>
        </div>
        ";
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

    /**
     * Load debug UI CSS stylesheet into a style tag.
     */
    private static function loadCss(): void
    {
        echo "<style>";

        include_once __DIR__ . "/../precepts/sherpa-css/styles.css";

        echo "</style>";
    }

}