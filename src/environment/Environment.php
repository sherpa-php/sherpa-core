<?php

namespace Sherpa\Core\environment;

class Environment
{

    /**
     * @param string $key
     * @return bool If .env variable value is a "true" string
     */
    public static function isTrue(string $key): bool
    {
        return strtolower($_ENV[$key]) === "true";
    }

    /**
     * @param string $key .env variable key
     * @param string $value Given value
     * @param bool $strict If '===' operator must be used
     * @return bool If .env variable value equals given value
     */
    public static function equals(string $key, string $value, bool $strict = true): bool
    {
        return $strict
            ? $_ENV[$key] === $value
            : $_ENV[$key] == $value;
    }

}