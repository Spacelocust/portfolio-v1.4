<?php

namespace App\Repository;

use App\Entity\TypeSkill;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeSkill|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeSkill|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeSkill[]    findAll()
 * @method TypeSkill[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeSkillRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeSkill::class);
    }

    // /**
    //  * @return TypeSkill[] Returns an array of TypeSkill objects
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
    public function findOneBySomeField($value): ?TypeSkill
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
