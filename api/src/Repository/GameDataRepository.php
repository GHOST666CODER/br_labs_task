<?php

namespace App\Repository;

use App\Entity\GameData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method GameData|null find($id, $lockMode = null, $lockVersion = null)
 * @method GameData|null findOneBy(array $criteria, array $orderBy = null)
 * @method GameData[]    findAll()
 * @method GameData[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameDataRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GameData::class);
    }

    // /**
    //  * @return GameData[] Returns an array of GameData objects
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
    /**
     * @param array $parameters
     * @return GameData Return GameData object
     * @throws \Doctrine\ORM\NonUniqueResultException
     */

    public function findByParameters(array $parameters)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.sport = :sport')
            ->andWhere('g.league = :league')
            ->andWhere('g.team1 = :team1')
            ->andWhere('g.team2 = :team2')
            ->andWhere(':startTime BETWEEN g.startTimeFrom AND g.startTimeTo')
            ->setParameters($parameters)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }


    /*
    public function findOneBySomeField($value): ?GameData
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
