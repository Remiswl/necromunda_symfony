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

    public function checkIfHasHeavyWeapon($ganger_id)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.category = 5')
            ->leftJoin('w.ganger', 'g')
            ->andWhere('g.id = :val')
            ->setParameter('val', $ganger_id)
            ->orderBy('w.category', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
}
