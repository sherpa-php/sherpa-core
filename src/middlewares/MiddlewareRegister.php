<?php

namespace Sherpa\Core\middlewares;

use Sherpa\Core\environment\Environment;

class MiddlewareRegister
{

    private array $middlewares;
    private static self $instance;

    public function __construct()
    {
        $this->middlewares = [];

        $this->registerInternalMiddlewares();
    }

    /**
     * Register given middlewares.
     *
     * @param array $middlewares Middlewares array to register
     */
    public function register(array $middlewares): void
    {
        $this->middlewares = array_merge($this->getMiddlewares(), $middlewares);
    }

    /**
     * @return array Registered middlewares array
     */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }

    /**
     * Register internal middlewares
     */
    private function registerInternalMiddlewares(): void
    {
        if (Environment::isTrue("ENABLE_CSRF"))
        {
            $this->register([ "csrf" => CSRFTokenMiddleware::class ]);
        }
    }

    /**
     * @param string $middlewareName
     * @return bool If middleware is registered
     */
    public function has(string $middlewareName): bool
    {
        return isset($this->getMiddlewares()[$middlewareName]);
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