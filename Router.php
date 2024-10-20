
<?php

namespace Core;

class Router {
    private $routes = [];

    public function addRoute($path, $handler) {
        $this->routes[$path] = $handler;
    }

    public function dispatch($uri) {
        $uri = parse_url($uri, PHP_URL_PATH);
        if (array_key_exists($uri, $this->routes)) {
            call_user_func($this->routes[$uri]);
        } else {
            echo "Erreur 404 - Page non trouvée";
        }
    }
}

