<?php

namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\MainController;

/**
 * Route pour la page d'accueil
 */
class RouteIndex extends Route {
    private MainController $controller;

    public function __construct(MainController $controller) {
        $this->controller = $controller;
    }

    public function get(array $params = []): void {
        $message = $params['message'] ?? null;
        $this->controller->index($message);
    }

    public function post(array $params = []): void {
        $this->get($params);
    }
}
