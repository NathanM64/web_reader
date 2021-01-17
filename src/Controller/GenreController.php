<?php

namespace App\Controller;

use App\Entity\Genre;
use App\Repository\BookRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GenreController extends AbstractController
{
    /**
     * @Route("/genre/{id}/{page}", name="book_by_genre")
     * @param Genre $genre
     * @param BookRepository $bookRepository
     * @param PaginatorInterface $paginator
     * @param int $page
     * @return Response
     */
    public function index(Genre $genre, BookRepository $bookRepository, PaginatorInterface $paginator, $page = 1): Response
    {
        return $this->render('genre/book_by_genre.html.twig', [
            'genre' => $genre,
            'books' => $bookRepository->getLatestPaginatedBooksByCategory($genre, $paginator, $page)
        ]);
    }
}
