<?php

namespace App\DataFixtures;

use App\Entity\Coupon;
use App\Entity\ProductReview;
use App\Entity\Recommendation;
use App\Entity\Returns;
use App\Entity\Shipment;
use App\Entity\StoreReview;
use App\Entity\Wishlist;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use App\Repository\StoreRepository;
use App\Repository\UserRepository;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;

class AppFixturesRecommendation extends Fixture implements DependentFixtureInterface
{
    private $productRepository;
    private $userRepository;

    private $rec = [
        [
            'created_date' => '2024-01-05 14:30:00',
            'status' => 'Pendiente',
            'reason' => 'Basado en tu historial de compras'
        ],
        [
            'created_date' => '2024-01-15 09:45:00',
            'status' => 'Vista',
            'reason' => 'Producto complementario'
        ],
        [
            'created_date' => '2024-01-25 16:20:00',
            'status' => 'Aceptada',
            'reason' => 'Popular en tu área'
        ],
        [
            'created_date' => '2024-02-05 11:10:00',
            'status' => 'Rechazada',
            'reason' => 'Recomendado por otros usuarios'
        ],
        [
            'created_date' => '2024-02-15 13:55:00',
            'status' => 'Pendiente',
            'reason' => 'Producto en oferta'
        ],
        [
            'created_date' => '2024-02-25 10:05:00',
            'status' => 'Vista',
            'reason' => 'Novedad del mes'
        ],
        [
            'created_date' => '2024-03-05 08:45:00',
            'status' => 'Aceptada',
            'reason' => 'Recomendación personalizada'
        ],
        [
            'created_date' => '2024-03-15 17:25:00',
            'status' => 'Rechazada',
            'reason' => 'Basado en tu historial de compras'
        ],
        [
            'created_date' => '2024-03-25 14:40:00',
            'status' => 'Pendiente',
            'reason' => 'Producto complementario'
        ],
        [
            'created_date' => '2024-04-05 12:15:00',
            'status' => 'Vista',
            'reason' => 'Popular en tu área'
        ],
        [
            'created_date' => '2024-04-15 09:30:00',
            'status' => 'Aceptada',
            'reason' => 'Recomendado por otros usuarios'
        ],
        [
            'created_date' => '2024-04-25 11:20:00',
            'status' => 'Rechazada',
            'reason' => 'Producto en oferta'
        ],
        [
            'created_date' => '2024-05-05 15:10:00',
            'status' => 'Pendiente',
            'reason' => 'Novedad del mes'
        ],
        [
            'created_date' => '2024-05-15 08:00:00',
            'status' => 'Vista',
            'reason' => 'Recomendación personalizada'
        ],
        [
            'created_date' => '2024-01-10 10:30:00',
            'status' => 'Aceptada',
            'reason' => 'Basado en tu historial de compras'
        ],
        [
            'created_date' => '2024-01-20 11:45:00',
            'status' => 'Rechazada',
            'reason' => 'Producto complementario'
        ],
        [
            'created_date' => '2024-01-30 14:20:00',
            'status' => 'Pendiente',
            'reason' => 'Popular en tu área'
        ],
        [
            'created_date' => '2024-02-10 09:10:00',
            'status' => 'Vista',
            'reason' => 'Recomendado por otros usuarios'
        ],
        [
            'created_date' => '2024-02-20 12:55:00',
            'status' => 'Aceptada',
            'reason' => 'Producto en oferta'
        ],
        [
            'created_date' => '2024-02-28 16:05:00',
            'status' => 'Rechazada',
            'reason' => 'Novedad del mes'
        ],
        [
            'created_date' => '2024-03-10 13:45:00',
            'status' => 'Pendiente',
            'reason' => 'Recomendación personalizada'
        ],
        [
            'created_date' => '2024-03-20 10:25:00',
            'status' => 'Vista',
            'reason' => 'Basado en tu historial de compras'
        ],
        [
            'created_date' => '2024-03-30 11:40:00',
            'status' => 'Aceptada',
            'reason' => 'Producto complementario'
        ],
        [
            'created_date' => '2024-04-10 12:15:00',
            'status' => 'Rechazada',
            'reason' => 'Popular en tu área'
        ],
        [
            'created_date' => '2024-04-20 15:30:00',
            'status' => 'Pendiente',
            'reason' => 'Recomendado por otros usuarios'
        ],
        [
            'created_date' => '2024-04-30 09:55:00',
            'status' => 'Vista',
            'reason' => 'Producto en oferta'
        ],
        [
            'created_date' => '2024-05-10 16:20:00',
            'status' => 'Aceptada',
            'reason' => 'Novedad del mes'
        ],
        [
            'created_date' => '2024-05-20 11:45:00',
            'status' => 'Rechazada',
            'reason' => 'Recomendación personalizada'
        ],
        [
            'created_date' => '2024-01-07 12:30:00',
            'status' => 'Pendiente',
            'reason' => 'Basado en tu historial de compras'
        ],
        [
            'created_date' => '2024-01-17 15:45:00',
            'status' => 'Vista',
            'reason' => 'Producto complementario'
        ],
        [
            'created_date' => '2024-01-27 09:20:00',
            'status' => 'Aceptada',
            'reason' => 'Popular en tu área'
        ],
        [
            'created_date' => '2024-02-07 14:10:00',
            'status' => 'Rechazada',
            'reason' => 'Recomendado por otros usuarios'
        ],
        [
            'created_date' => '2024-02-17 12:55:00',
            'status' => 'Pendiente',
            'reason' => 'Producto en oferta'
        ],
        [
            'created_date' => '2024-02-27 16:05:00',
            'status' => 'Vista',
            'reason' => 'Novedad del mes'
        ],
        [
            'created_date' => '2024-03-07 10:45:00',
            'status' => 'Aceptada',
            'reason' => 'Recomendación personalizada'
        ],
        [
            'created_date' => '2024-03-17 13:25:00',
            'status' => 'Rechazada',
            'reason' => 'Basado en tu historial de compras'
        ],
        [
            'created_date' => '2024-03-27 14:40:00',
            'status' => 'Pendiente',
            'reason' => 'Producto complementario'
        ],
        [
            'created_date' => '2024-04-07 08:15:00',
            'status' => 'Vista',
            'reason' => 'Popular en tu área'
        ],
        [
            'created_date' => '2024-04-17 11:30:00',
            'status' => 'Aceptada',
            'reason' => 'Recomendado por otros usuarios'
        ],
        [
            'created_date' => '2024-04-27 13:20:00',
            'status' => 'Rechazada',
            'reason' => 'Producto en oferta'
        ],
        [
            'created_date' => '2024-05-07 15:10:00',
            'status' => 'Pendiente',
            'reason' => 'Novedad del mes'
        ],
        [
            'created_date' => '2024-05-17 08:00:00',
            'status' => 'Vista',
            'reason' => 'Recomendación personalizada'
        ],
        [
            'created_date' => '2024-01-12 10:30:00',
            'status' => 'Aceptada',
            'reason' => 'Basado en tu historial de compras'
        ],
        [
            'created_date' => '2024-01-22 11:45:00',
            'status' => 'Rechazada',
            'reason' => 'Producto complementario'
        ],
        [
            'created_date' => '2024-02-02 14:20:00',
            'status' => 'Pendiente',
            'reason' => 'Popular en tu área'
        ],
        [
            'created_date' => '2024-02-12 09:10:00',
            'status' => 'Vista',
            'reason' => 'Recomendado por otros usuarios'
        ],
        [
            'created_date' => '2024-02-22 12:55:00',
            'status' => 'Aceptada',
            'reason' => 'Producto en oferta'
        ],
        [
            'created_date' => '2024-03-02 16:05:00',
            'status' => 'Rechazada',
            'reason' => 'Novedad del mes'
        ],
        [
            'created_date' => '2024-03-12 13:45:00',
            'status' => 'Pendiente',
            'reason' => 'Recomendación personalizada'
        ],
        [
            'created_date' => '2024-03-22 10:25:00',
            'status' => 'Vista',
            'reason' => 'Basado en tu historial de compras'
        ]
    ];
    

    public function __construct(ProductRepository $productRepository, UserRepository $userRepository)
    {
        $this->productRepository = $productRepository;
        $this->userRepository = $userRepository;
    }

    
    public function load(ObjectManager $manager)
    {
        $users = $this->userRepository->findAll();
        $products = $this->productRepository->findAll(); 

        foreach($users as $user){
            foreach($products as $product){
                $recommendation = new Recommendation();
                $uniqueId = Uuid::uuid4();
                $recommendation->setRecommendationId($uniqueId->toString());
                $rec = $this->rec[array_rand($this->rec)];
                $recommendation->setUserId($user);
                $recommendation->setProductId($product);
                $recommendation->setCreatedDate(new DateTime($rec['created_date']));
                $recommendation->setStatus($rec['status']);
                $recommendation->setReason($rec['reason']);
                $manager->persist($recommendation);
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            AppFixturesOrder::class,
            AppFixturesOrderDetail::class,
            AppFixturesStore::class,
            AppFixturesProduct::class,
            AppFixturesUser::class,
            AppFixturesCategory::class,
            AppFixturesPayment::class,
            AppFixturesPayment::class,
            AppFixturesShipment::class,
            AppFixturesProductReview::class,
            AppFixturesStoreReview::class,
            AppFixturesWishlist::class,
            AppFixturesReturns::class,
            AppFixturesCoupon::class,
        ];
    }
}
