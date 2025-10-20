<?php

namespace App\Classes;

use DateTime;

class Joueur
{
    public function __construct(protected int $id,protected string $nom,
    protected string $prenom,protected DateTime $dateNaissance,protected string $photo)
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

    public function getPrenom(): string
    {
        return $this->prenom;
    }

    public function getDateNaissance(): DateTime
    {
        return $this->dateNaissance;
    }

    public function getPhoto(): string
    {
        return $this->photo;
    }

    // --- SETTERS ---
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    public function setPrenom(string $prenom): void
    {
        $this->prenom = $prenom;
    }

    public function setDateNaissance(string $dateNaissance): void
    {
        $this->dateNaissance = new DateTime($dateNaissance);
    }

    public function setPhoto(string $photo): void
    {
        $this->photo = $photo;
    }
}
