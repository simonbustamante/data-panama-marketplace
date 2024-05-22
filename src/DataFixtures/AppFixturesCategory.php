<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use App\Entity\Store;
use App\Repository\StoreRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
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
            $category = new Category();
            // $category->setId($count);
            $category->setCategoryId($count++);
            $category->setName($cat['name']);
            $category->setDescription("Description " . $cat['name']);
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
