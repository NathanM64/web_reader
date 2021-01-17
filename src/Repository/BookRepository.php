<?php

namespace App\Repository;

use App\Entity\Book;
use App\Entity\Chapter;
use App\Entity\Genre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    private function createCommonQueryBuilder()
    {
        return $this->createQueryBuilder('b')
            ->orderBy('b.title', 'ASC')
            ->leftJoin('b.chapters', 'c')
            ->addSelect('c');

    }

    public function getLatestPaginatedBooks(PaginatorInterface $paginator, $page = 1)
    {
        $query = $this->createCommonQueryBuilder()
        ->getQuery();

        return $paginator->paginate($query, $page, 20);
    }

    // /**
    //  * @return Book[] Returns an array of Book objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Book
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function getLatestPaginatedBooksByCategory(Genre $genre, PaginatorInterface $paginator, $page = 1): \Knp\Component\Pager\Pagination\PaginationInterface
    {
        $query = $this->createCommonQueryBuilder()
        ->leftJoin('b.genre', 'g')
        ->where('g = :genre')
        ->setParameter('genre', $genre)
        ->getQuery();

        return $paginator->paginate($query, $page, 20);
    }
}
