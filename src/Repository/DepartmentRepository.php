<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Department;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class DepartmentRepository
 * @package App\Repository
 */
class DepartmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Department::class);
    }

    /**
     * Function to get all department from Database
     */
    public function getAll(): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT d
            FROM App\Entity\Department d'
        );

        // returns an array of Department objects
        return $query->getArrayResult();
    }
}