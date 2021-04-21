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

    /**
     * return Territories[] Returns an array of Territories objects
     */

    public function displayGangTerritories($gang_id)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('g.id = :val')
            ->setParameter('val', $gang_id)
            ->leftJoin('t.gang', 'g')
            ->addSelect('g')
            ->orderBy('t.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }


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
