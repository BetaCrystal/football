<?php

namespace App\Classes;

class Adversaire
{
    public function __construct(protected int $id, protected string $adresse,
    protected string $ville)
    {

    }

    // --- GETTERS ---
    public function getId(): int
    {
        return $this->id;
    }

    public function getAdresse(): string
    {
        return $this->adresse;
    }

    public function getVille(): string
    {
        return $this->ville;
    }

    // --- SETTERS ---
    public function setAdresse(string $adresse): void
    {
        $this->adresse = $adresse;
    }

    public function setVille(string $ville): void
    {
        $this->ville = $ville;
    }
}
