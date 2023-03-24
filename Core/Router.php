<?php

namespace Core;

//
// Router for the messenger app
//
class Router
{
    // protected variables
    protected $routes = [];

    // Available HTTP methods:
    public function get($uri, $controller)
    {
        return $this->add($uri, $controller, 'GET');
    }

    public function post($uri, $controller)
    {
        return $this->add($uri, $controller, 'POST');
    }

    public function delete($uri, $controller)
    {
        return $this->add($uri, $controller, 'DELETE');
    }

    public function put($uri, $controller)
    {
        return $this->add($uri, $controller, 'PUT');
    }

    public function patch($uri, $controller)
    {
        return $this->add($uri, $controller, 'PATCH');
    }

    // add a new route to the table $routes
    protected function add($uri, $controller, $method)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
            'middleware' => null
        ];

        return $this;
    }

    // Find and require requested uri with matching method
    public function route($uri, $method)
    {

        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                return require base_path($route['controller']);
            }
        }

        $this->abort();
    }

    // loads view for different html response codes
    protected function abort($code = 404)
    {
        http_response_code($code);

        require view("{$code}.php");

        die();
    }
}