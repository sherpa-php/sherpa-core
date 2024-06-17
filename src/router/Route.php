<?php

namespace Sherpa\Core\router;

class Route
{

    private HttpMethod $httpMethod;
    private string $path;

    public function __construct($httpMethod, $path)
    {
        $this->httpMethod = $httpMethod;
        $this->path = $path;
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

}