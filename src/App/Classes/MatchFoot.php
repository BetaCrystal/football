<?php

namespace App\Classes;

use DateTime;

class MatchFoot
{

    public function __construct(protected int $id, protected int $scoreEquipe,
    protected int $scoreAdverse, protected DateTime $dateMatch,
    protected string $ville, protected int $teamId, protected int $opponentId)
    {

    }

    // --- GETTERS ---
    public function getId(): int
    {
        return $this->id;
    }

    public function getScoreEquipe(): int
    {
        return $this->scoreEquipe;
    }

    public function getScoreAdverse(): int
    {
        return $this->scoreAdverse;
    }

    public function getDateMatch(): DateTime
    {
        return $this->dateMatch;
    }

    public function getVille(): string
    {
        return $this->ville;
    }

    public function getTeamId(): int
    {
        return $this->teamId;
    }

    public function getOpponentId(): int
    {
        return $this->opponentId;
    }

    // --- SETTERS ---
    public function setScoreEquipe(int $scoreEquipe): void
    {
        $this->scoreEquipe = $scoreEquipe;
    }

    public function setScoreAdverse(int $scoreAdverse): void
    {
        $this->scoreAdverse = $scoreAdverse;
    }

    public function setDateMatch(DateTime $dateMatch): void
    {
        $this->dateMatch = $dateMatch;
    }

    public function setVille(string $ville): void
    {
        $this->ville = $ville;
    }

    public function setTeamId(int $teamId): void
    {
        $this->teamId = $teamId;
    }

    public function setOpponentId(int $opponentId): void
    {
        $this->opponentId = $opponentId;
    }
}
