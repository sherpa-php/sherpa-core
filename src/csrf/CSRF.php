<?php

namespace Sherpa\Core\csrf;

use Sherpa\Core\utilities\generators\uuid\exceptions\InvalidUUIDException;
use Sherpa\Core\utilities\generators\uuid\UUID;

class CSRF
{
    private UUID $token;

    /** @throws InvalidUUIDException */
    public function __construct()
    {
        $this->generateToken();
        $this->storeToken();
    }

    /**
     * Generate a new CSRF object.
     *
     * @throws InvalidUUIDException
     */
    private function generateToken(): void
    {
        $this->token = UUID::generate();
    }

    /**
     * Store as $_SESSION variable the CSRF token.
     */
    private function storeToken(): void
    {
        $_SESSION["sherpa-csrf-token"] = $this;
    }

    public function verify(string $token): bool
    {
        return $token === $this->getToken();
    }

    /**
     * @return UUID CSRF token
     */
    public function getToken(): UUID
    {
        return $this->token;
    }

    public static function generate(): CSRF
    {
        return new self();
    }
}