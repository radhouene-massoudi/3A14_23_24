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
}
