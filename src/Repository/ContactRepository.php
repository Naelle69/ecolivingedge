<?php

namespace App\Repository;

use App\Entity\Contact;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Contact>
 */
class ContactRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contact::class);
    }

            // je personnalise les requêtes pour récupérer directement les commentaires et les candidatures de toutes les annonces de l'utilisateur en une seule requête SQL
            public function findCandidaturesByUser(User $user)
            {
                return $this->createQueryBuilder('a')
                    ->join('a.candidatures', 'c')
                    ->where('a.user = :user')
                    ->setParameter('user', $user)
                    ->getQuery()
                    ->getResult();
            }
        
            public function findCommentairesByUser(User $user)
            {
                return $this->createQueryBuilder('a')
                    ->join('a.commentaire', 'com')
                    ->where('a.user = :user')
                    ->setParameter('user', $user)
                    ->getQuery()
                    ->getResult();
            }

    //    /**
    //     * @return Contact[] Returns an array of Contact objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Contact
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
