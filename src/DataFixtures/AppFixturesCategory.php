<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use App\Entity\Store;
use App\Repository\StoreRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixturesCategory extends Fixture implements DependentFixtureInterface
{
    private $storeRepository;

    private $category_list = [
        [
            'name' => 'Electrodomésticos',
        ],
        [
            'name' => 'Comida',
        ],
    ];
    
    public function load(ObjectManager $manager)
    {
        $count = 1;
        foreach($this->category_list as $cat)  {
            $uniqueId = Uuid::uuid4();
            $category = new Category();
            // $category->setId($count);
            $category->setCategoryId($uniqueId->toString());
            $category->setName($cat['name']);
            $category->setDescription("Description " . $cat['name']." ".$uniqueId->toString());
            $manager->persist($category);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            AppFixturesUser::class,
            AppFixturesStore::class,
        ];
    }

}
