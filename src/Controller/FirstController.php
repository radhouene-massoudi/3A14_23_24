<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirstController extends AbstractController
{
    #[Route('/first', name: 'app_first')]
    public function index(): Response
    {
        return $this->render('first/index.html.twig', [
            'controller_name' => 'FirstController',
        ]);
    }

    #[Route('/msg')]
    public function msg()
    {
        return new Response('bonjour');
    }
    #[Route('/html')]
    public function html()
    {
        return new Response(' <h1>bonjour 3A14 </h1>');
    }

    #[Route('/json')]
    public function json1()
    {
        return new JsonResponse(' bonjour 3A14 ');
    }

    #[Route('/test', name: 'test')]
    public function test(): Response
    {
        return $this->render('first/new.html');
    }

    #[Route('/twig/{p}', name: 'twig')]
    public function twig($p): Response
    {
        return $this->render('first/twig.html.twig',
        [
            't'=>$p
        ]
    );
    }
    #[Route('/list', name: 'list')]
    public function list(): Response
    {
        $authors = array(
            array('id' => 1, 'picture' => '/images/Victor-Hugo.jpg','username' => 'Victor Hugo', 'email' =>
            'victor.hugo@gmail.com ', 'nb_books' => 100),
            array('id' => 2, 'picture' => '/images/william-shakespeare.jpg','username' => ' William Shakespeare', 'email' =>
            ' william.shakespeare@gmail.com', 'nb_books' => 200 ),
            array('id' => 3, 'picture' => '/images/Taha_Hussein.jpg','username' => 'Taha Hussein', 'email' =>
            'taha.hussein@gmail.com', 'nb_books' => 300),
            );
           
              return $this->render('first/list.html.twig',
        [
            'tab'=>$authors
        ]
    );
    }
}
