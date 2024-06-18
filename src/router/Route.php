<?php

namespace Sherpa\Core\router;

use Sherpa\Core\controllers\exceptions\ControllerClassOrMethodNotFoundException;
use Sherpa\Core\router\exceptions\InvalidHttpMethodException;
use Sherpa\Core\router\exceptions\RouteAndCurrentHttpMethodsDoesNotMatchException;

class Route
{

    private HttpMethod $httpMethod;
    private string $path;
    private string $controllerClass;
    private string $controllerMethod;

    public function __construct($httpMethod, $path, $controllerClass, $controllerMethod)
    {
        $this->httpMethod = $httpMethod;
        $this->path = $path;
        $this->controllerClass = $controllerClass;
        $this->controllerMethod = $controllerMethod;
    }

    /**
     * @throws RouteAndCurrentHttpMethodsDoesNotMatchException
     * @throws ControllerClassOrMethodNotFoundException|InvalidHttpMethodException
     */
    public function run(): void
    {
        if ($this->getHttpMethod() !== Router::getHttpMethod())
        {
            throw new RouteAndCurrentHttpMethodsDoesNotMatchException();
        }

        if (!method_exists($this->getControllerClass(), $this->controllerMethod))
        {
            throw new ControllerClassOrMethodNotFoundException();
        }

        $controllerInstance = new ($this->getControllerClass())();
        call_user_func([$controllerInstance, $this->getControllerMethod()], "Hello, World! :)");
    }

    /**
     * @return HttpMethod Route HTTP method
     */
    public function getHttpMethod(): HttpMethod
    {
        return $this->httpMethod;
    }

    /**
     * @return string Route URI path
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return string Route controller class name
     */
    public function getControllerClass(): string
    {
        return $this->controllerClass;
    }

    /**
     * @return string Route controller method
     */
    public function getControllerMethod(): string
    {
        return $this->controllerMethod;
    }

}