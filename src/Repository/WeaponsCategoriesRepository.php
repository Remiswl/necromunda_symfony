<?php

namespace App\Repository;

use App\Entity\WeaponsCategories;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method WeaponsCategories|null find($id, $lockMode = null, $lockVersion = null)
 * @method WeaponsCategories|null findOneBy(array $criteria, array $orderBy = null)
 * @method WeaponsCategories[]    findAll()
 * @method WeaponsCategories[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WeaponsCategoriesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WeaponsCategories::class);
    }

    // /**
    //  * @return WeaponsCategories[] Returns an array of WeaponsCategories objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?WeaponsCategories
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
