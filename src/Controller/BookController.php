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

    /**
     * @Route("/book/add", name="book_add")
     * @Route("/book/edit/{id}", name="book_edit")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY') and (book === null or book.getUser() == user)")
     */
//    public function bookForm(Request $request, EntityManagerInterface $manager, book $book = null): Response
//    {
////        if($this->getUser() === null || ($book && $book->getUser() != $this->getUser())) {
////            throw $this->createAccessDeniedException();
////        }
//        if($book === null) {
//            $book = new book();
//        }
//
//        $bookForm = $this->createForm(bookType::class, $book);
//
//        $bookForm->handleRequest($request);
//
//        if($bookForm->isSubmitted() && $bookForm->isValid()) {
//            // enregistrement du jeu en base de données
//            if( ! $book->getId()) {
//                $book->setDateAdd(new \DateTime());
//                $book->setUser($this->getUser());
//            }
//            $manager->persist($book);
//            $manager->flush();
//            return $this->redirectToRoute('profile');
//        }
//
//        return $this->render('book/book-form.html.twig', [
//            'book_form' => $bookForm->createView(),
//            'book' => $book
//        ]);
//    }
}
