<?php

namespace App\Repository;

use App\Entity\Edge;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Edge|null find($id, $lockMode = null, $lockVersion = null)
 * @method Edge|null findOneBy(array $criteria, array $orderBy = null)
 * @method Edge[]    findAll()
 * @method Edge[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EdgeRepository extends ServiceEntityRepository
{
    /**
     * @param Edge $edge
     * @return array
     */
    public function transform(Edge $edge): array
    {
        return [
            's' => $edge->getS(),
            't' => $edge->getT(),
        ];
    }

    /**
     * @return array
     */
    public function transformAll(): array
    {
        $edgesArray = [];

        foreach ($this->findAll() as $edge) {
            $edgesArray[] = $this->transform($edge);
        }

        return $edgesArray;
    }

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Edge::class);
    }

    // /**
    //  * @return Edge[] Returns an array of Edge objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Edge
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
