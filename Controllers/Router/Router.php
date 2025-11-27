<?php

namespace Controllers\Router;

use Controllers\MainController;
use Controllers\PersonnageController;
use Controllers\ElementController;
use Controllers\AuthController;
use Controllers\Router\Route\RouteIndex;
use Controllers\Router\Route\RouteAddPerso;
use Controllers\Router\Route\RouteEditPerso;
use Controllers\Router\Route\RouteDelPerso;
use Controllers\Router\Route\RouteAddElement;
use Controllers\Router\Route\RouteLogs;
use Controllers\Router\Route\RouteLogin;
use Controllers\Router\Route\RouteLogout;
use Controllers\Router\Route\RouteProtected;
use Exceptions\RouteNotFoundException;
use Exceptions\UnauthorizedException;

/**
 * Classe Router pour gérer le routage de l'application
 */
class Router {
    private array $routeList = [];
    private array $ctrlList = [];
    private string $actionKey;

    /**
     * Constructeur
     *
     * @param string $nameOfActionKey Le nom de la clé d'action dans les paramètres GET
     */
    public function __construct(string $nameOfActionKey = "action") {
        $this->actionKey = $nameOfActionKey;
        $this->createControllerList();
        $this->createRouteList();
    }

    /**
     * Crée la liste des contrôleurs
     */
    private function createControllerList(): void {
        $this->ctrlList = [
            "main" => new MainController(),
            "personnage" => new PersonnageController(),
            "element" => new ElementController(),
            "auth" => new AuthController()
        ];
    }

    /**
     * Crée la liste des routes
     */
    private function createRouteList(): void {
        $this->routeList = [
            "index" => new RouteIndex($this->ctrlList["main"]),
            "add-perso" => new RouteAddPerso($this->ctrlList["personnage"]),
            "edit-perso" => new RouteEditPerso($this->ctrlList["personnage"]),
            "del-perso" => new RouteDelPerso($this->ctrlList["personnage"]),
            "add-element" => new RouteAddElement($this->ctrlList["element"]),
            "logs" => new RouteLogs($this->ctrlList["main"]),
            "login" => new RouteLogin($this->ctrlList["auth"]),
            "logout" => new RouteLogout($this->ctrlList["auth"]),
            "protected" => new RouteProtected($this->ctrlList["main"])
        ];
    }

    /**
     * Effectue le routage selon les paramètres GET et POST
     *
     * @param array $get Les paramètres GET
     * @param array $post Les paramètres POST
     */
    public function routing(array $get, array $post): void {
        try {
            // Détermine la méthode HTTP
            $method = empty($post) ? 'GET' : 'POST';

            // Détermine l'action à exécuter
            $action = $get[$this->actionKey] ?? 'index';

            // Vérifie si la route existe
            if (!isset($this->routeList[$action])) {
                throw new RouteNotFoundException($action);
            }

            // Récupère la route
            $route = $this->routeList[$action];

            // Protège la route si nécessaire
            if ($route->isRouteProtected()) {
                $route->protectRoute();
            }

            // Exécute l'action selon la méthode
            if ($method === 'POST') {
                $route->action($post, 'POST');
            } else {
                $route->action($get, 'GET');
            }

        } catch (UnauthorizedException $e) {
            // Redirige vers la page de connexion
            $loginRoute = $this->routeList["login"];
            $loginRoute->action(['message' => $e->getMessage()], 'GET');
        } catch (RouteNotFoundException $e) {
            // Redirige vers la page d'accueil avec un message d'erreur
            $indexRoute = $this->routeList["index"];
            $indexRoute->action(['message' => $e->getMessage()], 'GET');
        } catch (\Exception $e) {
            // Erreur générique
            $indexRoute = $this->routeList["index"];
            $indexRoute->action(['message' => "Erreur : " . $e->getMessage()], 'GET');
        }
    }
}
