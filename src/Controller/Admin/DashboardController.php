<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Barco;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        if ($this->isGranted('ROLE_ADMIN')) {
            return parent::index();
        }if ($this->isGranted('ROLE_USER')) {
            return $this->redirectToRoute('barco');
        }else{
            return $this->redirectToRoute('barco');
        }
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Proyecto Barcos')
            ->setFaviconPath('images/hero_1.jpg')
            ->setTranslationDomain('my-custom-domain')
            ->setTextDirection('ltr')
            ->renderContentMaximized()
            ->renderSidebarMinimized()
            ->disableUrlSignatures()
            ->generateRelativeUrls();
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::section('Barcos'),
            MenuItem::linkToCrud('Barcos', 'fas fa-ship', Barco::class),

            MenuItem::section('Users'),
            MenuItem::linkToCrud('Users', 'fa fa-user', User::class),
        ];
    }
}
