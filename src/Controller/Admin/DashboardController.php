<?php

namespace App\Controller\Admin;

use App\Entity\BrowsingHistory;
use App\Entity\Category;
use App\Entity\Coupon;
use App\Entity\Order;
use App\Entity\OrderDetail;
use App\Entity\Payment;
use App\Entity\Product;
use App\Entity\ProductReview;
use App\Entity\Recommendation;
use App\Entity\Returns;
use App\Entity\Shipment;
use App\Entity\Store;
use App\Entity\StoreReview;
use App\Entity\User;
use App\Entity\Wishlist;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        //return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(UserCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Panama Marketplace');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('User', 'fas fa-list', User::class);
        yield MenuItem::linkToCrud('Product', 'fas fa-list', Product::class);
        yield MenuItem::linkToCrud('Category', 'fas fa-list', Category::class);
        yield MenuItem::linkToCrud('Order', 'fas fa-list', Order::class);
        yield MenuItem::linkToCrud('OrderDetail', 'fas fa-list', OrderDetail::class);
        yield MenuItem::linkToCrud('Payment', 'fas fa-list', Payment::class);
        yield MenuItem::linkToCrud('ProductReview', 'fas fa-list', ProductReview::class);
        yield MenuItem::linkToCrud('Recommendation', 'fas fa-list', Recommendation::class);
        yield MenuItem::linkToCrud('Returns', 'fas fa-list', Returns::class);
        yield MenuItem::linkToCrud('Shipment', 'fas fa-list', Shipment::class);
        yield MenuItem::linkToCrud('Store', 'fas fa-list', Store::class);
        yield MenuItem::linkToCrud('StoreReview', 'fas fa-list', StoreReview::class);
        yield MenuItem::linkToCrud('Wishlist', 'fas fa-list', Wishlist::class);
        yield MenuItem::linkToCrud('BrowsingHistory', 'fas fa-list', BrowsingHistory::class);
        yield MenuItem::linkToCrud('Coupon', 'fas fa-list', Coupon::class);
    }
}
