<?php

namespace App\Classes;

class Personnel
{
    public function __construct(protected int|null $id,protected string $nom,
    protected string $prenom,protected string $role,protected string $photo)
    {

    }

    // --- GETTERS ---
    public function getId(): ?int
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

    public function getRole(): string
    {
        return $this->role;
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

    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    public function setPhoto(string $photo): void
    {
        $this->photo = $photo;
    }
}
