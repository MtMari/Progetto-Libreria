<?php

namespace App\Repository;

use App\Entity\AutoreLibro;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Query\Expr;

/**
 * @extends ServiceEntityRepository<AutoreLibro>
 */
class AutoreLibroRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AutoreLibro::class);
    }

    public function findByQuery( string $query ): array
    {
        if(empty($query))
        {
            return $this->findAll();
        }else
        {
            return $this->createQueryBuilder('al')
                ->join('App\Entity\Libro', 'l', Expr\Join::ON, 'l.id = al.libro')
                ->join('App\Entity\Autore', 'a', Expr\Join::ON, 'al.autore=a.id')
                ->where("lower(l.titolo) LIKE lower(:query)")
                ->setParameter('query', '%' . $query . '%')
                ->addOrderBy('l.titolo', Criteria::ASC)
                ->getQuery()
                ->getResult()
            ;
        }
    }
    // prendi gli autori disponibili e restituiscili

    //    /**
    //     * @return AutoreLibro[] Returns an array of AutoreLibro objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('a.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?AutoreLibro
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
