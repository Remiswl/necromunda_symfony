<?php

namespace App\Repository;

use App\Entity\Gangs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

//use App\Entity\GangType;

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
    public function displayGangData($id)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.userId = :val')
            ->setParameter('val', $id)

            // Faire les jointures ici ? ou dans le Controller ?
            // on obtient deux requêtes séparées --> rassembler toutes les infos dans une seule réponse
            ->innerJoin('App\Entity\GangType', 'gt')
            ->addSelect('gt')
            ->andWhere('g.gangTypeId = gt.id')

            ->innerJoin('App\Entity\Users', 'u')
            ->addSelect('u')
            ->andWhere('g.userId = u.id')

            ->getQuery()
            ->getResult()
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
