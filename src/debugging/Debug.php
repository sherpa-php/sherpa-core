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

        $file = __FILE__;
        $line = __LINE__;

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

    private static function getDump(mixed ...$values): string
    {
        $dump = "";

        foreach ($values as $value)
        {
            $valueType = gettype($value);

            $dump .= "
            <div class='dump-container'>
              <p>
                <span class='value-type'>$valueType</span>
              </p>
              
              $value
            </div>
            ";
        }

        return $dump;
    }

}