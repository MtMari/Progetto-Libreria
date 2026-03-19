<?php

namespace App\Repository;

use App\Entity\Libro;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Query\Expr;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Libro>
 */
class LibroRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Libro::class);
    }

    public function findAllByTitle(): array
    {
        // $qb = $this->createQueryBuilder('libro')->addOrderBy('libro.titolo', Criteria::ASC);
        // return $qb->getQuery()->getResult();

        $qb = $this->createQueryBuilder('libro')
            ->orderBy('libro.titolo', 'ASC'
        );

        return $qb->getQuery()->getResult();
    }

    public function findByQueryHome( string $query ): array
    {
        return $this->createQueryBuilder('libro')
            ->join('App\Entity\AutoreLibro', 'al', Expr\Join::ON, 'libro.id = al.libro')
            ->join('App\Entity\Autore', 'a', Expr\Join::ON, 'al.autore=a.id')
            ->where("lower(libro.titolo) LIKE lower(:query)")
            ->setParameter('query', '%' . $query . '%')
            ->addOrderBy('libro.titolo', Criteria::ASC)
            ->getQuery()
            ->getResult()
        ;
    }
    
    public function findByQuery( string $query ): array
    {
        if(empty($query))
        {
            return $this->findAllByTitle();
        }else
        {
            return $this->createQueryBuilder('libro')
                ->join('App\Entity\AutoreLibro', 'al', Expr\Join::ON, 'libro.id = al.libro')
                ->join('App\Entity\Autore', 'a', Expr\Join::ON, 'al.autore=a.id')
                ->where("lower(libro.titolo) LIKE lower(:query)")
                ->setParameter('query', '%' . $query . '%')
                ->addOrderBy('libro.titolo', Criteria::ASC)
                ->getQuery()
                ->getResult()
            ;
        }
    }

    //    /**
    //     * @return Libro[] Returns an array of Libro objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('l.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Libro
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
