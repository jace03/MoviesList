<?php

namespace App\Repositories;

use App\Entities\Movie;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManagerInterface;

class MovieRepository extends EntityRepository
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

        // Call EntityRepository constructor manually to enable QueryBuilder support
        $classMetadata = $entityManager->getClassMetadata(Movie::class);
        parent::__construct($entityManager, $classMetadata);
    }

    public function find($id, $lockMode = null, $lockVersion = null): ?Movie
    {
        return $this->entityManager->find(Movie::class, $id, $lockMode, $lockVersion);
    }

    public function findAllOrderedByRating(string $order = 'ASC'): array
    {
        return $this->createQueryBuilder('m')
            ->orderBy('m.rating', $order)
            ->getQuery()
            ->getResult();
    }

    public function findByTmdbId(int $tmdbId): ?Movie
    {
        return $this->entityManager
            ->getRepository(Movie::class)
            ->findOneBy(['tmdb_id' => $tmdbId]);
    }

    public function save(Movie $movie): void
    {
        $this->entityManager->persist($movie);
        $this->entityManager->flush();
    }

    public function findAll(): array
    {
        return $this->entityManager->getRepository(Movie::class)->findAll();
    }

}
