<?php

namespace App\Repository;

use App\Entity\Sport;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Sport|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sport|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sport[]    findAll()
 * @method Sport[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SportRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sport::class);
    }

    // /**
    //  * @return Sport[] Returns an array of Sport objects
    //  */
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
    public function findOneBySomeField($value): ?Sport
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    /**
     * @param $name
     * @return Sport|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */

    public function findSportByNameOrAlias($name)
    {
        $qb = $this->createQueryBuilder('s');
        $qb->orWhere('s.name = :name')
            ->setParameter('name', $name);
        if ($qb->getQuery()->getOneOrNullResult() === null) {
            $qb->leftJoin('s.sportAliases', 'aliases')
                ->orWhere('aliases.alias = :name');
        }
        return $qb
            ->getQuery()
            ->getOneOrNullResult();
    }
}
