<?php

abstract class Personne
{
        public int $id;
        public string $nom;
        public string $prenom;
        public string $photo;

        public function __construct($id, $nom, $prenom, $photo)
        {
            $this->id = $id;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->photo = $photo;
        }
}