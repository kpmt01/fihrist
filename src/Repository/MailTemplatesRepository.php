<?php

namespace App\Repository;

use App\Entity\MailTemplates;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method MailTemplates|null find($id, $lockMode = null, $lockVersion = null)
 * @method MailTemplates|null findOneBy(array $criteria, array $orderBy = null)
 * @method MailTemplates[]    findAll()
 * @method MailTemplates[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MailTemplatesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MailTemplates::class);
    }

    // /**
    //  * @return MailTemplates[] Returns an array of MailTemplates objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MailTemplates
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
