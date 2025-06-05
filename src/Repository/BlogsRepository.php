<?php

namespace App\Repository;

use App\Entity\Blogs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Blogs>
 */
class BlogsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Blogs::class);
    }

    public function findAllPaginatedQuery()
    {
        return $this->createQueryBuilder('b')
            ->orderBy('b.created_at', 'DESC')
            ->getQuery();
    }
}
