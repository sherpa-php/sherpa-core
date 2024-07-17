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

        echo self::getDump(...$values);
    }

    /**
     * Dump given values and die.
     * "Dump and Die"
     *
     * @param mixed ...$values
     */
    public static function dd(mixed ...$values): void
    {
        self::loadCss();

        $file = __FILE__;
        $line = __LINE__;

        $dump = self::getDump(...$values);

        echo "
        <div sherpa-ui='fluid'>
          <header class='border-bottom'>
            <h1 style='margin-top: 0;'>Debug</h1>
          </header>
          
          <ul class='no-list-style border-bottom'>
            <li>
              <strong>File:</strong>
              <span class='font-mono code-quote'>$file</span>
            </li>
            
            <li>
              <strong>Line:</strong>
              <span class='font-mono code-quote'>$line</span>
            </li>
          </ul>
          
          $dump
        </div>
        ";

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

    private static function getDump(bool $intoFluid = true, mixed ...$values): string
    {
        $dump = "";

        foreach ($values as $valueName => $value)
        {
            $valueType = gettype($value);

            ob_start();
            var_dump($value);
            $valueDump = ob_get_clean();

            $additionalSherpaProperty = $intoFluid
                ? " info"
                : "";

            $dump .= "
            <div sherpa-ui='card$additionalSherpaProperty'>
              <p>
                <span class='value-name font-mono'>[$valueName]</span>
              </p>
              
              <pre>$valueDump</pre>
            </div>
            ";
        }

        return $dump;
    }

}