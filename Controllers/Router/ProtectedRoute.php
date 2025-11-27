<?php

namespace Controllers\Router;

use Services\AuthService;
use Exceptions\UnauthorizedException;

/**
 * Classe abstraite pour les routes nécessitant une authentification
 */
abstract class ProtectedRoute extends Route {
    private bool $isLoginRequired = true;
    private ?string $loggedUserId = null;

    /**
     * Les routes protégées nécessitent une authentification
     */
    public function isRouteProtected(): bool {
        return true;
    }

    /**
     * Vérifie que l'utilisateur est authentifié
     *
     * @throws UnauthorizedException Si l'utilisateur n'est pas connecté
     */
    public function protectRoute(): void {
        if (!AuthService::isLoggedIn()) {
            throw new UnauthorizedException();
        }

        // Stocke l'ID de l'utilisateur connecté
        $this->loggedUserId = AuthService::getLoggedUserId();
    }

    /**
     * Récupère l'ID de l'utilisateur connecté
     *
     * @return string|null
     */
    public function getLoggedUserId(): ?string {
        return $this->loggedUserId;
    }

    /**
     * Définit l'ID de l'utilisateur connecté
     *
     * @param string $loggedUserId
     */
    public function setLoggedUserId(string $loggedUserId): void {
        $this->loggedUserId = $loggedUserId;
    }
}
