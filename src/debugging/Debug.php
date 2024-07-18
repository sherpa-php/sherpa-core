<?php

namespace Sherpa\Core\debugging;

use Sherpa\Core\exceptions\SherpaException;

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

        echo self::getDump(false, ...$values);
    }

    /**
     * Dump given values and die.
     * "Dump and Die"
     *
     * @param mixed ...$values
     */
    public static function dd(mixed ...$values): void
    {
        $dump = self::getDump(true, ...$values);

        self::render("Debug", DebugType::MESSAGE, $dump);
    }

    public static function error(SherpaException $exception): void
    {
        self::render("Exception", DebugType::ERROR, "");
    }

    private static function render(string $title, DebugType $type, string $slot = ""): void
    {
        self::loadCss();

        $debugType = match ($type)
        {
            DebugType::INFORMATION  => " info",
            DebugType::WARNING      => " warning",
            DebugType::ERROR        => " error",
            default                 => "",
        };

        $file = __FILE__;
        $line = __LINE__;

        echo "
        <div sherpa-ui='fluid$debugType'>
          <header class='border-bottom'>
            <h1 style='margin-top: 0;'>$title</h1>
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
          
          $slot
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

            $dump .= "
            <div sherpa-ui='card info'>
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