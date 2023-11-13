<?php

use Controllers\PageController;

require_once __DIR__.'/../Controllers/PageController.php';

class Router
{
    private array $routes = [];

    private function resolve(string $uri)
    {
        foreach ($this->routes as $route => $method) {
            $matches = [];
            $pattern = str_replace('/', '\/', $route);
            if (preg_match("/^$pattern$/i", $uri, $matches)) {
                //first match is the route
                unset($matches[0]);
                $method(...$matches);
                return;
            };
        }
        $this->notFound();
    }

    public function start()
    {
        $uri = rtrim($_SERVER['REQUEST_URI'], '/') ?: '/';
        $this->resolve($uri);
    }

    public function add($route, $method)
    {
        $this->routes[$route] = $method;
    }

    private function notFound()
    {
        header("HTTP/1.0 404 Not Found");
        echo "<h1>404 Not Found</h1>";
    }
}

$router = new Router();

$router->add('/', [new PageController(), 'home']);

$router->add('/(folder[12])', [new PageController(), 'folder']);

return $router;
