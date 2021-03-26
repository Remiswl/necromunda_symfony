<?php

namespace App\Repository;

use App\Entity\GangType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GangType|null find($id, $lockMode = null, $lockVersion = null)
 * @method GangType|null findOneBy(array $criteria, array $orderBy = null)
 * @method GangType[]    findAll()
 * @method GangType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GangTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GangType::class);
    }

    /**
     * @return Gangs[] Returns an array of Gangs objects
     */

    public function findAllGangsNames()
    {
        return $this->createQueryBuilder('g')
            ->orderBy('g.name', 'ASC')
            ->getQuery() #ligne obligatoire
            ->getResult() #ligne obligatoire
        ;
    }

    // /**
    //  * @return GangType[] Returns an array of GangType objects
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
    public function findOneBySomeField($value): ?GangType
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
