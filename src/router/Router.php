<?php

namespace Sherpa\Core\router;

class Router
{

    private static array $routes = [];

    /**
     * Declare a new route into router internal list.
     *
     * @param HttpMethod $method HTTP request method
     * @param string $path Web path (from URI)
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
     */
    public static function getRouteByPath(string $path): ?Route
    {
        $routeFilter = array_filter(self::getRoutes(), function ($route) use ($path)
        {
            return $route->getPath() === "/$path";
        });

        return end($routeFilter) ?: null;
    }

}