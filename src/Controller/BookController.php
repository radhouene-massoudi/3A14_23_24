<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    #[Route('/book', name: 'app_book')]
    public function index(): Response
    {
        return $this->render('book/index.html.twig', [
            'controller_name' => 'BookController',
        ]);
    }

    #[Route('/addbook', name: 'addbook')]
    public function addbook(ManagerRegistry $mr, Request $req): Response
    {
        $book = new Book();

        $frormu = $this->createForm(BookType::class, $book);
        $frormu->handleRequest($req);

        if ($frormu->isSubmitted()) {
            $currentlydate = new \DateTime('now');
            $book->setCreatedAt($currentlydate);
            $titre = $book->getTitle();
            $ageAuthor = $book->getAuthors()->getAge();
            //dd($titre);
            if ($ageAuthor > 60) {
                if (str_starts_with($titre, 'book_')) {
                    $em = $mr->getManager();
                    $em->persist($book);
                    $em->flush();
                    return $this->redirectToRoute('books');
                } else {
                    return new Response('le titre starts with book_');
                }
            } else {
                return new Response("age <60");
            }
        }
        return $this->render('book/newbook.html.twig', [
            'f' => $frormu->createView()
        ]);
    }

    #[Route('/update/{id}', name: 'update')]
    public function update(ManagerRegistry $mr, Request $req, $id, BookRepository $repo): Response
    {
        $book = $repo->find($id);

        $frormu = $this->createForm(BookType::class, $book);
        $frormu->handleRequest($req);

        if ($frormu->isSubmitted()) {
            $em = $mr->getManager();
            //  $em->persist($book);
            $em->flush();
            return $this->redirectToRoute('books');
        }
        return $this->renderForm('book/update.html.twig', [
            'f' => $frormu
        ]);
    }
    #[Route('/books', name: 'books')]
    public function fetchBooks(ManagerRegistry $mr)
    {
        $repo = $mr->getRepository(Book::class);
        $result = $repo->findAll();
        return $this->render('book/list.html.twig', [
            'resul' => $result
        ]);
    }
    #[Route('/book/{id}', name: 'book')]
    public function fetchBook(BookRepository $repo , $id)
    {$result=$repo->find($id);
        
        return $this->render('book/detail.html.twig', [
            'resul' => $result
        ]);
    }
    #[Route('/deletebook/{id}', name: 'removebook')]
    public function removeBook(BookRepository $repo , $id,ManagerRegistry $mr)
    {
        $result=$repo->find($id);
        $em=$mr->getManager();
        $em->remove($result);
        $em->flush();
        return $this->redirectToRoute('books'); 
    }
}