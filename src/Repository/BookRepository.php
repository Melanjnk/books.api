<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

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

    /**
     * @return Book[]
     */
    public function getBooksByName(string $bookName): array
    {
        return $this->createQueryBuilder('b')
            ->leftJoin('App\Entity\BookTranslation', 'bt',Join::WITH, 'bt.translatableId = b.id')
            ->andWhere('bt.name LIKE :bookName')
            ->setParameter('bookName', "%{$bookName}%")
            ->orderBy('b.id', 'ASC')
            ->getQuery()
            ->enableResultCache(60, $bookName)
            ->getResult();
    }
}
