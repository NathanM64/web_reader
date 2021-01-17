<?php

namespace App\Controller;

use App\Entity\Book;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    /**
     * @Route("/book/{id<\d+>}", name="book_details")
     */
    public function bookDetails(Book $book): Response
    {
        $genres = $book->getGenre();

        return $this->render('book/details.html.twig', [
            'book' => $book,
            'genres' => $genres
        ]);
    }
}
