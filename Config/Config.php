<?php

namespace Config;

use Exception;

/**
 * Classe de configuration pour gérer les paramètres de l'application
 */
class Config {
    private static $param;

    /**
     * Renvoie la valeur d'un paramètre de configuration
     *
     * @param string $nom Le nom du paramètre
     * @param mixed $valeurParDefaut La valeur par défaut si le paramètre n'existe pas
     * @return mixed La valeur du paramètre
     */
    public static function get($nom, $valeurParDefaut = null) {
        if (isset(self::getParameter()[$nom])) {
            $valeur = self::getParameter()[$nom];
        } else {
            $valeur = $valeurParDefaut;
        }
        return $valeur;
    }

    /**
     * Renvoie le tableau des paramètres en le chargeant au besoin
     *
     * @return array Le tableau des paramètres
     * @throws Exception Si aucun fichier de configuration n'est trouvé
     */
    private static function getParameter() {
        if (self::$param == null) {
            $cheminFichier = "Config/prod.ini";

            if (!file_exists($cheminFichier)) {
                $cheminFichier = "Config/dev.ini";
            }

            if (!file_exists($cheminFichier)) {
                throw new Exception("Aucun fichier de configuration trouvé");
            } else {
                self::$param = parse_ini_file($cheminFichier);
            }
        }
        return self::$param;
    }
}
