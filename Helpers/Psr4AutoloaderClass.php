<?php

namespace Helpers;

/**
 * Autoloader PSR-4
 *
 * Cette classe permet de charger automatiquement les classes en fonction de leur namespace
 */
class Psr4AutoloaderClass {
    /**
     * Un tableau associatif où la clé est un préfixe de namespace et la valeur
     * est un tableau de répertoires de base pour les classes de ce namespace.
     *
     * @var array
     */
    protected $prefixes = array();

    /**
     * Enregistre le chargeur avec la pile d'autoload SPL.
     *
     * @return void
     */
    public function register() {
        spl_autoload_register(array($this, 'loadClass'));
    }

    /**
     * Ajoute un préfixe de namespace et un répertoire de base pour les classes.
     *
     * @param string $prefix Le préfixe de namespace.
     * @param string $base_dir Un répertoire de base pour les fichiers de classe.
     * @param bool $prepend Si vrai, prépend le répertoire de base à la pile
     * au lieu de l'ajouter; cela le fait être recherché en premier plutôt qu'en dernier.
     * @return void
     */
    public function addNamespace($prefix, $base_dir, $prepend = false) {
        // Normalise le préfixe de namespace
        $prefix = trim($prefix, '\\') . '\\';

        // Normalise le répertoire de base avec un séparateur de fin
        $base_dir = rtrim($base_dir, DIRECTORY_SEPARATOR) . '/';

        // Initialise le tableau de préfixes de namespace si nécessaire
        if (isset($this->prefixes[$prefix]) === false) {
            $this->prefixes[$prefix] = array();
        }

        // Conserve le répertoire de base pour le préfixe de namespace
        if ($prepend) {
            array_unshift($this->prefixes[$prefix], $base_dir);
        } else {
            array_push($this->prefixes[$prefix], $base_dir);
        }
    }

    /**
     * Charge le fichier de classe pour un nom de classe donné.
     *
     * @param string $class Le nom de classe qualifié complet.
     * @return mixed Le nom du fichier mappé en cas de succès, ou booléen false en
     * cas d'échec.
     */
    public function loadClass($class) {
        // Le préfixe de namespace actuel
        $prefix = $class;

        // Travaille en arrière à travers les noms de namespace du nom de classe qualifié complet
        // pour trouver un nom de fichier mappé
        while (false !== $pos = strrpos($prefix, '\\')) {

            // Conserve le séparateur de trailing namespace dans le préfixe
            $prefix = substr($class, 0, $pos + 1);

            // Le reste est le nom de classe relatif
            $relative_class = substr($class, $pos + 1);

            // Essaie de charger un fichier mappé pour le préfixe et la classe relative
            $mapped_file = $this->loadMappedFile($prefix, $relative_class);
            if ($mapped_file) {
                return $mapped_file;
            }

            // Supprime le séparateur de trailing namespace pour la prochaine itération de strrpos()
            $prefix = rtrim($prefix, '\\');
        }

        // Jamais trouvé un fichier mappé
        return false;
    }

    /**
     * Charge le fichier mappé pour un préfixe de namespace et une classe relative.
     *
     * @param string $prefix Le préfixe de namespace.
     * @param string $relative_class La classe relative.
     * @return mixed Booléen false si aucun fichier mappé ne peut être chargé, ou le
     * nom du fichier mappé qui a été chargé.
     */
    protected function loadMappedFile($prefix, $relative_class) {
        // Y a-t-il des répertoires de base pour ce préfixe de namespace?
        if (isset($this->prefixes[$prefix]) === false) {
            return false;
        }

        // Regarde à travers les répertoires de base pour ce préfixe de namespace
        foreach ($this->prefixes[$prefix] as $base_dir) {

            // Remplace le préfixe de namespace avec le répertoire de base,
            // remplace les séparateurs de namespace avec des séparateurs de répertoire
            // dans le nom de classe relative,
            // ajoute avec .php
            $file = $base_dir
                  . str_replace('\\', '/', $relative_class)
                  . '.php';

            // Si le fichier mappé existe, le requiert
            if ($this->requireFile($file)) {
                // Oui, nous avons terminé
                return $file;
            }
        }

        // Jamais trouvé
        return false;
    }

    /**
     * Si un fichier existe, le requiert du système de fichiers.
     *
     * @param string $file Le fichier à requérir.
     * @return bool Vrai si le fichier existe, faux sinon.
     */
    protected function requireFile($file) {
        if (file_exists($file)) {
            require $file;
            return true;
        }
        return false;
    }
}
