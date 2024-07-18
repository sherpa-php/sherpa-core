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

        $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1);
        $file = $backtrace[0]["file"];
        $line = $backtrace[0]["line"];

        echo self::getDump($values, $file, $line, false);
    }

    /**
     * Dump given values and die.
     * "Dump and Die"
     *
     * @param mixed ...$values
     */
    public static function dd(mixed ...$values): void
    {
        $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1);
        $file = $backtrace[0]["file"];
        $line = $backtrace[0]["line"];

        $dump = self::getDump($values, intoFluid: true);

        self::render($file,
                     $line,
                     "Debug",
                     DebugType::MESSAGE,
                     [],
                     $dump);
    }

    public static function error(SherpaException $exception): void
    {
        $additionalProperties = [
            "Exception class" => get_class($exception),
            "Exception code" => $exception->getCode(),
        ];

        $slot = "
        <p>
          <strong>Message:</strong>
          {$exception->getMessage()}
        </p>
        ";

        self::render($exception->getFile(),
                     $exception->getLine(),
                     "Exception",
                     DebugType::ERROR,
                     $additionalProperties,
                     $slot);
    }

    private static function render(
        string $file,
        int $line,
        string $title,
        DebugType $type,
        array $additionalProperties = [],
        string $slot = ""): void
    {
        self::loadCss();

        $debugType = match ($type)
        {
            DebugType::INFORMATION  => " info",
            DebugType::WARNING      => " warning",
            DebugType::ERROR        => " error",
            default                 => "",
        };

        $additionalPropertiesSlot = "";

        foreach ($additionalProperties as $propertyKey => $property)
        {
            $additionalPropertiesSlot .= "
            <li>
              <strong>$propertyKey:</strong>
              <span class='font-mono code-quote'>$property</span>
            </li>
            ";
        }

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
            
            $additionalPropertiesSlot
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

    private static function getDump(
        array $values,
        ?string $file = null,
        ?int $line = null,
        bool $intoFluid = true): string
    {
        $dump = "";

        foreach ($values as $valueIndex => $value)
        {
            $valueType = gettype($value);

            ob_start();
            var_dump($value);
            $valueDump = ob_get_clean();

            $sourceSlot = $file !== null && $line !== null
                ? "<span class='font-mono text-small text-light'>
                     $file:$line
                   </span>"
                : "";

            $dump .= "
            <div sherpa-ui='card info'>
              <p>
                <span class='value-name font-mono' 
                      style='margin-right: 10px;'>
                      
                  [$valueIndex]
                </span>
                $sourceSlot
              </p>
              
              <pre>$valueDump</pre>
            </div>
            ";
        }

        return $dump;
    }

}