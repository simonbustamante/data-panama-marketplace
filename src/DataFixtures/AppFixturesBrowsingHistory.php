<?php

namespace App\DataFixtures;

use App\Entity\BrowsingHistory;
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

class AppFixturesBrowsingHistory extends Fixture implements DependentFixtureInterface
{
    private $productRepository;
    private $userRepository;

    private $vic = [
        ['visited_date' => '2024-01-01 10:30:00'],
        ['visited_date' => '2024-01-02 11:45:00'],
        ['visited_date' => '2024-01-03 12:20:00'],
        ['visited_date' => '2024-01-04 13:10:00'],
        ['visited_date' => '2024-01-05 14:30:00'],
        ['visited_date' => '2024-01-06 15:45:00'],
        ['visited_date' => '2024-01-07 16:20:00'],
        ['visited_date' => '2024-01-08 17:10:00'],
        ['visited_date' => '2024-01-09 18:30:00'],
        ['visited_date' => '2024-01-10 19:45:00'],
        ['visited_date' => '2024-01-11 20:20:00'],
        ['visited_date' => '2024-01-12 21:10:00'],
        ['visited_date' => '2024-01-13 22:30:00'],
        ['visited_date' => '2024-01-14 23:45:00'],
        ['visited_date' => '2024-01-15 08:20:00'],
        ['visited_date' => '2024-01-16 09:10:00'],
        ['visited_date' => '2024-01-17 10:30:00'],
        ['visited_date' => '2024-01-18 11:45:00'],
        ['visited_date' => '2024-01-19 12:20:00'],
        ['visited_date' => '2024-01-20 13:10:00'],
        ['visited_date' => '2024-01-21 14:30:00'],
        ['visited_date' => '2024-01-22 15:45:00'],
        ['visited_date' => '2024-01-23 16:20:00'],
        ['visited_date' => '2024-01-24 17:10:00'],
        ['visited_date' => '2024-01-25 18:30:00'],
        ['visited_date' => '2024-01-26 19:45:00'],
        ['visited_date' => '2024-01-27 20:20:00'],
        ['visited_date' => '2024-01-28 21:10:00'],
        ['visited_date' => '2024-01-29 22:30:00'],
        ['visited_date' => '2024-01-30 23:45:00'],
        ['visited_date' => '2024-02-01 08:20:00'],
        ['visited_date' => '2024-02-02 09:10:00'],
        ['visited_date' => '2024-02-03 10:30:00'],
        ['visited_date' => '2024-02-04 11:45:00'],
        ['visited_date' => '2024-02-05 12:20:00'],
        ['visited_date' => '2024-02-06 13:10:00'],
        ['visited_date' => '2024-02-07 14:30:00'],
        ['visited_date' => '2024-02-08 15:45:00'],
        ['visited_date' => '2024-02-09 16:20:00'],
        ['visited_date' => '2024-02-10 17:10:00'],
        ['visited_date' => '2024-02-11 18:30:00'],
        ['visited_date' => '2024-02-12 19:45:00'],
        ['visited_date' => '2024-02-13 20:20:00'],
        ['visited_date' => '2024-02-14 21:10:00'],
        ['visited_date' => '2024-02-15 22:30:00'],
        ['visited_date' => '2024-02-16 23:45:00'],
        ['visited_date' => '2024-02-17 08:20:00'],
        ['visited_date' => '2024-02-18 09:10:00'],
        ['visited_date' => '2024-02-19 10:30:00'],
        ['visited_date' => '2024-02-20 11:45:00'],
        ['visited_date' => '2024-02-21 12:20:00'],
        ['visited_date' => '2024-02-22 13:10:00'],
        ['visited_date' => '2024-02-23 14:30:00'],
        ['visited_date' => '2024-02-24 15:45:00'],
        ['visited_date' => '2024-02-25 16:20:00'],
        ['visited_date' => '2024-02-26 17:10:00'],
        ['visited_date' => '2024-02-27 18:30:00'],
        ['visited_date' => '2024-02-28 19:45:00'],
        ['visited_date' => '2024-03-01 20:20:00'],
        ['visited_date' => '2024-03-02 21:10:00'],
        ['visited_date' => '2024-03-03 22:30:00'],
        ['visited_date' => '2024-03-04 23:45:00'],
        ['visited_date' => '2024-03-05 08:20:00'],
        ['visited_date' => '2024-03-06 09:10:00'],
        ['visited_date' => '2024-03-07 10:30:00'],
        ['visited_date' => '2024-03-08 11:45:00'],
        ['visited_date' => '2024-03-09 12:20:00'],
        ['visited_date' => '2024-03-10 13:10:00'],
        ['visited_date' => '2024-03-11 14:30:00'],
        ['visited_date' => '2024-03-12 15:45:00'],
        ['visited_date' => '2024-03-13 16:20:00'],
        ['visited_date' => '2024-03-14 17:10:00'],
        ['visited_date' => '2024-03-15 18:30:00'],
        ['visited_date' => '2024-03-16 19:45:00'],
        ['visited_date' => '2024-03-17 20:20:00'],
        ['visited_date' => '2024-03-18 21:10:00'],
        ['visited_date' => '2024-03-19 22:30:00'],
        ['visited_date' => '2024-03-20 23:45:00'],
        ['visited_date' => '2024-03-21 08:20:00'],
        ['visited_date' => '2024-03-22 09:10:00'],
        ['visited_date' => '2024-03-23 10:30:00'],
        ['visited_date' => '2024-03-24 11:45:00'],
        ['visited_date' => '2024-03-25 12:20:00'],
        ['visited_date' => '2024-03-26 13:10:00'],
        ['visited_date' => '2024-03-27 14:30:00'],
        ['visited_date' => '2024-03-28 15:45:00'],
        ['visited_date' => '2024-03-29 16:20:00'],
        ['visited_date' => '2024-03-30 17:10:00'],
        ['visited_date' => '2024-03-31 18:30:00'],
        ['visited_date' => '2024-04-01 19:45:00'],
        ['visited_date' => '2024-04-02 20:20:00'],
        ['visited_date' => '2024-04-03 21:10:00'],
        ['visited_date' => '2024-04-04 22:30:00'],
        ['visited_date' => '2024-04-05 23:45:00'],
        ['visited_date' => '2024-04-06 08:20:00'],
        ['visited_date' => '2024-04-07 09:10:00'],
        ['visited_date' => '2024-04-08 10:30:00'],
        ['visited_date' => '2024-04-09 11:45:00'],
        ['visited_date' => '2024-04-10 12:20:00'],
        ['visited_date' => '2024-04-11 13:10:00'],
        ['visited_date' => '2024-04-12 14:30:00'],
        ['visited_date' => '2024-04-13 15:45:00'],
        ['visited_date' => '2024-04-14 16:20:00'],
        ['visited_date' => '2024-04-15 17:10:00'],
        ['visited_date' => '2024-04-16 18:30:00'],
        ['visited_date' => '2024-04-17 19:45:00'],
        ['visited_date' => '2024-04-18 20:20:00'],
        ['visited_date' => '2024-04-19 21:10:00'],
        ['visited_date' => '2024-04-20 22:30:00'],
        ['visited_date' => '2024-04-21 23:45:00'],
        ['visited_date' => '2024-04-22 08:20:00'],
        ['visited_date' => '2024-04-23 09:10:00'],
        ['visited_date' => '2024-04-24 10:30:00'],
        ['visited_date' => '2024-04-25 11:45:00'],
        ['visited_date' => '2024-04-26 12:20:00'],
        ['visited_date' => '2024-04-27 13:10:00'],
        ['visited_date' => '2024-04-28 14:30:00'],
        ['visited_date' => '2024-04-29 15:45:00'],
        ['visited_date' => '2024-04-30 16:20:00']
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
            for($i=0;$i<10;$i++){
                foreach($products as $product){
                    $bh = new BrowsingHistory();
                    $uniqueId = Uuid::uuid4();
                    $bh->setHistoryId($uniqueId->toString());
                    $vic = $this->vic[array_rand($this->vic)];
                    $bh->setUserId($user);
                    $bh->setProductId($product);
                    $bh->setVisitedDate(new DateTime($vic['visited_date']));
                    $manager->persist($bh);
                }
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
