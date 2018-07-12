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

    public function findAllProductsByBox($boxId)
    {
        return $this->createQueryBuilder('b')
            // p.category refers to the "category" property on product
            ->innerJoin('b.sutekina_box_product', 'bp')
            // selects all the category data to avoid the query
//            ->addSelect('c')
            ->andWhere('b.id = :id')
            ->setParameter('id', $boxId)
            ->getQuery();
    }

    public function findAllToValidatedBox()
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.state = :state')
            ->setParameter('state', serialize('to_validated'))
            ->getQuery()->execute();
    }

    public function findAllToCheckStockBox()
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.state = :state')
            ->setParameter('state', serialize('to_check_stock'))
            ->getQuery()->execute();
    }

    public function findAllCreatedBox()
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.state = :state')
            ->setParameter('state', serialize('created'))
            ->getQuery()->execute();
    }

    public function findAllToPurchaseBox()
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.state = :state')
            ->setParameter('state', serialize('to_purchase'))
            ->getQuery()->execute();
    }

    public function findAllPreparedBox()
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.state = :state')
            ->setParameter('state', serialize('prepatation_allowed'))
            ->getQuery()->execute();
    }
}
