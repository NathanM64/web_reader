<?php

namespace App\Repository;

use App\Entity\Chapter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Chapter|null find($id, $lockMode = null, $lockVersion = null)
 * @method Chapter|null findOneBy(array $criteria, array $orderBy = null)
 * @method Chapter[]    findAll()
 * @method Chapter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChapterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Chapter::class);
    }

    public function getNextChapter(Chapter $chapter)
    {
        return $this->createQueryBuilder('c')
            ->leftJoin('c.book', 'b')
            ->andWhere('c.number = :nextChapter')
            ->andWhere('b.id = :book_id')
            ->setParameter('nextChapter', $chapter->getNumber()+1)
            ->setParameter('book_id', $chapter->getBook()->getId())
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function getPreviousChapter(Chapter $chapter)
    {
        return $this->createQueryBuilder('c')
            ->leftJoin('c.book', 'b')
            ->andWhere('c.number = :previousChapter')
            ->andWhere('b.id = :book_id')
            ->setParameter('previousChapter', $chapter->getNumber()-1)
            ->setParameter('book_id', $chapter->getBook()->getId())
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function countAllChapters(){
        $queryBuilder = $this->createQueryBuilder('c');
        $queryBuilder->select('count(c.id) as value');

        return $queryBuilder->getQuery()->getOneOrNullResult();
    }


    // /**
    //  * @return Chapter[] Returns an array of Chapter objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Chapter
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
