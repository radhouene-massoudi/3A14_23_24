<?php

namespace App\Controller;

use App\Entity\Med;
use App\Repository\HopRepository;
use App\Repository\MedRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/med')]
class MedController extends AbstractController
{
    #[Route('/med', name: 'app_med')]
    public function index(): Response
    {
        return $this->render('med/index.html.twig', [
            'controller_name' => 'MedController',
        ]);
    }


    #[Route('/add', name: 'add')]
    public function add(ManagerRegistry $mr, HopRepository $repo, MedRepository $repoMed)
    {
        $hopital = $repo->find(5);
        $med = new Med();
        $med->setCin(234566);
        $med->setName('mohamed');
        $med->setSurname('mohamed');
        $med->setTel(222222);
        $med->setHop($hopital);

        $result = $repoMed->find($med->getCin());
        //dd($result);
        if ($result == null) {
            $em = $mr->getManager();

            $em->persist($med);
            $em->flush();
            return new Response('added');
        } else {
            return new Response('id existe');
        }
    }
}
