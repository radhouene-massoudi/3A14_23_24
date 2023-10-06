<?php

namespace App\Controller;

use App\Entity\Author;
use App\Repository\AuthorRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{
    public $authors = array(
        array('id' => 1, 'picture' => '/images/Victor-Hugo.jpg', 'username' => 'Victor Hugo', 'email' =>
        'victor.hugo@gmail.com ', 'nb_books' => 100),
        array('id' => 2, 'picture' => '/images/william-shakespeare.jpg', 'username' => ' William Shakespeare', 'email' =>
        ' william.shakespeare@gmail.com', 'nb_books' => 200),
        array('id' => 3, 'picture' => '/images/Taha_Hussein.jpg', 'username' => 'Taha Hussein', 'email' =>
        'taha.hussein@gmail.com', 'nb_books' => 300),
    );
    #[Route('/author', name: 'app_author')]
    public function index(): Response
    {
        return $this->render('author/index.html.twig', [
            'controller_name' => 'AuthorController',
        ]);
    }
    #[Route('/show', name: 'show')]
    public function showAuthor()
    {

        return $this->render('author/list.html.twig', [
            'tab' => $this->authors
        ]);
    }
    #[Route('/details/{id}', name: 'details')]
    public function authorDetails($id)
    {
        return $this->render(
            'author/details.html.twig',
            [
                'id' => $id,
                'tab' => $this->authors
            ]
        );
    }
    #[Route('/fetch', name: 'fetch')]
    public function fetchAuthor(ManagerRegistry $mr)
    {
        $em = $mr->getRepository(Author::class);
        $result = $em->findAll();
        dd($result);
    }
    #[Route('/fetchtwo', name: 'fetchtwo')]
    public function fetchAuthortwo(AuthorRepository $repo)
    {

        $result = $repo->findAll();
        return $this->render(
            'author/showAuthor.html.twig',
            [
                'au' => $result
            ]
        );
    }
    #[Route('/add', name: 'add')]
    public function addAuthor(ManagerRegistry $mr)
    {
        $au = new Author();
        $au->setEmail('email@gmail');
        $au->setUsername('username');
        $au->setAge(55);

        $em = $mr->getManager();
        $em->persist($au);
        $em->flush();
        return $this->redirectToRoute('fetchtwo');
    }
    #[Route('/delete/{id}', name: 'delete')]
    public function deleteAuthor(ManagerRegistry $mr, $id, AuthorRepository $repo)
    {
        $result = $repo->find($id);
        if ($result != null) {
            $em = $mr->getManager();
            $em->remove($result);
            $em->flush();
            return $this->redirectToRoute('fetchtwo');
        } else {
            return new Response(("id n'exsite pas"));
        }
    }
}
