<?php

namespace App\DataFixtures;

use App\Entity\Order;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixturesOrder extends Fixture implements DependentFixtureInterface
{
    
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public function load(ObjectManager $manager)
    {
        $users = $this->userRepository->findAll();
        $orderCount = [1,2,3,4,5];
        foreach($orderCount as $count){
            foreach($users as $user)  {
                $order = new Order();
                $uniqueId = $this->generateUniqueUserId();
                // $order->setId($uniqueId);

                //dump($order->getId());dump($uniqueId);die();
                $order->setOrderId($uniqueId);
                $order->setUserId($user);
                $date = new \DateTime();
                $order->setOrderDate($date);
                $order->setStatus(TRUE);
                $order->setTotal("0");
                $manager->persist($order);
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            AppFixturesUser::class,
            AppFixturesStore::class,
            AppFixturesProduct::class,
            AppFixturesCategory::class,
        ];
    }

    private function generateUniqueUserId(): int
    {
        return mt_rand(0, 9999) + time();
    }

}
