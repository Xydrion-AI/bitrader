<?php

namespace App\Cart\Table;

class CartTable
{
    private \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    /**
     * Récupère un abonnement par son ID
     * @param int $id
     * @return \stdClass|null
     */
    public function find(int $id): ?\stdClass
    {
        $stmt = $this->pdo->prepare('SELECT * FROM carts WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }
}
