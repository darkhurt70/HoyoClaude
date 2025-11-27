<?php

namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\AuthController;

class RouteLogout extends Route {
    private AuthController $controller;

    public function __construct(AuthController $controller) {
        $this->controller = $controller;
    }

    public function get(array $params = []): void {
        $this->controller->logout();
    }

    public function post(array $params = []): void {
        $this->get($params);
    }
}
