<?php

namespace App\Controller\Admin;

use App\Entity\Book;
use App\Entity\Chapter;
use App\Entity\Comment;
use App\Entity\Genre;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Web Reader');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Livres', 'fa fa-book', Book::class);
        yield MenuItem::linkToCrud('Utilisateurs', 'fa fa-book', User::class);
        yield MenuItem::linkToCrud('Commentaires', 'fa fa-book', Comment::class);
        yield MenuItem::linkToCrud('Chapitres', 'fa fa-book', Chapter::class);
        yield MenuItem::linkToCrud('Genre', 'fa fa-book', Genre::class);



        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
