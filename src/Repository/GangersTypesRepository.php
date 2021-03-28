<?php

namespace App\Repository;

use App\Entity\GangersTypes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GangersTypes|null find($id, $lockMode = null, $lockVersion = null)
 * @method GangersTypes|null findOneBy(array $criteria, array $orderBy = null)
 * @method GangersTypes[]    findAll()
 * @method GangersTypes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GangersTypesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GangersTypes::class);
    }

    // /**
    //  * @return GangersTypes[] Returns an array of GangersTypes objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GangersTypes
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
