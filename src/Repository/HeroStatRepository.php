<?php

namespace App\Repository;

use App\Entity\HeroStat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HeroStat|null find($id, $lockMode = null, $lockVersion = null)
 * @method HeroStat|null findOneBy(array $criteria, array $orderBy = null)
 * @method HeroStat[]    findAll()
 * @method HeroStat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HeroStatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HeroStat::class);
    }

    // /**
    //  * @return HeroStat[] Returns an array of HeroStat objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HeroStat
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
