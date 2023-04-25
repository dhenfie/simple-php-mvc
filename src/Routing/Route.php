<?php
namespace System\Routing;

use BadMethodCallException;
use Exception;
use System\Routing\Collection as RouteCollection;


/**
 * Class untuk eksekusi dan menjalankan Route
 *
 * @author dhenfie <fajarsusilo1600@gmail.com>
 * @version 1.0.0
 */

/**
 * @method static RouteCollectionInterface add(string $path, string $handler)
 * @method static array getRoutes()
 * @method static void setError(string $handler)
 * @method static void reset()
 */

class Route
{
    private static string $namespace;
    private static RouteCollection $collection;

    public static function __callStatic($method, $args)
    {
        if (! isset(self::$collection)) {
            self::$collection = new RouteCollection;
            return call_user_func_array([self::$collection, $method], $args);
        } else {
            return call_user_func_array([self::$collection, $method], $args);
        }
    }

    public static function getNamespace() : string
    {
        return self::$namespace;
    }

    public static function setNamespace(string $namespace) : void
    {
        self::$namespace = $namespace;
    }

    public static function isRequestIndex() : bool
    {
        return isset($_SERVER['PATH_INFO']) ? (trim($_SERVER['PATH_INFO'], '/') === '') : true;
    }

    public static function getRouteIndexPage() : ?array
    {
        foreach (self::$collection->getRoutes() as $route) {
            if ($route['_path'] === '/') {
                return $route;
            }
        }
        return null;
    }

    public static function getRouteErrorPage() : ?array
    {
        foreach (self::$collection->getRoutes() as $route) {
            if ($route['_path'] === '_error') {
                return $route;
            }
        }
        return null;
    }

    public static function getRouteFromPath(string $path) : ?array
    {
        foreach (self::getRoutes() as $route) {
            if ($route['_path'] === $path) {
                return $route;
            }
        }
        return null;
    }

    public static function execute(array $handler) : string
    {
        $parseController = function (string $controller) : array {
            $className = explode('::', $controller);
            return $className;
        };

        $classMetaData = $parseController($handler['_handler']);
        $controller    = $classMetaData[0];
        $method        = $classMetaData[1];

        $className = self::getNamespace() . $controller;

        if (! class_exists($className)) {
            throw new Exception(sprintf('Controller %s not found!', $controller));
        } else {
            if (! method_exists(new $className, $method)) {
                throw new BadMethodCallException('Undefined method ' . $method . ' in Controller ' . $className);
            } else {
                $instance = new $className();
                return $instance->$method();
            }
        }
    }


    public static function matcher(string $path) : bool
    {
        $routes = self::$collection->getRoutes();
        foreach ($routes as $route) {
            if (preg_match('#^' . $route['_path'] . '$#', $path)) {
                return true;
            }
        }
        return false;
    }

    public static function launch() : mixed
    {
        $request = isset($_SERVER['PATH_INFO']) ? trim(strtolower($_SERVER['PATH_INFO']), '/') : '';

        if (self::isRequestIndex()) {
            return self::execute(self::getRouteIndexPage());
        } else {
            if (self::matcher($request)) {
                return self::execute(self::getRouteFromPath($request));
            } else {
                return self::execute(self::getRouteErrorPage());
            }
        }
    }
}
