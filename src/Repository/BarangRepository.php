<?php

namespace App\Repository;

use App\Entity\Barang;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Barang>
 */
class BarangRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Barang::class);
    }

    public function findBarangWithDetails()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT 
                b.id_barang, 
                b.nama_barang,
                COALESCE(s.sisa_stok, 0) AS sisa_stok,
                bm.jml_masuk,
                bk.jml_keluar,
            FROM 
                barang b
            LEFT JOIN 
                stock s ON b.id_barang = s.id_barang
            LEFT JOIN 
                barang_masuk bm ON b.id_barang = bm.id_barang
            LEFT JOIN 
                barang_keluar bk ON b.id_barang = bk.id_barang
        ';

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    //    /**
    //     * @return Barang[] Returns an array of Barang objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('b.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Barang
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
