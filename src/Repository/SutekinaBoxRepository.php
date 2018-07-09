<?php

namespace App\Repository;

use App\Entity\SutekinaBox;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SutekinaBox|null find($id, $lockMode = null, $lockVersion = null)
 * @method SutekinaBox|null findOneBy(array $criteria, array $orderBy = null)
 * @method SutekinaBox[]    findAll()
 * @method SutekinaBox[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SutekinaBoxRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SutekinaBox::class);
    }

//    /**
//     * @return SutekinaBox[] Returns an array of SutekinaBox objects
//     */
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
    public function findOneBySomeField($value): ?SutekinaBox
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
