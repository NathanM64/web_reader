<?php

namespace App\Controller;

use App\Repository\BookRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @Route("/page/{page}", name="home_paginated")
     * @param BookRepository $bookRepository
     * @param PaginatorInterface $paginator
     * @param int $page
     * @return Response
     */
    public function index(BookRepository $bookRepository, PaginatorInterface $paginator, $page = 1): Response
    {
        $books = $bookRepository->getLatestPaginatedBooks($paginator, $page);
        $books->setUsedRoute('home_paginated');
//        dd($books);
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'books' => $books
        ]);
    }
}
