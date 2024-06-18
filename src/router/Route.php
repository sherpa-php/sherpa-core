<?php

namespace Sherpa\Core\router;

use Sherpa\Core\controllers\exceptions\ControllerClassOrMethodNotFoundException;
use Sherpa\Core\router\exceptions\InvalidHttpMethodException;
use Sherpa\Core\router\exceptions\NameIsAlreadyUsedException;
use Sherpa\Core\router\exceptions\RouteAndCurrentHttpMethodsDoesNotMatchException;

class Route
{

    private HttpMethod $httpMethod;
    private string $path;
    private string $controllerClass;
    private string $controllerMethod;
    private ?string $name;

    public function __construct($httpMethod, $path, $controllerClass, $controllerMethod)
    {
        $this->httpMethod = $httpMethod;
        $this->path = $path;
        $this->controllerClass = $controllerClass;
        $this->controllerMethod = $controllerMethod;
        $this->name = null;
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
     * Rename current route with given name if it is not already used.
     *
     * @param string $name
     * @return Route
     */
    public function name(string $name): Route
    {
        if (Router::getRouteByName($name) === null)
        {
            $this->name = $name;
        }

        return $this;
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
     * @return string Route prepared path
     */
    public function getPreparedPath(): string
    {
        return preg_replace("/{([a-z]+)}/",
                            "([^\/]+)",
                            $this->getPath());
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

    /**
     * @return string|null Route name
     */
    public function getName(): ?string
    {
        return $this->name;
    }

}