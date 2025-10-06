<?php

namespace App\Classes;

include "../includes/header.php";

class Personnel
{
    public function __construct(protected int $id,protected string $nom,protected string $prenom,protected string $role,protected string $photo)
    {
    }

    public function getId(): int
{
    return $this->id;
}

public function getNom(): string
{
    return $this->nom;
}

public function setNom(string $nom): void
{
    $this->nom = $nom;
}

public function getPrenom(): string
{
    return $this->prenom;
}

public function setPrenom(string $prenom): void
{
    $this->prenom = $prenom;
}

public function getRole(): string
{
    return $this->role;
}

public function setRole(string $role): void
{
    $this->role = $role;
}

public function getPhoto(): string
{
    return $this->photo;
}

public function setPhoto(string $photo): void
{
    $this->photo = $photo;
}
}
