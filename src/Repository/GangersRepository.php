<?php

namespace App\Repository;

use App\Entity\Gangers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Gangers|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gangers|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gangers[]    findAll()
 * @method Gangers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GangersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Gangers::class);
    }

    /*
    public function findOneBySomeField($value): ?Gangers
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
