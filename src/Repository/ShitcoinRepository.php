<?php

namespace App\Repository;

use App\Entity\Shitcoin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Shitcoin|null find($id, $lockMode = null, $lockVersion = null)
 * @method Shitcoin|null findOneBy(array $criteria, array $orderBy = null)
 * @method Shitcoin[]    findAll()
 * @method Shitcoin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShitcoinRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Shitcoin::class);
    }

    // /**
    //  * @return Shitcoin[] Returns an array of Shitcoin objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Shitcoin
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
