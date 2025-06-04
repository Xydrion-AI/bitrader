<?php

namespace App\User\Tables;

class UserTable
{
    private \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    
    /**
     * Récupère un utilisateur par ID
     * @param int $id
     * @return \stdClass|null
     */
    public function find(int $id): ?\stdClass
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }
}
