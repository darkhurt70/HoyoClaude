<?php

namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\PersonnageController;

class RouteEditPerso extends Route {
    private PersonnageController $controller;

    public function __construct(PersonnageController $controller) {
        $this->controller = $controller;
    }

    public function get(array $params = []): void {
        try {
            $id = parent::getParam($params, "id", false);
            $this->controller->displayEditPerso($id);
        } catch (\Exception $e) {
            $this->controller->deletePersoAndIndex(null, $e->getMessage());
        }
    }

    public function post(array $params = []): void {
        try {
            $data = [
                "id" => parent::getParam($params, "perso-id", false),
                "name" => parent::getParam($params, "perso-nom", false),
                "element" => isset($params["perso-element"]) ? intval($params["perso-element"]) : null,
                "unitclass" => isset($params["perso-unitclass"]) ? intval($params["perso-unitclass"]) : null,
                "rarity" => intval(parent::getParam($params, "perso-rarity", false)),
                "origin" => isset($params["perso-origin"]) ? intval($params["perso-origin"]) : null,
                "urlImg" => parent::getParam($params, "perso-img", false)
            ];
            $this->controller->editPersoAndIndex($data);
        } catch (\Exception $e) {
            $this->controller->displayEditPerso($params["perso-id"] ?? "", $e->getMessage());
        }
    }
}
