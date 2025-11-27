<?php

namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\ElementController;

class RouteAddElement extends Route {
    private ElementController $controller;

    public function __construct(ElementController $controller) {
        $this->controller = $controller;
    }

    public function get(array $params = []): void {
        $message = $params['message'] ?? null;
        $this->controller->displayAddElement($message);
    }

    public function post(array $params = []): void {
        try {
            $type = parent::getParam($params, "element-type", false);
            $name = parent::getParam($params, "element-name", false);
            $img = parent::getParam($params, "element-img", false);

            $this->controller->addElement($type, $name, $img);
        } catch (\Exception $e) {
            $this->controller->displayAddElement($e->getMessage());
        }
    }
}
