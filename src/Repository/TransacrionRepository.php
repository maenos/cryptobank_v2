<?php

namespace App\Repository;

use App\Entity\Transacrion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Transacrion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Transacrion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Transacrion[]    findAll()
 * @method Transacrion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TransacrionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Transacrion::class);
    }

    // /**
    //  * @return Transacrion[] Returns an array of Transacrion objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Transacrion
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
