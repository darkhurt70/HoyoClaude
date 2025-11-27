<?php

namespace Exceptions;

use Exception;

/**
 * Exception levée quand une route n'est pas trouvée
 */
class RouteNotFoundException extends Exception {
    public function __construct(string $action = "") {
        $message = "Route non trouvée" . ($action ? ": $action" : "");
        parent::__construct($message);
    }
}
