<?php

namespace App\Repository;

use App\Entity\RentalSpaceType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class RentalSpaceTypeRepository | file RentalSpaceTypeRepository.php
 *
 * In this class, we have method(s) for :
 * 
 * fetching data from RENTAL SPACE TYPE entity on database
 * 
 * @method RentalSpaceType|null find($id, $lockMode = null, $lockVersion = null)
 * @method RentalSpaceType|null findOneBy(array $criteria, array $orderBy = null)
 * @method RentalSpaceType[]    findAll()
 * @method RentalSpaceType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RentalSpaceTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RentalSpaceType::class);
    }

    // /**
    //  * @return RentalSpaceType[] Returns an array of RentalSpaceType objects
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
    public function findOneBySomeField($value): ?RentalSpaceType
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
