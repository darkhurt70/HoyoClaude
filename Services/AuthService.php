<?php

namespace Services;

use Models\UserDAO;

/**
 * Service pour gérer l'authentification
 */
class AuthService {
    private const SESSION_TIMEOUT = 3600; // 1 heure

    /**
     * Vérifie les identifiants et crée une session si valide
     *
     * @param string $username Nom d'utilisateur
     * @param string $password Mot de passe
     * @return bool True si connexion réussie
     */
    public static function login(string $username, string $password): bool {
        $userDAO = new UserDAO();
        $userData = $userDAO->getByUsername($username);

        if (!$userData) {
            return false;
        }

        // Vérifie le mot de passe
        if (password_verify($password, $userData['hash_pwd'])) {
            // Démarre la session si ce n'est pas déjà fait
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            // Stocke les informations de l'utilisateur en session
            $_SESSION['userUID'] = $userData['id'];
            $_SESSION['username'] = $userData['username'];
            $_SESSION['timeout'] = time() + self::SESSION_TIMEOUT;

            return true;
        }

        return false;
    }

    /**
     * Déconnecte l'utilisateur
     */
    public static function logout(): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Supprime les variables de session
        unset($_SESSION['userUID']);
        unset($_SESSION['username']);
        unset($_SESSION['timeout']);
    }

    /**
     * Vérifie si l'utilisateur est connecté et si la session est valide
     *
     * @return bool True si l'utilisateur est connecté
     */
    public static function isLoggedIn(): bool {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['userUID']) || !isset($_SESSION['timeout'])) {
            return false;
        }

        // Vérifie si la session n'a pas expiré
        if (time() > $_SESSION['timeout']) {
            self::logout();
            return false;
        }

        // Renouvelle le timeout
        $_SESSION['timeout'] = time() + self::SESSION_TIMEOUT;

        return true;
    }

    /**
     * Récupère l'ID de l'utilisateur connecté
     *
     * @return string|null L'ID de l'utilisateur ou null
     */
    public static function getLoggedUserId(): ?string {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        return $_SESSION['userUID'] ?? null;
    }

    /**
     * Récupère le nom de l'utilisateur connecté
     *
     * @return string|null Le nom de l'utilisateur ou null
     */
    public static function getLoggedUsername(): ?string {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        return $_SESSION['username'] ?? null;
    }
}
