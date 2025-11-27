<?php

namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\MainController;

class RouteLogs extends Route {
    private MainController $controller;

    public function __construct(MainController $controller) {
        $this->controller = $controller;
    }

    public function get(array $params = []): void {
        $logFile = $params['file'] ?? null;
        $this->controller->displayLogs($logFile);
    }

    public function post(array $params = []): void {
        $this->get($params);
    }
}
