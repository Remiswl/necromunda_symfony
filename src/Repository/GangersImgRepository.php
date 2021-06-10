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
}
