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

//rajouter des getters setters
//faire une classe pdo pour chaque classe
//mettre les attributs en private
//faire des interfaces pour afficher plusieurs éléments de plusieurs classes par exemple
//ou pour faire des vérifications de données
//faire jeux d'essais sur la bdd
//faire des traits pour le code récurrent