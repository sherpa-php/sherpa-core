<?php

namespace Sherpa\Core\controllers;

use Sherpa\Core\environment\Environment;
use Sherpa\Core\middlewares\exceptions\NotRegisteredMiddlewareException;
use Sherpa\Core\middlewares\MiddlewareRegister;

class Controller
{

    private Request $request;

    /** @throws NotRegisteredMiddlewareException */
    public function __construct()
    {
        $this->request = new Request();

        if (Environment::isTrue("ENABLE_CSRF"))
        {
            $this->middleware("csrf");
        }
    }

    /**
     * @throws NotRegisteredMiddlewareException
     */
    protected function middleware(string $middlewareName): void
    {
        $middleware = MiddlewareRegister::getInstance()->getMiddlewares()[$middlewareName]
            ?? throw new NotRegisteredMiddlewareException($middlewareName);

        $middlewareInstance = new $middleware();
        $middlewareInstance->handle($this->getRequest());
    }

    public function getRequest(): Request
    {
        return $this->request;
    }

}