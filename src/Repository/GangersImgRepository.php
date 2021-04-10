<?php

namespace App\Repository;

use App\Entity\GangersImg;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GangersImg|null find($id, $lockMode = null, $lockVersion = null)
 * @method GangersImg|null findOneBy(array $criteria, array $orderBy = null)
 * @method GangersImg[]    findAll()
 * @method GangersImg[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GangersImgRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GangersImg::class);
    }

    public function findImg($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.houseId = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return GangersImg[] Returns an array of GangersImg objects
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
    public function findOneBySomeField($value): ?GangersImg
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
