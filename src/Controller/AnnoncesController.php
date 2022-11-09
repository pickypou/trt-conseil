<?php

namespace App\Controller;

use App\Entity\Annonces;
use App\Entity\Recruteurs;
use App\Entity\User;
use App\Form\AnnoncesType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnnoncesController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/annonces', name: 'app_annonces')]
    public function index(
        Request $request,
        Recruteurs $recruteur =null,
        ManagerRegistry $doctrine
    ): Response
    {
        $annonces = new Annonces();
        $form = $this->createForm(AnnoncesType::class,$annonces);
        $form->remove('annonce');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $annonces = $form->getData();
           
            $recruteur = $this->getUser();
            if ($recruteur) {
               $recruteur->addAnnonce($annonces);
               $manager = $doctrine->getManager();
               $recruteur = $form->getData();
               $manager->persist($recruteur);
            }
            $this->entityManager->persist($annonces);
            $this->entityManager->flush();
            return $this->redirectToRoute('app_account');
        }


        return $this->render('annonces/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
