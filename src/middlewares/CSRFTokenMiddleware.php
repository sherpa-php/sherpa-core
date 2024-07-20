<?php

namespace Sherpa\Core\middlewares;

use Sherpa\Core\controllers\Request;
use Sherpa\Core\csrf\exceptions\InvalidCSRFTokenException;
use Sherpa\Core\csrf\exceptions\NoneCSRFTokenException;
use Sherpa\Core\csrf\exceptions\SessionWithoutCSRFException;
use Sherpa\Core\router\exceptions\InvalidHttpMethodException;
use Sherpa\Core\router\HttpMethod;
use Sherpa\Core\router\Router;
use Sherpa\Core\session\Session;

class CSRFTokenMiddleware extends Middleware
{

    /**
     * @throws NoneCSRFTokenException
     * @throws InvalidHttpMethodException
     * @throws SessionWithoutCSRFException
     * @throws InvalidCSRFTokenException
     */
    public function handle(Request $request): void
    {
        if (Session::getCSRFToken() === null)
        {
            throw new SessionWithoutCSRFException();
        }

        if (Router::getHttpMethod() !== HttpMethod::POST)
        {
            $this->finish();
        }

        if (!$request->hasCSRFToken())
        {
            throw new NoneCSRFTokenException();
        }

        if (!Session::getCSRFToken()->verify($request->getCSRFToken()))
        {
            throw new InvalidCSRFTokenException();
        }

        $this->finish();

    }

}