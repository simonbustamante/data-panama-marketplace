<?php

namespace App\Repository;

use App\Entity\OrderDetail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OrderDetail>
 */
class OrderDetailRepository extends ServiceEntityRepository
{
    private $entityManager;
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, OrderDetail::class);
        $this->entityManager = $entityManager;
    }
    
    public function getOrderTotal()
    {
        $qb = $this->entityManager->createQueryBuilder();

        $qb->select('o.id as orderId, SUM(od.price) as total')
            ->from('App\Entity\OrderDetail', 'od')
            ->join('od.orderId', 'o')  // Asegúrate de tener la relación definida en tu entidad
            ->groupBy('o.id');

        return $qb->getQuery()->getResult();
    }

    // public function sumPricesByOrder(int $orderId = null)
    // {
    //     $qb = $this->createQueryBuilder('od')
    //         ->select('IDENTITY(od.orderId) as orderId', 'SUM(od.price) as total')
    //         ->groupBy('od.orderId')
    //         ->orderBy('od.orderId', 'ASC');

    //     if ($orderId !== null) {
    //         $qb->andWhere('od.orderId = :orderId')
    //             ->setParameter('orderId', $orderId);
    //     }
    //     dump($qb->getQuery()->getResult());die();
    //     return $qb->getQuery()->getResult();
    // }

    // public function sumPricesByOrder2(int $orderId = null)
    // {
    //     $qb = $this->createQueryBuilder('od')
    //         ->join('od.orderId', 'o')
    //         ->select('o.id as orderId', 'SUM(od.price) as total')
    //         ->groupBy('o.id')
    //         ->orderBy('o.id', 'ASC');

    //     if ($orderId !== null) {
    //         $qb->andWhere('o.id = :orderId')
    //             ->setParameter('orderId', $orderId);
    //     }

    //     $result = $qb->getQuery()->getResult();
    //     //dump($result); die();

    //     return $result;
    // }

    

    //    /**
    //     * @return OrderDetail[] Returns an array of OrderDetail objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('o')
    //            ->andWhere('o.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('o.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?OrderDetail
    //    {
    //        return $this->createQueryBuilder('o')
    //            ->andWhere('o.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
