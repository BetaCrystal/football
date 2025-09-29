<?php

namespace App\Classes;

class Adversaire
{
        public int $id;
        public string $adresse;
        public string $ville;

        public function __construct(int $id, string $adresse, string $ville)
        {
                $this->id = $id;
                $this->adresse = $adresse;
                $this->ville = $ville;
        }
}
