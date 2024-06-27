<?php

namespace App\Repository;

use App\Entity\UniteHebergement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UniteHebergement>
 */
class UniteHebergementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UniteHebergement::class);
    }

    public function getFreeUnites($dateDebut, $dateFin, $pax): array
    {
        //I need to get all the units that are not reserved for the given dates and have a capacity greater than or equal to the number of people
        $qb = $this->createQueryBuilder('u')
            ->innerJoin('u.typeHebergement', 't')
            ->leftJoin('u.reservations', 'r')
            ->andWhere('r.dateDebut > :dateDebut')
            ->andWhere('r.dateFin < :dateFin')
            ->andWhere('t.capacite >= :pax')
            ->setParameter('dateDebut', $dateDebut)
            ->setParameter('dateFin', $dateFin)
            ->setParameter('pax', $pax)
            ->getQuery();

        return $qb->getResult();
    }

    //    /**
    //     * @return UniteHebergement[] Returns an array of UniteHebergement objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('u.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?UniteHebergement
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
