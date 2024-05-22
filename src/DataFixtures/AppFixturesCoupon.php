<?php

namespace App\DataFixtures;

use App\Entity\Coupon;
use App\Entity\ProductReview;
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

class AppFixturesCoupon extends Fixture implements DependentFixtureInterface
{
    private $discounts = [
        [
            'description' => 'Descuento de verano 1',
            'discount_amount' => 15.00,
            'discount_type' => 'percentage', // opciones: 'percentage' o 'fixed'
            'start_date' => '2024-06-01 00:00:00',
            'end_date' => '2024-08-31 23:59:59',
            'active' => true
        ],
        [
            'description' => 'Descuento de verano 2',
            'discount_amount' => 15.00,
            'discount_type' => 'percentage', // opciones: 'percentage' o 'fixed'
            'start_date' => '2024-06-01 00:00:00',
            'end_date' => '2024-08-31 23:59:59',
            'active' => false
        ],
        [
            'description' => 'Descuento de primavera',
            'discount_amount' => 20.00,
            'discount_type' => 'percentage', // opciones: 'percentage' o 'fixed'
            'start_date' => '2024-03-01 00:00:00',
            'end_date' => '2024-05-31 23:59:59',
            'active' => true
        ],
        [
            'description' => 'Descuento de Black Friday 1',
            'discount_amount' => 50.00,
            'discount_type' => 'fixed', // opciones: 'percentage' o 'fixed'
            'start_date' => '2024-11-25 00:00:00',
            'end_date' => '2024-11-30 23:59:59',
            'active' => true
        ],
        [
            'description' => 'Descuento de Black Friday 2',
            'discount_amount' => 50.00,
            'discount_type' => 'fixed', // opciones: 'percentage' o 'fixed'
            'start_date' => '2024-11-25 00:00:00',
            'end_date' => '2024-11-30 23:59:59',
            'active' => false
        ],
        [
            'description' => 'Descuento de Navidad',
            'discount_amount' => 30.00,
            'discount_type' => 'percentage', // opciones: 'percentage' o 'fixed'
            'start_date' => '2024-12-20 00:00:00',
            'end_date' => '2024-12-26 23:59:59',
            'active' => true
        ],
        [
            'description' => 'Descuento de Navidad',
            'discount_amount' => 30.00,
            'discount_type' => 'percentage', // opciones: 'percentage' o 'fixed'
            'start_date' => '2024-12-20 00:00:00',
            'end_date' => '2024-12-26 23:59:59',
            'active' => false
        ],
        [
            'description' => 'Descuento de Año Nuevo 1',
            'discount_amount' => 25.00,
            'discount_type' => 'fixed', // opciones: 'percentage' o 'fixed'
            'start_date' => '2024-12-31 00:00:00',
            'end_date' => '2025-01-02 23:59:59',
            'active' => true
        ],
        [
            'description' => 'Descuento de Año Nuevo 2',
            'discount_amount' => 25.00,
            'discount_type' => 'fixed', // opciones: 'percentage' o 'fixed'
            'start_date' => '2024-12-31 00:00:00',
            'end_date' => '2025-01-02 23:59:59',
            'active' => false
        ],
        
    ];

    
    public function load(ObjectManager $manager)
    {
        $j=1000;
        for($i = 0; $i < $j ; $i++) {

                $coupon = new Coupon();
                $uniqueId = time() + mt_rand(30000, 40000);
                $coupon->setCouponId($uniqueId);
                $uuid = Uuid::uuid4();
                $coupon->setCode($uuid->toString());
                $discount = $this->discounts[array_rand($this->discounts)];
                $coupon->setDescription($discount['description']);
                $coupon->setDiscountAmount($discount['discount_amount']);
                $coupon->setDiscountType($discount['discount_type']);
                $coupon->setStartDate(new DateTime($discount['start_date']));
                $coupon->setEndDate(new DateTime($discount['end_date']));
                $coupon->setActive($discount['active']);
                
                $manager->persist($coupon);
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
        ];
    }
}
