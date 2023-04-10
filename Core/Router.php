<?php

namespace Core;

/**
 * Router of PHP-Messenger
 */
class Router
{
    /**
     * Array holding all available routes
     * @var array
     */
    protected $routes = [];

    /**
     * Handle all get
     * @param mixed $uri
     * @param mixed $controller
     * @return Router
     */
    public function get($uri, $controller)
    {
        return $this->add($uri, $controller, 'GET');
    }

    /**
     * Handle all post
     * @param mixed $uri
     * @param mixed $controller
     * @return Router
     */
    public function post($uri, $controller)
    {
        return $this->add($uri, $controller, 'POST');
    }

    /**
     * Handle all delete requests.
     * @param mixed $uri
     * @param mixed $controller
     * @return Router
     */
    public function delete($uri, $controller)
    {
        return $this->add($uri, $controller, 'DELETE');
    }

    /**
     * Handle all put requests.
     * @param mixed $uri
     * @param mixed $controller
     * @return Router
     */
    public function put($uri, $controller)
    {
        return $this->add($uri, $controller, 'PUT');
    }

    /**
     * Handle all patch requests.
     * @param mixed $uri
     * @param mixed $controller
     * @return Router
     */
    public function patch($uri, $controller)
    {
        return $this->add($uri, $controller, 'PATCH');
    }

    /**
     * Handle all add requests.
     * @param mixed $uri
     * @param mixed $controller
     * @param mixed $method
     * @return Router
     */
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

    /**
     * Find matching uri and handle request.
     * @param mixed $uri
     * @param mixed $method
     * @return mixed
     */
    public function route($uri, $method)
    {

        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                return require base_path($route['controller']);
            }
        }

        $this->abort();
    }

    /**
     * Load view for different error codes.
     * @param int $code
     * @return never
     */
    protected function abort($code = 404)
    {
        http_response_code($code);

        require view("{$code}.php");

        die();
    }
}