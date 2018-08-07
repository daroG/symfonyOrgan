<?php

namespace App\Repository;

use App\Entity\PlayedSongs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PlayedSongs|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlayedSongs|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlayedSongs[]    findAll()
 * @method PlayedSongs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlayedSongsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PlayedSongs::class);
    }

    public function findSongs()
    {

    }

//    /**
//     * @return PlayedSongs[] Returns an array of PlayedSongs objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PlayedSongs
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
