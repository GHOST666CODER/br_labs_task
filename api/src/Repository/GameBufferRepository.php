<?php

namespace App\Repository;

use App\Entity\GameBuffer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method GameBuffer|null find($id, $lockMode = null, $lockVersion = null)
 * @method GameBuffer|null findOneBy(array $criteria, array $orderBy = null)
 * @method GameBuffer[]    findAll()
 * @method GameBuffer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameBufferRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GameBuffer::class);
    }

    /**
     * @param $gameData
     * @return GameBuffer Return GameBuffer object
     */

    public function findMostDuplicatedStartTime($gameData)
    {
        return $this->createQueryBuilder('g')
            ->select('g.startTime')

            ->where('g.gameData = :gameData')
            ->setParameter('gameData', $gameData)
            ->groupBy( 'g.startTime')
            ->orderBy('COUNT(g.startTime)', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult();
    }


    /*
    public function findOneBySomeField($value): ?GameBuffer
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
