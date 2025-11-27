<?php

/**
 * Point d'entrée de l'application Mihoyo Collection
 */

// Charge l'autoloader PSR-4
require_once 'Helpers/Psr4AutoloaderClass.php';

$loader = new Helpers\Psr4AutoloaderClass();
$loader->register();

// Enregistre les namespaces
$loader->addNamespace('Helpers', 'Helpers');
$loader->addNamespace('Config', 'Config');
$loader->addNamespace('Models', 'Models');
$loader->addNamespace('Controllers', 'Controllers');
$loader->addNamespace('Services', 'Services');
$loader->addNamespace('Exceptions', 'Exceptions');
$loader->addNamespace('League\Plates', 'Vendor/Plates/src');

// Crée le routeur et effectue le routage
use Controllers\Router\Router;

$router = new Router();
$router->routing($_GET, $_POST);
