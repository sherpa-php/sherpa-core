<?php

namespace Sherpa\Core\router;

use Sherpa\Core\router\exceptions\InvalidHttpMethodException;

class Router
{

    private static array $routes = [];

    /**
     * Declare a new route into router internal list.
     *
     * @param HttpMethod $httpMethod Route HTTP method
     * @param string $path Web path (from URI)
     * @param string $controllerClass Controller to use with route
     * @param string $controllerMethod Controller method to run
     * @return Route
     */
    public static function register(HttpMethod $httpMethod,
                                    string $path,
                                    string $controllerClass,
                                    string $controllerMethod): Route
    {
        return self::$routes[] = new Route($httpMethod, $path, $controllerClass, $controllerMethod);
    }

    /**
     * Declare a GET route into router internal list.
     *
     * @param string $path Web path (from URI)
     * @return Route
     */
    public static function get(string $path, string $controllerClass, string $controllerMethod): Route
    {
        return self::register(HttpMethod::GET, $path, $controllerClass, $controllerMethod);
    }

    /**
     * Declare a POST route into router internal list.
     *
     * @param string $path Web path (from URI)
     * @return Route
     */
    public static function post(string $path, string $controllerClass, string $controllerMethod): Route
    {
        return self::register(HttpMethod::POST, $path, $controllerClass, $controllerMethod);
    }

    /**
     * @return array Routes list
     */
    public static function getRoutes(): array
    {
        return self::$routes;
    }

    /**
     * Search and return last route using given path.
     *
     * @param string $path
     * @return Route|null Route object or null
     *                    if none uses given path
     * @throws InvalidHttpMethodException
     */
    public static function getRouteByPath(string $path): ?Route
    {
        $routeFilter = array_filter(self::getRoutes(), function ($route) use ($path)
        {
            return $route->getPath() === "/$path"
                && $route->getHttpMethod() === Router::getHttpMethod();
        });

        return end($routeFilter) ?: null;
    }

    /**
     * @return HttpMethod Current request HTTP method
     * @throws InvalidHttpMethodException If current HTTP method is invalid
     */
    public static function getHttpMethod(): HttpMethod
    {
        return match ($_SERVER["REQUEST_METHOD"])
        {
            "GET"   =>  HttpMethod::GET,
            "POST"  =>  HttpMethod::POST,
            default =>  throw new InvalidHttpMethodException(),
        };
    }

}