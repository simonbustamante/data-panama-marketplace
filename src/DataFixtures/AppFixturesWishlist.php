<?php

namespace App\DataFixtures;

use App\Entity\ProductReview;
use App\Entity\Shipment;
use App\Entity\StoreReview;
use App\Entity\Wishlist;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use App\Repository\StoreRepository;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;

class AppFixturesWishlist extends Fixture implements DependentFixtureInterface
{
    private $productRepository;
    private $userRepository;
    
    public function __construct(ProductRepository $productRepository, UserRepository $userRepository)
    {
        $this->productRepository = $productRepository;
        $this->userRepository = $userRepository;
    }
    
    public function load(ObjectManager $manager)
    {
        $users = $this->userRepository->findAll();
        $products = $this->productRepository->findAll(); 
        
        foreach ($products as $product) {
            foreach($users as $user){
                $wishlist = new Wishlist();
                $uniqueId = time() + mt_rand(30000, 40000);
                $wishlist->setWishlistId($uniqueId);
                $wishlist->setProductId($product);
                $wishlist->setUserId($user);
                $date = new \DateTime();
                $wishlist->setAddedDate($date);
                
                $manager->persist($wishlist);
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
            AppFixturesShipment::class,
            AppFixturesProductReview::class,
            AppFixturesStoreReview::class,
        ];
    }
}
