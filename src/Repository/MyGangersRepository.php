<?php

namespace App\Repository;

use App\Entity\MyGangers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MyGangers|null find($id, $lockMode = null, $lockVersion = null)
 * @method MyGangers|null findOneBy(array $criteria, array $orderBy = null)
 * @method MyGangers[]    findAll()
 * @method MyGangers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MyGangersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MyGangers::class);
    }

    // /**
    //  * @return MyGangers[] Returns an array of MyGangers objects
    //  */
    public function displayGangersData($gang_id)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.gang = :val')
            ->setParameter('val', $gang_id)
            ->orderBy('m.createdAt', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function displayGangerData($id): ?MyGangers
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.id = :val')
            ->setParameter('val', $id)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    // /**
    //  * @return MyGangers[] Returns an array of MyGangers objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MyGangers
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
