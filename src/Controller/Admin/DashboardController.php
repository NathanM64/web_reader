<?php

namespace App\Controller\Admin;

use App\Entity\Book;
use App\Entity\Chapter;
use App\Entity\Comment;
use App\Entity\Genre;
use App\Entity\User;
use App\Repository\BookRepository;
use App\Repository\ChapterRepository;
use App\Repository\CommentRepository;
use App\Repository\UserRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    protected $userRepository;
    protected $bookRepository;
    protected $chapterRepository;
    protected $commentRepository;

    public function __construct(UserRepository $userRepository, BookRepository $bookRepository, ChapterRepository $chapterRepository, CommentRepository $commentRepository)
    {
        $this->userRepository = $userRepository;
        $this->bookRepository = $bookRepository;
        $this->chapterRepository = $chapterRepository;
        $this->commentRepository = $commentRepository;
    }

    /**
     * @Route("/admin", name="admin")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function index(): Response
    {
        return $this->render('bundles/EasyAdminBundle/welcome.html.twig',[
            'countAllUsers' => $this->userRepository->countAllUsers(),
            'countAllBooks' => $this->bookRepository->countAllBooks(),
            'countAllChapters' => $this->chapterRepository->countAllChapters(),
            'countAllComments' => $this->commentRepository->countAllComments(),

        ]);
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
        yield MenuItem::linkToCrud('Utilisateurs', 'fa fa-user', User::class);
        yield MenuItem::linkToCrud('Commentaires', 'fa fa-comment', Comment::class);
        yield MenuItem::linkToCrud('Chapitres', 'fa fa-bookmark', Chapter::class);
        yield MenuItem::linkToCrud('Genre', 'fa fa-sort', Genre::class);



        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
