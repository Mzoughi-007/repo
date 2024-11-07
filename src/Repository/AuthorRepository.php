<?php

namespace App\Repository;

use App\Entity\Author;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Author>
 */
class AuthorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Author::class);
    }

    //    /**
    //     * @return Author[] Returns an array of Author objects
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

    //    public function findOneBySomeField($value): ?Author
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
    
    public function showInterval($min, $max) {
        return $this->createQueryBuilder('b')
            ->where('b.nbbooks BETWEEN :min AND :max')
            ->setParameter('min', $min)
            ->setParameter('max', $max)
            ->getQuery()
            ->getResult();
    }
    public function orderlistQB() {
        return $this->createQueryBuilder('a')
            ->orderBy('a.username', 'ASC') // Use orderBy with correct casing
            ->getQuery()
            ->getResult();
    }
    
    //2eme méthode pour les requettes complexes
    public function orderlistDQL(){
    $em = $this->getEntityManager();
    return  $em->createQuery(
        "select * from APP/Entity/Author a orderBy a.username"
    )->getResult();
    }

    public function showMoreThan10($minBooks) {
        return $this->createQueryBuilder('a')
            ->where('a.nbbooks > :minBooks') // Use parameter
            ->setParameter('minBooks', $minBooks) // Set the parameter
            ->getQuery()
            ->getResult();
    }
    


    public function showMoreThanNb($nb) {
        return $this->createQueryBuilder('a')
            ->where('a.nbbooks > :nb') // placeholder
            ->setParameter('nb', $nb) // Make sure the placeholder name matches
            ->getQuery()
            ->getResult();
    }

    
    
}
