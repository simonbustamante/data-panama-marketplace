<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\Store;
use App\Repository\CategoryRepository;
use App\Repository\StoreRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixturesProduct extends Fixture implements DependentFixtureInterface
{
    private $categoryRepository;
    private $storeRepository;
    private $home_appliances = [
        [
            'name' => 'Refrigerador',
            'average_price' => 1200.00
        ],
        [
            'name' => 'Lavadora',
            'average_price' => 800.00
        ],
        [
            'name' => 'Secadora',
            'average_price' => 700.00
        ],
        [
            'name' => 'Horno Microondas',
            'average_price' => 150.00
        ],
        [
            'name' => 'Horno Eléctrico',
            'average_price' => 300.00
        ],
        [
            'name' => 'Lavavajillas',
            'average_price' => 600.00
        ],
        [
            'name' => 'Aspiradora',
            'average_price' => 200.00
        ],
        [
            'name' => 'Plancha',
            'average_price' => 50.00
        ],
        [
            'name' => 'Ventilador',
            'average_price' => 80.00
        ],
        [
            'name' => 'Aire Acondicionado',
            'average_price' => 1000.00
        ],
        [
            'name' => 'Cafetera',
            'average_price' => 100.00
        ],
        [
            'name' => 'Tostadora',
            'average_price' => 40.00
        ],
        [
            'name' => 'Licuadora',
            'average_price' => 60.00
        ],
        [
            'name' => 'Batidora',
            'average_price' => 100.00
        ],
        [
            'name' => 'Exprimidor de Cítricos',
            'average_price' => 30.00
        ],
        [
            'name' => 'Freidora',
            'average_price' => 150.00
        ],
        [
            'name' => 'Sandwichera',
            'average_price' => 25.00
        ],
        [
            'name' => 'Olla de Cocción Lenta',
            'average_price' => 70.00
        ],
        [
            'name' => 'Horno de Convección',
            'average_price' => 250.00
        ],
        [
            'name' => 'Calentador de Agua',
            'average_price' => 300.00
        ],
        [
            'name' => 'Radiador Eléctrico',
            'average_price' => 150.00
        ],
        [
            'name' => 'Secador de Pelo',
            'average_price' => 40.00
        ],
        [
            'name' => 'Afeitadora Eléctrica',
            'average_price' => 60.00
        ],
        [
            'name' => 'Purificador de Aire',
            'average_price' => 200.00
        ],
        [
            'name' => 'Deshumidificador',
            'average_price' => 250.00
        ],
        [
            'name' => 'Humidificador',
            'average_price' => 50.00
        ],
        [
            'name' => 'Máquina de Hielo',
            'average_price' => 150.00
        ],
        [
            'name' => 'Cocina de Inducción',
            'average_price' => 500.00
        ],
        [
            'name' => 'Cocina a Gas',
            'average_price' => 600.00
        ],
        [
            'name' => 'Cocina Eléctrica',
            'average_price' => 550.00
        ]
    ];

    private $foods = [
        [
            'name' => 'Manzanas',
            'average_price' => 1.50
        ],
        [
            'name' => 'Plátanos',
            'average_price' => 0.50
        ],
        [
            'name' => 'Naranjas',
            'average_price' => 1.00
        ],
        [
            'name' => 'Uvas',
            'average_price' => 2.00
        ],
        [
            'name' => 'Fresas',
            'average_price' => 3.00
        ],
        [
            'name' => 'Lechuga',
            'average_price' => 1.20
        ],
        [
            'name' => 'Tomates',
            'average_price' => 1.80
        ],
        [
            'name' => 'Zanahorias',
            'average_price' => 1.00
        ],
        [
            'name' => 'Brócoli',
            'average_price' => 2.50
        ],
        [
            'name' => 'Papas',
            'average_price' => 1.00
        ],
        [
            'name' => 'Cebollas',
            'average_price' => 1.20
        ],
        [
            'name' => 'Pechuga de Pollo',
            'average_price' => 5.00
        ],
        [
            'name' => 'Filete de Res',
            'average_price' => 8.00
        ],
        [
            'name' => 'Chuletas de Cerdo',
            'average_price' => 4.50
        ],
        [
            'name' => 'Salmón',
            'average_price' => 10.00
        ],
        [
            'name' => 'Atún',
            'average_price' => 7.00
        ],
        [
            'name' => 'Huevos',
            'average_price' => 2.50
        ],
        [
            'name' => 'Leche',
            'average_price' => 1.20
        ],
        [
            'name' => 'Queso',
            'average_price' => 4.00
        ],
        [
            'name' => 'Yogur',
            'average_price' => 0.80
        ],
        [
            'name' => 'Pan',
            'average_price' => 1.50
        ],
        [
            'name' => 'Arroz',
            'average_price' => 0.90
        ],
        [
            'name' => 'Pasta',
            'average_price' => 1.20
        ],
        [
            'name' => 'Aceite de Oliva',
            'average_price' => 6.00
        ],
        [
            'name' => 'Mantequilla',
            'average_price' => 2.50
        ],
        [
            'name' => 'Azúcar',
            'average_price' => 0.80
        ],
        [
            'name' => 'Sal',
            'average_price' => 0.50
        ],
        [
            'name' => 'Café',
            'average_price' => 4.00
        ],
        [
            'name' => 'Té',
            'average_price' => 3.00
        ],
        [
            'name' => 'Jugo de Naranja',
            'average_price' => 3.50
        ]
    ];
    

    private $brands = [
        'Samsung',
        'LG',
        'Whirlpool',
        'Bosch',
        'GE Appliances',
        'Frigidaire',
        'Electrolux',
        'KitchenAid',
        'Maytag',
        'Panasonic',
        'Sony',
        'Sharp',
        'Philips',
        'Miele',
        'Siemens',
        'Toshiba',
        'Hitachi',
        'Haier',
        'Kenmore',
        'Dyson',
        'Breville',
        'Hamilton Beach',
        'Oster',
        'Black+Decker',
        'Cuisinart',
        'DeLonghi',
        'Krups',
        'Braun',
        'Viking',
        'Sub-Zero'
    ];

    public function __construct(
            CategoryRepository $categoryRepository,
            StoreRepository $storeRepository
        )
    {
        $this->categoryRepository = $categoryRepository;
        $this->storeRepository = $storeRepository;
    }
    
    public function load(ObjectManager $manager)
    {
        $category = $this->categoryRepository->findAll();
        $stores = $this->storeRepository->findAll();
        foreach($category as $cat){
            if($cat->getName() == "Electrodomésticos"){
                foreach($stores as $store)  {
                    foreach($this->home_appliances as $appliance){
                        $product = new Product();
                        $uniqueId = Uuid::uuid4();
                        // $product->setId($uniqueId);
                        $product->setProductId($uniqueId->toString());
                        $product->setStoreId($store);
                        $product->setName($appliance['name']." ".$this->brands[array_rand($this->brands)]);
                        $product->setDescription("Description ".$product->getName());
                        $product->setPrice($appliance['average_price']);
                        $product->setStockQuantity(mt_rand(1, 100));
                        $product->setCategoryId($cat);
                        $product->setImageUrl(NULL);
                        $date = new \DateTime();
                        $product->setCreatedDate($date);

                        $manager->persist($product);
                    }
                }
            }
            elseif($cat->getName() == "Comida"){
                foreach($stores as $store)  {
                    foreach($this->foods as $food){
                        $product = new Product();
                        $uniqueId = Uuid::uuid4();
                        
                        $product->setProductId($uniqueId->toString());
                        $product->setStoreId($store);
                        $product->setName($food['name']);
                        $product->setDescription("Description ".$product->getName());
                        $product->setPrice($food['average_price']);
                        $product->setStockQuantity(mt_rand(1, 100));
                        $product->setCategoryId($cat);
                        $product->setImageUrl(NULL);
                        $date = new \DateTime();
                        $product->setCreatedDate($date);

                        $manager->persist($product);
                    }
                }
            }
        }
        $manager->flush();
    }

    public function getFakeApplianceList(){
        return $this->home_appliances;
    }

    public function getFakeFoodList(){
        return $this->foods;
    }

    public function getDependencies()
    {
        return [
            AppFixturesUser::class,
            AppFixturesStore::class,
            AppFixturesCategory::class,
        ];
    }

    

}
