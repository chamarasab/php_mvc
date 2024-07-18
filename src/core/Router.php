<?php

namespace Core;

class Router
{
    private $routes = [];

    public function addRoute($method, $path, $controller, $action)
    {
        $this->routes[] = compact('method', 'path', 'controller', 'action');
    }

    public function handleRequest($uri, $method)
    {
        foreach ($this->routes as $route) {
            $routePattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-zA-Z0-9_]+)', $route['path']);
            $routePattern = str_replace('/', '\/', $routePattern);
            
            if ($route['method'] === $method && preg_match('/^' . $routePattern . '$/', $uri, $matches)) {
                array_shift($matches); // Remove the full match from the beginning
                
                $controllerName = '\\Controllers\\' . $route['controller'];
                $controller = new $controllerName();
                $action = $route['action'];
                
                return call_user_func_array([$controller, $action], $matches);
            }
        }

        http_response_code(404);
        echo json_encode(['message' => 'Not Found']);
    }
}
?>
