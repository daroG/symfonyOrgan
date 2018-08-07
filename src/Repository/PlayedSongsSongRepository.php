<?php

namespace App\Repository;

use App\Entity\PlayedSongsSong;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PlayedSongsSong|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlayedSongsSong|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlayedSongsSong[]    findAll()
 * @method PlayedSongsSong[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlayedSongsSongRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PlayedSongsSong::class);
    }

//    /**
//     * @return PlayedSongsSong[] Returns an array of PlayedSongsSong objects
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
    public function findOneBySomeField($value): ?PlayedSongsSong
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
