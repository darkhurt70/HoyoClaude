<?php

namespace Controllers\Router;

/**
 * Interface pour définir si une route est protégée
 */
interface IRouteSecurity {
    /**
     * Indique si la route est protégée
     *
     * @return bool True si la route nécessite une authentification
     */
    public function isRouteProtected(): bool;

    /**
     * Protège la route en vérifiant l'authentification
     *
     * @throws \Exceptions\UnauthorizedException Si l'utilisateur n'est pas authentifié
     */
    public function protectRoute(): void;
}
