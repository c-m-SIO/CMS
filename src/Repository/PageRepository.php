<?php

namespace App\Repository;

use App\Entity\Page;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedPageException;
use Symfony\Component\Security\Core\Page\PasswordAuthenticatedPageInterface;
use Symfony\Component\Security\Core\Page\PasswordUpgraderInterface;

/**
 * @extends ServiceEntityRepository<Page>
 */
class PageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Page::class);
    }

    /**
     * Used to upgrade (rehash) the Page's password automatically over time.
     */


       /**
        * @return Page Returns an array of Page objects
        */
       public function getPageBySlug($slug): ?Page
       {
           return $this->createQueryBuilder('u')
               ->andWhere('u.slug = :slug')
               ->setParameter('slug', $slug)
               ->getQuery()
               ->getOneOrNullResult();
       }

    //    public function findOneBySomeField($value): ?Page
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
