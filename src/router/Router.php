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
    public static function register(HttpMethod $httpMethod, string $path): Route
    {
        return self::$routes[] = new Route($httpMethod, $path);
    }

    /**
     * Declare a GET route into router internal list.
     *
     * @param string $path Web path (from URI)
     * @return Route
     */
    public static function get(string $path): Route
    {
        return self::register(HttpMethod::GET, $path);
    }

    /**
     * Declare a POST route into router internal list.
     *
     * @param string $path Web path (from URI)
     * @return Route
     */
    public static function post(string $path): Route
    {
        return self::register(HttpMethod::POST, $path);
    }

    /**
     * @return array Routes list
     */
    public static function getRoutes(): array
    {
        return self::$routes;
    }

}