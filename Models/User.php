<?php

namespace Models;

/**
 * Modèle User
 * Représente un utilisateur du système
 */
class User {
    private ?string $id;
    private string $username;
    private string $hashPwd;

    /**
     * Constructeur
     *
     * @param string|null $id
     * @param string $username
     * @param string $hashPwd
     */
    public function __construct(?string $id = null, string $username = "", string $hashPwd = "") {
        $this->id = $id;
        $this->username = $username;
        $this->hashPwd = $hashPwd;
    }

    // Getters
    public function getId(): ?string {
        return $this->id;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function getHashPwd(): string {
        return $this->hashPwd;
    }

    // Setters
    public function setId(?string $id): void {
        $this->id = $id;
    }

    public function setUsername(string $username): void {
        $this->username = $username;
    }

    public function setHashPwd(string $hashPwd): void {
        $this->hashPwd = $hashPwd;
    }
}
