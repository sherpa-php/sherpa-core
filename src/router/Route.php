<?php

namespace Sherpa\Core\router;

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