<?php

namespace App\Team\Table;

class TeamTable
{
    private \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Récupère les membres d'équipe paginés
     * @return \stdClass[]
     */
    public function findPaginated(): array
    {
        return $this->pdo
            ->query('SELECT * FROM teams')
            ->fetchAll();
    }

    /**
     * Récupère un membre d'équipe par son ID
     * @param int $id
     * @return \stdClass|null
     */
    public function find(int $id): ?\stdClass
    {
        $stmt = $this->pdo->prepare('SELECT * FROM teams WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }
}
