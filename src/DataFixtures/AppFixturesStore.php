<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Store;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixturesStore extends Fixture implements DependentFixtureInterface
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    
    public function load(ObjectManager $manager)
    {
        $users = $this->userRepository->findAll();
        foreach($users as $user)  {
            $store = new Store();
            $uniqueId = time() + mt_rand(0, 9999);
            // $store->setId($uniqueId);
            $store->setStoreId($uniqueId);
            $store->setUser($user);
            $store->setName('Store ' . $user->getName());
            $store->setDescription('Description for store ' . $user->getName());
            $store->setCreatedDate(new \DateTime());
            $store->setActive(true);
            $manager->persist($store);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            AppFixturesUser::class,
        ];
    }

}
