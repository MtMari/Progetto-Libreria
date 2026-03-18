<?php

namespace App\Repository;

use App\Entity\Autore;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Autore>
 */
class AutoreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Autore::class);
    }

    public function findAllByNome(): array
    {
        // $qb = $this->createQueryBuilder('autore')
        //     ->orderBy('autore.nomeAutore', 'ASC');
        // $query = $qb->getQuery();

        // return $query->getResult();

        $qb = $this->createQueryBuilder('autore')
            ->addOrderBy('autore.nomeAutore',Criteria::ASC)
            ->getQuery()
            ->getResult()
        ;

        return $qb;
    }

    public function findByQuery( string $query ): array
    {
        if(empty($query))
        {
            return $this->findAllByNome();

        } else
        {
            return $this->createQueryBuilder('autore')
                ->where("lower(autore.nomeAutore) LIKE lower(:query)")
                ->orWhere("lower(autore.cognomeAutore) LIKE lower(:query)")
                // ->orWhere("lower(autore.nomeAutore) LIKE lower(:query) AND lower(autore.cognomeAutore) LIKE lower(:query)")
                ->setParameter('query', '%' . $query . '%')
                ->addOrderBy('autore.nomeAutore', Criteria::ASC)
                ->getQuery()
                ->getResult()
            ;
        }
    }
    
    public function findAllDisponibili(): QueryBuilder
    {
        $qb = $this->createQueryBuilder('autore')
            ->where('autore.disponibilita = true')
            ->orderBy('autore.nomeAutore', 'ASC'
        );
        
        return $qb;
    }
    
    //    /**
    //     * @return Autore[] Returns an array of Autore objects
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

    //    public function findOneBySomeField($value): ?Autore
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
