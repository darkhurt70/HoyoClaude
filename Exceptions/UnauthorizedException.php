<?php

namespace Exceptions;

use Exception;

/**
 * Exception levée quand un utilisateur non connecté tente d'accéder à une route protégée
 */
class UnauthorizedException extends Exception {
    public function __construct(string $message = "Vous devez être connecté pour accéder à cette page") {
        parent::__construct($message);
    }
}
