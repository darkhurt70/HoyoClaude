<?php

namespace Controllers;

use League\Plates\Engine;
use Services\AuthService;
use Services\LogService;

/**
 * Contrôleur pour gérer l'authentification
 */
class AuthController {
    private Engine $templates;
    private MainController $mainController;

    public function __construct() {
        $this->templates = new Engine('Views');
        $this->mainController = new MainController();
    }

    /**
     * Affiche la page de connexion
     *
     * @param string|null $message Message à afficher
     */
    public function displayLogin(?string $message = null): void {
        echo $this->templates->render('login', [
            'message' => $message
        ]);
    }

    /**
     * Traite la connexion
     *
     * @param string $username Nom d'utilisateur
     * @param string $password Mot de passe
     */
    public function login(string $username, string $password): void {
        if (AuthService::login($username, $password)) {
            LogService::log("Connexion réussie: $username", 'SUCCESS');
            $this->mainController->index("Bienvenue $username !");
        } else {
            LogService::log("Échec de connexion: $username", 'ERROR');
            $this->displayLogin("Identifiants invalides");
        }
    }

    /**
     * Déconnecte l'utilisateur
     */
    public function logout(): void {
        $username = AuthService::getLoggedUsername();
        AuthService::logout();
        LogService::log("Déconnexion: $username", 'INFO');
        $this->mainController->index("Vous êtes déconnecté");
    }
}
