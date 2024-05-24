<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Repository\UserRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use League\Csv\Writer;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserCrudController extends AbstractCrudController
{
    private $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {

        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('email'),
            TextField::new('password')->hideOnIndex(),
            IdField::new('userId'),
            TextField::new('phone'),
            TextField::new('address'),
            ChoiceField::new('roles')->allowMultipleChoices()->setChoices(
                [
                    'User'=> 'ROLE_USER',
                    'Admin' => 'ROLE_ADMIN',
                ]
            ),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        $exportCsv = Action::new("exportCsv","Export to CSV")
            ->linkToCrudAction('exportCsvAction')
            ->addCssClass('btn btn-primary')
            ->setIcon('fa fa-download')
            ->createAsGlobalAction();

            return $actions
            ->add(Crud::PAGE_INDEX, $exportCsv);
    }

    
    #[Route('/admin/user/export-csv', name: 'user_export_csv')]
    
    public function exportCsvAction(): Response
    {
        $users = $this->userRepository->findAll();

        $csv = Writer::createFromString('');
        $csv->insertOne(['ID', 'Email', 'Password', 'User ID', 'Phone', 'Address', 'Roles']); // Header

        foreach ($users as $user) {
            $csv->insertOne([
                $user->getId(),
                $user->getEmail(),
                $user->getPassword(),
                $user->getUserId(),
                $user->getPhone(),
                $user->getAddress(),
                implode(',', $user->getRoles())
            ]);
        }

        // Abrir un manejador de salida
        $output = fopen('php://output', 'w');
        $csv->output('users.csv');
        fclose($output);

        return new Response('', 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="users.csv"',
        ]);
    }
    
}
