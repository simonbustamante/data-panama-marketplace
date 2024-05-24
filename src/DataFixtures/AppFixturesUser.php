<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixturesUser extends Fixture
{
    private $passwordHasher;

    private $sex = ['male','male','male','male','male','male','male','male','female','female','female','female','female','female','female','other'];
    private $commonMaleFirstNames = [
        'Carlos',
        'José',
        'Luis',
        'Juan',
        'Miguel',
        'Roberto',
        'Jorge',
        'David',
        'Pedro',
        'Gabriel',
        'Santiago',
        'Ricardo',
        'Manuel',
        'Daniel',
        'Francisco',
        'Antonio',
        'Fernando',
        'Enrique',
        'Martín',
        'Alberto'
    ];

    private $commonFemaleFirstNames = [
        'Ana',
        'María',
        'Carmen',
        'Rosa',
        'Laura',
        'Alejandra',
        'Paola',
        'Gabriela',
        'Sandra',
        'Patricia',
        'Isabel',
        'Luisa',
        'Marta',
        'Sofía',
        'Claudia',
        'Daniela',
        'Verónica',
        'Lucía',
        'Carolina',
        'Fernanda'
    ];

    private $lastNames = [
        'González',
        'Rodríguez',
        'García',
        'Martínez',
        'López',
        'Hernández',
        'Díaz',
        'Pérez',
        'Sánchez',
        'Ramírez',
        'Torres',
        'Flores',
        'Álvarez',
        'Moreno',
        'Ramos',
        'Castillo',
        'Jiménez',
        'Gutiérrez',
        'Mendoza',
        'Vásquez'
    ];

    private $addresses = [
        'Calle 50 y Calle 68, San Francisco, Ciudad de Panamá',
        'Calle 74 Este, San Francisco, Ciudad de Panamá',
        'Vía Argentina, El Cangrejo, Ciudad de Panamá',
        'Calle Eusebio A. Morales, El Cangrejo, Ciudad de Panamá',
        'Avenida Balboa, Bella Vista, Ciudad de Panamá',
        'Calle 42, Bella Vista, Ciudad de Panamá',
        'Avenida Italia, Punta Paitilla, Ciudad de Panamá',
        'Calle Winston Churchill, Punta Paitilla, Ciudad de Panamá',
        'Calle Punta Colon, Punta Pacifica, Ciudad de Panamá',
        'Boulevard Pacifica, Punta Pacifica, Ciudad de Panamá',
        'Avenida Centenario, Costa del Este, Ciudad de Panamá',
        'Avenida Paseo del Mar, Costa del Este, Ciudad de Panamá',
        'Plaza Catedral, Casco Viejo, Ciudad de Panamá',
        'Avenida Central, Casco Viejo, Ciudad de Panamá',
        'Avenida Omar Torrijos, Albrook, Ciudad de Panamá',
        'Calle Las Magnolias, Albrook, Ciudad de Panamá',
        'Calle 50 y Calle 58, Obarrio, Ciudad de Panamá',
        'Calle Abel Bravo, Obarrio, Ciudad de Panamá',
        'Calle 47 Este, Marbella, Ciudad de Panamá',
        'Avenida Aquilino de la Guardia, Marbella, Ciudad de Panamá',
        'Calzada de Amador, Causeway, Ciudad de Panamá',
        'Avenida de los Poetas, Causeway, Ciudad de Panamá',
        'Avenida Punta Darién y Vía Israel, Punta Pacifica, Ciudad de Panamá',
        'Avenida Roosevelt, Albrook, Ciudad de Panamá',
        'Avenida Domingo Díaz, Cerro Viento, Ciudad de Panamá',
        'Calle 50 y Calle 53 Este, Obarrio, Ciudad de Panamá',
        'Avenida Domingo Díaz, Juan Díaz, Ciudad de Panamá',
        'Calle 3ra, Casco Viejo, Ciudad de Panamá',
        'Avenida Balboa, Ciudad de Panamá',
        'Vía Porras, San Francisco, Ciudad de Panamá',
        'Avenida Cuba y Calle 38, Bella Vista, Ciudad de Panamá',
        'Avenida Omar Torrijos Herrera, Ancón, Ciudad de Panamá',
        'Calzada de Amador, Causeway, Ciudad de Panamá',
        'Vía Cincuentenario, Panamá Viejo, Ciudad de Panamá'
    ];

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }
    
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 2; $i++) {
            echo $i." ";
            $user = new User();
            $uniqueId = Uuid::uuid4();
            // $user->setId($uniqueId);
            $user->setName($this->getRandomFullName());
            $user->setUserId($uniqueId->toString());
            $user->setEmail($this->createFakeUserEmail($user->getName(), $uniqueId));
            $user->setRoles(['ROLE_USER']);
            $user->setAddress($this->getRandomAddress());
            $user->setPhone("+50769999999");
            $hashedPassword = $this->passwordHasher->hashPassword($user, 'abcd1234');
            $user->setPassword($hashedPassword);
            $manager->persist($user);

        }
        $manager->flush();
    }

    private function generateUniqueUserId(): int
    {
        return time() + mt_rand(0, 9999);
    }

    private function getRandomAddress(): string
    {
        return $this->addresses[array_rand($this->addresses)];
    }

    public function getRandomFullName(): string
    {
        $gender = $this->sex[array_rand($this->sex)];
        if ($gender === 'male') {
            $firstName = $this->commonMaleFirstNames[array_rand($this->commonMaleFirstNames)];
        } elseif ($gender === 'female') {
            $firstName = $this->commonFemaleFirstNames[array_rand($this->commonFemaleFirstNames)];
        } else {
            $firstNames = array_merge($this->commonMaleFirstNames, $this->commonFemaleFirstNames);
            $firstName = $firstNames[array_rand($firstNames)];
        }
        $lastName = $this->lastNames[array_rand($this->lastNames)];
        return "$firstName $lastName";
    }

    private function createFakeUserEmail(string $name, string $uniqueId): string
    {
        $normalized_name = strtolower(str_replace(' ', '.', $name)).$uniqueId;
        return $normalized_name . '@example.com';
    }

}
