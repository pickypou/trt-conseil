<?php

namespace App\Controller;

use App\Entity\Annonces;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActionUserController extends AbstractController
{
    #[Route('/annonces', name: 'app_annonces_list')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Annonces::class);
        $annonces = $repository->findAll();

        return $this->render('actionUser/listAnnonces.html.twig',[
            'annonces'=>$annonces
        ] );
       
    }

    //detail annonce
    #[Route('/detail/{id<\d+>}', name: 'app_detail_annonce')]
    public function detail_annonce(ManagerRegistry $doctrine, $id): Response
    {
        $repository = $doctrine->getRepository(Annonces::class);
        $annonce = $repository->find($id);

        return $this->render('actionUser/detail_annonce.html.twig', [
            'annonce' => $annonce,

        ]);
    }
}
