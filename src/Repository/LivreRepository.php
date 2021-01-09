<?php

namespace App\Repository;

use App\Entity\Livre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Livre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Livre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Livre[]    findAll()
 * @method Livre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LivreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Livre::class);
    }

    // /**
    //  * @return Livre[] Returns an array of Livre objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Livre
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    /*
    public function afficherLivres(string $filiere, string $categorie, string $titre_livre)
    {


        $qb = $this->createQueryBuilder('l');
        $qb->join('l.stocks', 'lstock')
            ->join('l.filiere', 'lfiliere')
            ->join('l.categorie', 'lcategorie')
            ->join('lstock.site', 'lstsite')
            ->addSelect('lstock')
            ->addSelect('lfiliere')
            ->addSelect('lcategorie')
            ->addSelect('lstsite');
        if (!empty($filiere)) {
            $qb
                ->andWhere('lfiliere.nomFiliere =:nfil')
                ->setParameter('nfil', $filiere);
        }
        if (!empty($categorie)) {
            $qb
                ->andWhere('lcategorie.nomCategorie =:ncat')
                ->setParameter('ncat', $categorie);
        }
        $qb
            ->andWhere('l.titreLivre LIKE :tliv')
            ->setParameter('tliv', '%'.$titre_livre.'%');

        return $qb->getQuery()->getResult();
    }
    */

    /**
      * @return Livre[] Returns an array of Livre objects
      */

    public function findOneById($id)
    {
        try {
            return $this->createQueryBuilder('u')
                ->andWhere('u.id = :id')
                ->setParameter('id', $id)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
        }
    }

    /**
      * @return Livre[] Returns an array of Livre objects
      */
    public function findOneByName($titre_livre)
    {
        try {
            return $this->createQueryBuilder('u')
                ->andWhere('u.titre_livre = :name')
                ->setParameter('titre_livre', $titre_livre)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
        }
    }




}
