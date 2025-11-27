<?php

namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\PersonnageController;

class RouteAddPerso extends Route {
    private PersonnageController $controller;

    public function __construct(PersonnageController $controller) {
        $this->controller = $controller;
    }

    public function get(array $params = []): void {
        $message = $params['message'] ?? null;
        $this->controller->displayAddPerso($message);
    }

    public function post(array $params = []): void {
        try {
            $data = [
                "name" => parent::getParam($params, "perso-nom", false),
                "element" => isset($params["perso-element"]) ? intval($params["perso-element"]) : null,
                "unitclass" => isset($params["perso-unitclass"]) ? intval($params["perso-unitclass"]) : null,
                "rarity" => intval(parent::getParam($params, "perso-rarity", false)),
                "origin" => isset($params["perso-origin"]) ? intval($params["perso-origin"]) : null,
                "urlImg" => parent::getParam($params, "perso-img", false)
            ];
            $this->controller->addPerso($data);
        } catch (\Exception $e) {
            $this->controller->displayAddPerso($e->getMessage());
        }
    }
}
