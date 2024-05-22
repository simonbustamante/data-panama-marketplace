<?php

namespace App\DataFixtures;

use App\Entity\Payment;
use App\Repository\OrderDetailRepository;
use App\Repository\OrderRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;

class AppFixturesPayment extends Fixture implements DependentFixtureInterface
{
    private $orderRepository;
    private $orderDetailRepository;
    private $paymentMethods = [
        'Tarjeta de Crédito Visa',
        'Tarjeta de Crédito Visa',
        'Tarjeta de Crédito Visa',
        'Cupon Panama Marketplace',
        'Cupon Panama Marketplace',
        'Cupon Panama Marketplace',
        'Cupon Panama Marketplace',
        'Cupon Panama Marketplace',
        'Cupon Panama Marketplace',
        'Tarjeta de Crédito MasterCard',
        'PayPal',
        'PayPal',
        'Transferencia Bancaria',
        'Transferencia Bancaria',
        'Transferencia Bancaria',
        'Transferencia Bancaria',
        'Yappy',
        'Yappy',
        'Yappy',
        'Yappy',
        'Yappy',
        'Yappy',
        'Yappy',
        'Yappy',
        'Yappy',
        'Yappy',
        'Yappy',
        'Yappy',
        'Yappy',
        'Yappy',
        'Yappy',
        'Yappy',
        'Efectivo',
        'Tarjeta de Débito Clave',
        'Tarjeta de Débito Visa',
        'Tarjeta de Débito MasterCard',
        'Tarjeta de Débito Visa',
        'Tarjeta de Débito MasterCard',
        'Tarjeta de Débito Visa',
        'Tarjeta de Débito MasterCard',
        'Tarjeta de Débito Visa',
        'Tarjeta de Débito MasterCard',
    ];

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }
    
    public function load(ObjectManager $manager)
    {
        $orders = $this->orderRepository->findAll(); 

        //define la cantidad de pagos
        $rand = mt_rand(1, 3);
        

        foreach ($orders as $order) {
            // Asumiendo que orderDetails es una colección, utilizamos un foreach
            for ($i = 0; $i < $rand; $i++) {
                $amount = $order->getTotal();
                $paymentAmount = $amount / $rand;

                $payment = new Payment();
                $uniqueId = Uuid::uuid4();
                $payment->setPaymentId($uniqueId->toString());
                $payment->setOrderId($order);
                $payment->setPaymentDate(new \DateTime());
                $payment->setAmount($paymentAmount);
                $payment->setMethod($this->paymentMethods[array_rand($this->paymentMethods)]);
                $manager->persist($payment);
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
        ];
    }
}
