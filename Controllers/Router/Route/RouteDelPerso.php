<?php

namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\PersonnageController;

class RouteDelPerso extends Route {
    private PersonnageController $controller;

    public function __construct(PersonnageController $controller) {
        $this->controller = $controller;
    }

    public function get(array $params = []): void {
        try {
            $id = parent::getParam($params, "id", false);
            $this->controller->deletePersoAndIndex($id);
        } catch (\Exception $e) {
            $this->controller->deletePersoAndIndex(null, $e->getMessage());
        }
    }

    public function post(array $params = []): void {
        $this->get($params);
    }
}
