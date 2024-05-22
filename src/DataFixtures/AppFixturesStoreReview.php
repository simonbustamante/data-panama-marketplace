<?php

namespace App\DataFixtures;

use App\Entity\ProductReview;
use App\Entity\Shipment;
use App\Entity\StoreReview;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use App\Repository\StoreRepository;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;

class AppFixturesStoreReview extends Fixture implements DependentFixtureInterface
{
    private $storeRepository;
    private $userRepository;

    private $genericReviews = [
        ["review" => "Atención al cliente excepcional, muy satisfecho.", "rating" => 5],
        ["review" => "No me atendieron bien, bastante decepcionado.", "rating" => 2],
        ["review" => "Servicio rápido y eficiente.", "rating" => 5],
        ["review" => "El pedido se retrasó y no dieron solución.", "rating" => 1],
        ["review" => "Muy buen servicio, altamente recomendado.", "rating" => 5],
        ["review" => "El servicio al cliente resolvió mis dudas rápidamente.", "rating" => 4],
        ["review" => "La atención fue buena, pero el producto llegó tarde.", "rating" => 3],
        ["review" => "Muy fácil de contactar y resolver problemas.", "rating" => 4],
        ["review" => "No lo compraría de nuevo, mala atención.", "rating" => 1],
        ["review" => "Perfecto, me ayudaron en todo el proceso.", "rating" => 5],
        ["review" => "Servicio excelente, superó mis expectativas.", "rating" => 5],
        ["review" => "Atención pésima, no volveré a comprar aquí.", "rating" => 1],
        ["review" => "El servicio fue rápido y eficiente.", "rating" => 4],
        ["review" => "No resolvieron mis problemas, no lo recomendaría.", "rating" => 2],
        ["review" => "Buena atención y precios asequibles.", "rating" => 5],
        ["review" => "La atención fue correcta, sin problemas.", "rating" => 4],
        ["review" => "Muy mala experiencia con el servicio al cliente.", "rating" => 1],
        ["review" => "Entrega rápida y buen servicio al cliente.", "rating" => 4],
        ["review" => "No me ayudaron con mi problema, muy decepcionante.", "rating" => 1],
        ["review" => "Excelente servicio, lo recomendaría.", "rating" => 5],
        ["review" => "La atención fue regular, podría mejorar.", "rating" => 3],
        ["review" => "Excelente atención, volveré a comprar.", "rating" => 5],
        ["review" => "El servicio al cliente fue muy atento y profesional.", "rating" => 4],
        ["review" => "Muy satisfecho con el servicio, todo perfecto.", "rating" => 4],
        ["review" => "No estoy contento con el servicio, muy lento.", "rating" => 2],
        ["review" => "La atención fue impecable, muy profesional.", "rating" => 5],
        ["review" => "No volveré a comprar aquí, mala experiencia con el servicio.", "rating" => 1],
        ["review" => "Muy recomendable, excelente atención.", "rating" => 5],
        ["review" => "El pedido llegó antes de lo esperado, muy contento.", "rating" => 4],
        ["review" => "El servicio fue aceptable, aunque esperaba más.", "rating" => 3],
        ["review" => "Difícil de contactar, instrucciones poco claras.", "rating" => 2],
        ["review" => "Atención de alta calidad, muy satisfecho.", "rating" => 5],
        ["review" => "No recomendaría este servicio, muy decepcionante.", "rating" => 2],
        ["review" => "Gran atención al cliente, volveré a comprar.", "rating" => 5],
        ["review" => "El servicio fue lento, pero el personal fue amable.", "rating" => 3],
        ["review" => "Muy contento con la calidad del servicio.", "rating" => 4],
        ["review" => "El servicio no fue como se describe.", "rating" => 1],
        ["review" => "Excelente servicio, lo recomendaría a otros.", "rating" => 5],
        ["review" => "La atención no justifica el precio.", "rating" => 2],
        ["review" => "Servicio y atención al cliente excepcionales.", "rating" => 5],
        ["review" => "No estoy satisfecho con la atención recibida.", "rating" => 2],
        ["review" => "Me encanta el servicio, definitivamente volveré a comprar.", "rating" => 5],
        ["review" => "El pedido llegó en malas condiciones, mala atención.", "rating" => 1],
        ["review" => "Muy buena atención por el precio.", "rating" => 4],
        ["review" => "El servicio no vale la pena el dinero.", "rating" => 2],
        ["review" => "Funciona perfectamente para mis necesidades.", "rating" => 4],
        ["review" => "El servicio no fue el adecuado, no lo recomiendo.", "rating" => 2],
        ["review" => "Muy satisfecho con la calidad del servicio y la entrega.", "rating" => 5],
        ["review" => "El pedido llegó tarde y en malas condiciones.", "rating" => 1],
        ["review" => "Muy buen servicio, volveré a comprar.", "rating" => 4],
        ["review" => "La calidad del servicio es inferior a lo esperado.", "rating" => 2],
    ];
    

    public function __construct(StoreRepository $storeRepository, UserRepository $userRepository)
    {
        $this->storeRepository = $storeRepository;
        $this->userRepository = $userRepository;
    }
    
    public function load(ObjectManager $manager)
    {
        $users = $this->userRepository->findAll();
        $stores = $this->storeRepository->findAll(); 

        //define la cantidad de comentarios
        $rand = mt_rand(5, 10);
        
        foreach ($stores as $store) {
            foreach($users as $user){
                for ($i = 0; $i < $rand; $i++) {
                    $storeReview = new StoreReview();
                    $uniqueId = Uuid::uuid4();
                    $storeReview->setReviewId($uniqueId->toString());
                    $storeReview->setStoreId($store);
                    $storeReview->setUserId($user);
                    $review = $this->genericReviews[array_rand($this->genericReviews)];
                    $storeReview->setRating($review['rating']);
                    $storeReview->setComment($review['review']);
                    $date = new \DateTime();
                    $storeReview->setReviewDate($date);
                    
                    $manager->persist($storeReview);
                }
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
        ];
    }
}
