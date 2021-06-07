<?php

namespace App\Repository;

use App\Entity\Weapons;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Weapons|null find($id, $lockMode = null, $lockVersion = null)
 * @method Weapons|null findOneBy(array $criteria, array $orderBy = null)
 * @method Weapons[]    findAll()
 * @method Weapons[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WeaponsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Weapons::class);
    }

    /**
    * @return Weapons[] Returns an array of Weapons objects
    */
    public function displayGangerWeapons($ganger_id)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('g.id = :val')
            ->setParameter('val', $ganger_id)
            ->leftJoin('w.ganger', 'g')
            ->addSelect('g')
            ->orderBy('w.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function juvesWeapons()
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.category = 1')
            ->andWhere('w.category = 2')
            ->andWhere('w.category = 6')
            ->orderBy('w.category', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function weaponsWithoutHeavy()
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.category = 1')
            ->andWhere('w.category = 2')
            ->andWhere('w.category = 3')
            ->andWhere('w.category = 4')
            ->andWhere('w.category = 6')
            ->andWhere('w.category = 7')
            ->orderBy('w.category', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function checkIfHasHeavyWeapon()
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.category = 5')
            ->orderBy('w.category', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Weapons[] Returns an array of Weapons objects
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
    public function findOneBySomeField($value): ?Weapons
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
