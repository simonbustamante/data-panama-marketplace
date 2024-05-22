<?php

namespace App\DataFixtures;

use App\Entity\ProductReview;
use App\Entity\Shipment;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;

class AppFixturesProductReview extends Fixture implements DependentFixtureInterface
{
    private $productRepository;
    private $userRepository;

    private $genericReviews = [
        ["review" => "Producto excelente, muy satisfecho.", "rating" => 5],
        ["review" => "No cumplió mis expectativas, bastante decepcionado.", "rating" => 2],
        ["review" => "Calidad excelente y envío rápido.", "rating" => 5],
        ["review" => "El producto se rompió después de una semana de uso.", "rating" => 1],
        ["review" => "Increíble relación calidad-precio, muy recomendado.", "rating" => 5],
        ["review" => "El servicio al cliente fue muy útil.", "rating" => 4],
        ["review" => "El color era diferente al anunciado.", "rating" => 3],
        ["review" => "Muy fácil de usar y configurar.", "rating" => 4],
        ["review" => "No lo compraría de nuevo, mala calidad.", "rating" => 1],
        ["review" => "Perfecto para lo que necesitaba, funciona genial.", "rating" => 5],
        ["review" => "Me encanta, superó mis expectativas.", "rating" => 5],
        ["review" => "Llegó dañado, muy descontento.", "rating" => 1],
        ["review" => "El tamaño es perfecto, muy cómodo.", "rating" => 4],
        ["review" => "No es lo que esperaba, no lo recomendaría.", "rating" => 2],
        ["review" => "Gran calidad y precio asequible.", "rating" => 5],
        ["review" => "Funciona perfectamente, tal como se describe.", "rating" => 5],
        ["review" => "Muy mala experiencia, no estoy satisfecho.", "rating" => 1],
        ["review" => "Entrega rápida y buen servicio.", "rating" => 4],
        ["review" => "Producto defectuoso, no sirve.", "rating" => 1],
        ["review" => "Muy buena compra, lo recomendaría.", "rating" => 5],
        ["review" => "La calidad es mediocre, esperaba más.", "rating" => 3],
        ["review" => "Excelente servicio, volveré a comprar.", "rating" => 5],
        ["review" => "El producto es exactamente como en la descripción.", "rating" => 4],
        ["review" => "Muy satisfecho con la compra, funciona bien.", "rating" => 4],
        ["review" => "No estoy contento con el producto, muy frágil.", "rating" => 2],
        ["review" => "La calidad del producto es excepcional.", "rating" => 5],
        ["review" => "No volveré a comprar aquí, mala experiencia.", "rating" => 1],
        ["review" => "Muy recomendable, excelente calidad.", "rating" => 5],
        ["review" => "El producto llegó antes de lo esperado.", "rating" => 4],
        ["review" => "Funciona bien, pero esperaba más.", "rating" => 3],
        ["review" => "Instrucciones poco claras, difícil de usar.", "rating" => 2],
        ["review" => "Producto de alta calidad, muy satisfecho.", "rating" => 5],
        ["review" => "No recomendaría este producto, muy decepcionante.", "rating" => 2],
        ["review" => "Gran compra, lo volvería a comprar.", "rating" => 5],
        ["review" => "El envío fue muy lento, pero el producto es bueno.", "rating" => 3],
        ["review" => "Muy contento con la calidad y el precio.", "rating" => 4],
        ["review" => "El producto no funciona como se describe.", "rating" => 1],
        ["review" => "Excelente compra, lo recomendaría a otros.", "rating" => 5],
        ["review" => "La calidad no justifica el precio.", "rating" => 2],
        ["review" => "Producto y servicio al cliente excepcionales.", "rating" => 5],
        ["review" => "No estoy satisfecho con la compra.", "rating" => 2],
        ["review" => "Me encanta, definitivamente volveré a comprar.", "rating" => 5],
        ["review" => "El producto llegó en malas condiciones.", "rating" => 1],
        ["review" => "Muy buena calidad por el precio.", "rating" => 4],
        ["review" => "No vale la pena el dinero.", "rating" => 2],
        ["review" => "Funciona perfectamente para mis necesidades.", "rating" => 4],
        ["review" => "El tamaño no es el adecuado, no lo recomiendo.", "rating" => 2],
        ["review" => "Muy satisfecho con la calidad y la entrega.", "rating" => 5],
        ["review" => "El producto llegó tarde y dañado.", "rating" => 1],
        ["review" => "Muy buen servicio, volveré a comprar.", "rating" => 4],
        ["review" => "La calidad del producto es inferior a lo esperado.", "rating" => 2],
    ];
    

    public function __construct(ProductRepository $productRepository, UserRepository $userRepository)
    {
        $this->productRepository = $productRepository;
        $this->userRepository = $userRepository;
    }
    
    public function load(ObjectManager $manager)
    {
        $users = $this->userRepository->findAll();
        $products = $this->productRepository->findAll(); 

        //define la cantidad de comentarios
        $rand = mt_rand(5, 10);
        $rand = 1;
        
        foreach ($products as $product) {
            foreach($users as $user){
                for ($i = 0; $i < $rand; $i++) {
                    $shipmentAmount = $rand;
                    $productReview = new ProductReview();
                    $uniqueId = Uuid::uuid4();
                    $productReview->setReviewId($uniqueId->toString());
                    $productReview->setProductId($product);
                    $productReview->setUserId($user);
                    $review = $this->genericReviews[array_rand($this->genericReviews)];
                    $productReview->setRating($review['rating']);
                    $productReview->setComment($review['review']);
                    $date = new \DateTime();
                    $productReview->setReviewDate($date);
                    
                    $manager->persist($productReview);
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
        ];
    }
}
