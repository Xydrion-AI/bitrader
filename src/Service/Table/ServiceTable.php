<?php

namespace App\Service\Table;

class ServiceTable
{
    private \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Récupère les services paginés
     * @return \stdClass[]
     */
    public function findPaginated(): array
    {
        return $this->pdo
            ->query('SELECT * FROM services')
            ->fetchAll();
    }

    /**
     * Récupère un service par son ID
     * @param int $id
     * @return \stdClass|null
     */
    public function find(int $id): ?\stdClass
    {
        $stmt = $this->pdo->prepare('SELECT * FROM services WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }
}
