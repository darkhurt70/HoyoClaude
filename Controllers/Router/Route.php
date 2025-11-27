<?php

namespace Controllers\Router;

use Exception;

/**
 * Classe abstraite représentant une route
 */
abstract class Route implements IRouteSecurity {

    /**
     * Exécute l'action de la route selon la méthode HTTP
     *
     * @param array $params Les paramètres de la requête
     * @param string $method La méthode HTTP (GET ou POST)
     */
    public function action(array $params = [], string $method = 'GET'): void {
        if ($method === 'POST') {
            $this->post($params);
        } else {
            $this->get($params);
        }
    }

    /**
     * Récupère un paramètre depuis un tableau
     *
     * @param array $array Le tableau contenant les paramètres
     * @param string $paramName Le nom du paramètre
     * @param bool $canBeEmpty Si le paramètre peut être vide
     * @return mixed La valeur du paramètre
     * @throws Exception Si le paramètre est absent ou vide quand il ne devrait pas l'être
     */
    protected function getParam(array $array, string $paramName, bool $canBeEmpty = true): mixed {
        if (isset($array[$paramName])) {
            if (!$canBeEmpty && empty($array[$paramName])) {
                throw new Exception("Paramètre '$paramName' vide");
            }
            return $array[$paramName];
        } else {
            throw new Exception("Paramètre '$paramName' absent");
        }
    }

    /**
     * Gère la requête GET
     *
     * @param array $params Les paramètres GET
     */
    abstract public function get(array $params = []): void;

    /**
     * Gère la requête POST
     *
     * @param array $params Les paramètres POST
     */
    abstract public function post(array $params = []): void;

    /**
     * Par défaut, les routes ne sont pas protégées
     */
    public function isRouteProtected(): bool {
        return false;
    }

    /**
     * Par défaut, ne fait rien (route non protégée)
     */
    public function protectRoute(): void {
        // Rien à faire pour une route non protégée
    }
}
