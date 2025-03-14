<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedArticleException;
use Symfony\Component\Security\Core\Article\PasswordAuthenticatedArticleInterface;
use Symfony\Component\Security\Core\Article\PasswordUpgraderInterface;

/**
 * @extends ServiceEntityRepository<Article>
 */
class ArticleRepository extends ServiceEntityRepository 
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    /**
     * Used to upgrade (rehash) the Article's password automatically over time.
     */
 

    //    /**
    //     * @return Article[] Returns an array of Article objects
    //     */
       public function find2LastArticleByPageId($pageId): array
       {
           return $this->createQueryBuilder('a')
               ->andWhere('a.id = :id')
               ->setParameter('id', $pageId)
               ->orderBy('a.id', 'ASC')
               ->setMaxResults(2)
               ->getQuery()
               ->getResult()
           ;
       }

       public function getArticleBySlug($slug): ?Article
       {
           return $this->createQueryBuilder('a')
               ->andWhere('a.slug = :slug')
               ->setParameter('slug', $slug)
               ->getQuery()
               ->getOneOrNullResult()
           ;
       }
}
