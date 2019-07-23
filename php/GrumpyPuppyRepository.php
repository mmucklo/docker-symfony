<?php

namespace App\Repository;

use App\Entity\GrumpyPuppy;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method GrumpyPuppy|null find($id, $lockMode = null, $lockVersion = null)
 * @method GrumpyPuppy|null findOneBy(array $criteria, array $orderBy = null)
 * @method GrumpyPuppy[]    findAll()
 * @method GrumpyPuppy[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GrumpyPuppyRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, GrumpyPuppy::class);
    }

    // /**
    //  * @return GrumpyPuppy[] Returns an array of GrumpyPuppy objects
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
    public function findOneBySomeField($value): ?GrumpyPuppy
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
