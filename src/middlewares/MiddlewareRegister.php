<?php

namespace Sherpa\Core\middlewares;

class MiddlewareRegister
{

    private array $middlewares;
    private static self $instance;

    public function __construct()
    {
        $this->middlewares = [];
    }

    /**
     * Register given middlewares.
     *
     * @param array $middlewares Middlewares array to register
     */
    public function register(array $middlewares): void
    {
        $this->middlewares = $middlewares;
    }

    /**
     * @return array Registered middlewares array
     */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }

    /**
     * @return self Current instance
     */
    public static function getInstance(): self
    {
        if (!isset(self::$instance))
        {
            self::$instance = new self();
        }

        return self::$instance;
    }

}