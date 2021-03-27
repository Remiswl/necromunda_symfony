<?php

namespace App\Repository;

use App\Entity\Gangs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Gangs|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gangs|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gangs[]    findAll()
 * @method Gangs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GangsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Gangs::class);
    }

    /**
    * @return Gangs[] Returns an array of Gangs objects
    */
    public function displayGangData($id): ?Gangs
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.userId = :val')  // userId -> prendre le nom dans src/Entity/Gangs.php et non celui dans la BDD
            ->setParameter('val', $id)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    // /**
    //  * @return Gangs[] Returns an array of Gangs objects
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
    public function findOneBySomeField($value): ?Gangs
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
