<?php

namespace Helpers;

/**
 * Classe pour gérer les messages utilisateur
 */
class Message {
    const COLOR_SUCCESS = "green lighten-2";
    const COLOR_ERROR = "red lighten-2";
    const COLOR_INFO = "light-blue lighten-1";
    const COLOR_WARNING = "orange lighten-2";

    private string $message;
    private string $color;
    private string $title;

    /**
     * Constructeur de la classe Message
     *
     * @param string $message Le contenu du message
     * @param string $color La couleur du message (classe CSS)
     * @param string $title Le titre du message
     */
    public function __construct(string $message, string $color = self::COLOR_INFO, string $title = "Message") {
        $this->message = $message;
        $this->color = $color;
        $this->title = $title;
    }

    /**
     * Obtient le message
     *
     * @return string
     */
    public function getMessage(): string {
        return $this->message;
    }

    /**
     * Obtient la couleur
     *
     * @return string
     */
    public function getColor(): string {
        return $this->color;
    }

    /**
     * Obtient le titre
     *
     * @return string
     */
    public function getTitle(): string {
        return $this->title;
    }
}
