<?php

namespace App\DataFixtures;

use App\Entity\Order;
use App\Entity\OrderDetail;
use App\Entity\Product;
use App\Repository\ProductRepository;
use App\Repository\OrderRepository;
use App\Repository\StoreRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixturesOrderDetail extends Fixture implements DependentFixtureInterface
{
    
    private $orderRepository;
    private $productRepository;
    private $storeRepository;

    public function __construct(ProductRepository $productRepository, OrderRepository $orderRepository, StoreRepository $storeRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->productRepository = $productRepository;
        $this->storeRepository = $storeRepository;
    }


    public function load(ObjectManager $manager)
    {
        $orders = $this->orderRepository->findAll();
        $products = $this->productRepository->findAll();
        //dump($products);die();
        $orderDetailCount = [1,2,3];
        foreach($orders as $order){
            $totalByOrder = 0;
            foreach($orderDetailCount as $count){
                $orderDetail = new OrderDetail();
                $uniqueId = Uuid::uuid4();
                // $orderDetail->setId($uniqueId);
                $orderDetail->setOrderDetailId($uniqueId->toString());
                $orderDetail->setOrderId($order);
                $product = $products[array_rand($products)];
                $orderDetail->setProductId($product);
                $orderDetail->setStoreId($product->getStoreId());
                $orderDetail->setQuantity(rand(1, 10));
                $price = $orderDetail->getQuantity() * $product->getPrice();
                $orderDetail->setPrice($price);
                $totalByOrder = $totalByOrder + $orderDetail->getPrice();
                
                $manager->persist($orderDetail);
            }
            $order->setTotal($totalByOrder);
            $manager->persist($order);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            AppFixturesUser::class,
            AppFixturesProduct::class,
            AppFixturesStore::class,
            AppFixturesCategory::class,
            AppFixturesOrder::class,
        ];
    }

    private function generateUniqueUserId(): int
    {
        return mt_rand(0, 9999) + time();
    }


}
