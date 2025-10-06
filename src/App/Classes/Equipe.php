<?php

namespace App\Classes;

//include "../includes/header.php";

class Equipe
{
    public function __construct(protected int $id, protected string $nom)
    {
    }

    // --- GETTERS ---
    public function getId(): int
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

        // --- SETTERS ---
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }


}
