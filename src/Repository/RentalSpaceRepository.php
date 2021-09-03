<?php

namespace App\Repository;

use App\Entity\RentalSpace;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RentalSpace|null find($id, $lockMode = null, $lockVersion = null)
 * @method RentalSpace|null findOneBy(array $criteria, array $orderBy = null)
 * @method RentalSpace[]    findAll()
 * @method RentalSpace[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RentalSpaceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RentalSpace::class);
    }

    // /**
    //  * @return RentalSpace[] Returns an array of RentalSpace objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RentalSpace
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
