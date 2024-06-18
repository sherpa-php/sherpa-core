<?php

namespace Sherpa\Core\router;

use Sherpa\Core\controllers\exceptions\ControllerClassOrMethodNotFoundException;
use Sherpa\Core\router\exceptions\InvalidHttpMethodException;
use Sherpa\Core\router\exceptions\NameIsAlreadyUsedException;
use Sherpa\Core\router\exceptions\RouteAndCurrentHttpMethodsDoesNotMatchException;

class Route
{
    private const PATH_VARIABLE_REGEXP = "/\{([a-z]+)}/";

    private HttpMethod $httpMethod;
    private string $path;
    private string $controllerClass;
    private string $controllerMethod;
    private ?string $name;
    private array $parameters;

    public function __construct($httpMethod, $path, $controllerClass, $controllerMethod)
    {
        $this->httpMethod = $httpMethod;
        $this->path = $path;
        $this->controllerClass = $controllerClass;
        $this->controllerMethod = $controllerMethod;
        $this->name = null;
        $this->parameters = [];

        // $this->prepareParametersArray();
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
        call_user_func([$controllerInstance, $this->getControllerMethod()],
                       ...$this->getParameters());
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
     * @return string Route path
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
        $escapedPath = str_replace('/', '\/', $this->getPath());

        return preg_replace(self::PATH_VARIABLE_REGEXP,
                            "([^\/]+)",
                            $escapedPath);
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

    /**
     * @return array Path parameters
     *               (like /hello/{name} => /hello/john)
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * Append a new parameter for route path
     *
     * @param mixed $value Parameter value
     * @return $this
     */
    public function addParameter(mixed $value): Route
    {
        $this->parameters[] = $value;

        return $this;
    }

    /**
     * Initialize route parameters array by adding keys.
     */
    private function prepareParametersArray(): void
    {
        preg_match_all(self::PATH_VARIABLE_REGEXP,
                       $this->getPath(),
                       $parameters);

        if (count($parameters))
        {
            unset($parameters[0]);

            foreach ($parameters[1] as $parameter)
            {
                $this->parameters[$parameter] = null;
            }
        }
    }

}