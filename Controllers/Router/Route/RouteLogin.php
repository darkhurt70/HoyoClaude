<?php

namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\AuthController;

class RouteLogin extends Route {
    private AuthController $controller;

    public function __construct(AuthController $controller) {
        $this->controller = $controller;
    }

    public function get(array $params = []): void {
        $message = $params['message'] ?? null;
        $this->controller->displayLogin($message);
    }

    public function post(array $params = []): void {
        try {
            $username = parent::getParam($params, "username", false);
            $password = parent::getParam($params, "password", false);

            $this->controller->login($username, $password);
        } catch (\Exception $e) {
            $this->controller->displayLogin($e->getMessage());
        }
    }
}
