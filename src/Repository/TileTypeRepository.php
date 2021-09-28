<?php

namespace App\Repository;

use App\Entity\TileType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TileType|null find($id, $lockMode = null, $lockVersion = null)
 * @method TileType|null findOneBy(array $criteria, array $orderBy = null)
 * @method TileType[]    findAll()
 * @method TileType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TileTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TileType::class);
    }

    // /**
    //  * @return TileType[] Returns an array of TileType objects
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
    public function findOneBySomeField($value): ?TileType
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
