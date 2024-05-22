<?php

namespace App\DataFixtures;

use App\Entity\ProductReview;
use App\Entity\Returns;
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

class AppFixturesReturns extends Fixture implements DependentFixtureInterface
{
    private $productRepository;
    private $orderRepository;
    private $statusReturn = [
        ['status' => 'solicitado', 'reason' => 'La solicitud ha sido enviada y está pendiente de revisión.'],
        ['status' => 'aprobado', 'reason' => 'La solicitud ha sido aprobada y está lista para ser procesada.'],
        ['status' => 'rechazado', 'reason' => 'La solicitud ha sido rechazada debido a no cumplir con los requisitos.'],
        ['status' => 'procesado', 'reason' => 'La solicitud ha sido procesada exitosamente.'],
        ['status' => 'sin procesar', 'reason' => 'No Hay registro de devoluciones'],
        ['status' => 'sin procesar', 'reason' => 'No Hay registro de devoluciones'],
        ['status' => 'sin procesar', 'reason' => 'No Hay registro de devoluciones'],
        ['status' => 'sin procesar', 'reason' => 'No Hay registro de devoluciones'],
        ['status' => 'sin procesar', 'reason' => 'No Hay registro de devoluciones'],
        ['status' => 'sin procesar', 'reason' => 'No Hay registro de devoluciones'],
        ['status' => 'sin procesar', 'reason' => 'No Hay registro de devoluciones'],
        ['status' => 'sin procesar', 'reason' => 'No Hay registro de devoluciones'],
        ['status' => 'sin procesar', 'reason' => 'No Hay registro de devoluciones'],
        ['status' => 'sin procesar', 'reason' => 'No Hay registro de devoluciones'],
        ['status' => 'sin procesar', 'reason' => 'No Hay registro de devoluciones'],
        ['status' => 'sin procesar', 'reason' => 'No Hay registro de devoluciones'],
        ['status' => 'sin procesar', 'reason' => 'No Hay registro de devoluciones'],
    ];
    
    public function __construct(ProductRepository $productRepository, OrderRepository $orderRepository)
    {
        $this->productRepository = $productRepository;
        $this->orderRepository = $orderRepository;
    }
    
    public function load(ObjectManager $manager)
    {
        $orders = $this->orderRepository->findAll();
        $products = $this->productRepository->findAll(); 
        
        foreach ($products as $product) {
            foreach($orders as $order){
                $returns = new Returns();
                $uniqueId = time() + mt_rand(30000, 40000);
                $returns->setReturnId($uniqueId);
                $returns->setOrderId($order);
                $returns->setProductId($product);
                $date = new \DateTime();
                $returns->setReturnDate($date);
                $st = $this->statusReturn[array_rand($this->statusReturn)];
                $returns->setStatus($st['status']);
                $returns->setReason($st['reason']);
                $manager->persist($returns);
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
            AppFixturesWishlist::class,
        ];
    }
}
