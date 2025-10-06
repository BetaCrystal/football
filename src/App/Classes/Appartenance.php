<?php

namespace App\Classes;

include "../includes/header.php";

class Appartenance{

        public function __construct(protected string $role, public Joueur $joueur, public Equipe $equipe)
        {
        }

        //GETTERS
        public function getRole(): string
        {
                return $this->role;
        }

        //SETTERS
        public function setRole(string $role)
        {
                $this->role = $role;
        }

}
?>