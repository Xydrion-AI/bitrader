<?php

namespace App\Blog\Table;

class BlogTable
{
    private \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Liste paginée d’articles
     * @param int $limit Nombre d’articles par page
     * @param int $offset Décalage pour la pagination
     * @return \stdClass[]
     */
    public function findPaginated(int $limit = 9, int $offset = 0): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM blog ORDER BY created_at DESC LIMIT :limit OFFSET :offset');
        $stmt->bindValue('limit', $limit, \PDO::PARAM_INT);
        $stmt->bindValue('offset', $offset, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Récupère un article par son slug
     * @param string $slug
     * @return \stdClass|null
     */
    public function find(string $slug): ?\stdClass
    {
        $stmt = $this->pdo->prepare('SELECT * FROM blog WHERE slug = ?');
        $stmt->execute([$slug]);
        return $stmt->fetch() ?: null;
    }

    /**
     * Ajoute un nouvel article dans la base
     * @param array $data 
     * @return int ID du nouvel article inséré
     */
    public function insert(array $data): int
    {
        $stmt = $this->pdo->prepare('
            INSERT INTO blog (picture, tags, title, description, slug, created_at, updated_at) 
            VALUES (:picture, :tags, :title, :description, :slug, :created_at, :updated_at)
        ');
        $stmt->execute([
            'picture' => $data['picture'],
            'tag' => $data['tag'],
            'title' => $data['title'],
            'description' => $data['description'],
            'slug' => $data['slug'],
            'created_at' => $data['created_at'],
            'updated_at' => $data['updated_at'],
        ]);
        return (int)$this->pdo->lastInsertId();
    }

    /**
     * Met à jour un article existant
     * @param string $slug Slug de l’article à modifier
     * @param array $data MAJ
     * @return bool Succès ou non
     */
    public function update(string $slug, array $data): bool
    {
        $stmt = $this->pdo->prepare('
            UPDATE blog SET title = :picture, :tags, :title, :description, :slug, :created_at, :updated_at WHERE slug = :slug
        ');
        return $stmt->execute([
            'picture' => $data['picture'],
            'tag' => $data['tag'],
            'title' => $data['title'],
            'description' => $data['description'],
            'updated_at' => $data['updated_at'],
            'slug' => $slug,
        ]);
    }
}
