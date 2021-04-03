<?php

namespace App\Repository;

use App\Entity\Territories;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Territories|null find($id, $lockMode = null, $lockVersion = null)
 * @method Territories|null findOneBy(array $criteria, array $orderBy = null)
 * @method Territories[]    findAll()
 * @method Territories[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TerritoriesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Territories::class);
    }

    // /**
    //  * @return Territories[] Returns an array of Territories objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Territories
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
