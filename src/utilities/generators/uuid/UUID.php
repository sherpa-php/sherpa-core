<?php

namespace Sherpa\Core\utilities\generators\uuid;

use Sherpa\Core\utilities\generators\uuid\exceptions\InvalidUUIDException;

class UUID
{

    private string $token;

    /**
     * @throws InvalidUUIDException If generated token is an invalid UUID
     */
    public function __construct(string $token)
    {
        if (!self::is($token))
        {
            throw new InvalidUUIDException($token);
        }

        $this->token = $token;
    }

    /**
     * @return string UUID token
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * Generate an UUID object.
     *
     * @throws InvalidUUIDException
     * @return UUID|false UUID object or FALSE if generated token is an invalid UUID
     */
    public static function generate(): UUID|false
    {

        $token = sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), // Génère les parties du UUID
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000, // 4-bits pour version 4
            mt_rand(0, 0x3fff) | 0x8000, // 2-bits pour variant DCE1.1
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );

        return self::is($token)
            ? new self($token)
            : false;

    }

    /**
     * @param string $expression Expression to evaluate
     * @return bool If given expression is a valid UUID token
     */
    public static function is(string $expression): bool
    {
        return preg_match(
           '/^[a-f0-9]{8}-[a-f0-9]{4}-[1-5][a-f0-9]{3}-[89ab][a-f0-9]{3}-[a-f0-9]{12}$/i',
           $expression) === 1;
    }

}