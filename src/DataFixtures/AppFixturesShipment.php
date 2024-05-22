<?php

namespace App\DataFixtures;


use App\Entity\Shipment;
use App\Repository\OrderRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;

class AppFixturesShipment extends Fixture implements DependentFixtureInterface
{
    private $orderRepository;

    private $carrier = [
        'DHL',
        'Fedex',
        'Uno Express',
        'Uno Express',
        'Uno Express',
        'Uno Express',
        'Correos de Panamá',
        'Servientrega',
        'Fletes Chavale',
        'Fletes Chavale',
        'Fletes Chavale',
        'Fletes Chavale',
        'Fletes Chavale',
        'Fletes Chavale',
        'Tocumen Cargo',
        'Airbox Express',
        'Airbox Express',
        'Airbox Express',
        'Airbox Express',
        'Mail Boxes Etc.',
        'Mail Boxes Etc.',
        'Panama Pack',
        'Box Logistic',
        'Express Shipping',
        'JetBox'
    ];
    

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }
    
    public function load(ObjectManager $manager)
    {
        $orders = $this->orderRepository->findAll(); 

        //define la cantidad de pagos
        $rand = mt_rand(1, 2);
        

        foreach ($orders as $order) {
            // Asumiendo que orderDetails es una colección, utilizamos un foreach
            for ($i = 0; $i < $rand; $i++) {
                $shipmentAmount = $rand;

                $shipment = new Shipment();
                $uniqueId = time() + mt_rand(30000, 40000);
                $shipment->setShipmentId($uniqueId);
                $shipment->setOrderId($order);
                $date = new \DateTime();
                $shipment->setShipmentDate($date);
                $shipment->setCarrier($this->carrier[array_rand($this->carrier)]);
                $uuid = Uuid::uuid4(); // Genera un UUID v4
                $shipment->setTrackingNumber($uuid->toString());
                
                $manager->persist($shipment);
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
        ];
    }
}
