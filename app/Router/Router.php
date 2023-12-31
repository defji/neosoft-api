<?php

namespace NeosoftApi\Router;


use NeosoftApi\Controllers\UserController;

class Router
{
    private $routes = [];

    /**
     * Adding endpoints to router
     * @param $method
     * @param $path
     * @param $controller
     * @return void
     */
    public function addRoute($method, $path, $controller)
    {
        $this->routes[] = [
            'method'     => $method,
            'path'       => $path,
            'controller' => $controller,
        ];
    }

    /**
     * @return void
     */
    public function route()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $route['path'] === $path) {
                [$controllerName, $methodName] = explode('@', $route['controller']);
                $controllerClass = 'NeosoftApi\Controllers\\'.$controllerName;
                $controller = new $controllerClass();
                $controller->$methodName();
                return;
            }
        }

        http_response_code(404);
        echo "Endpoint not found.";
    }
}
