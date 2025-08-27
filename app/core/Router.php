<?php

namespace App\Core;

class Router{
    protected $routes = [];

    public function add($route, $callback) {
        $this->routes[$route] = $callback;
    }

    public function dispatch($url) {
        $url = trim($url, '/');
        if (array_key_exists($url, $this->routes)) {
            call_user_func($this->routes[$url]);
        } else {
            http_response_code(404);
            echo "404 - Pagina no encontrada";
        }
    }
}
?>