<?php

namespace App\Controller;

use App\Entity\Recruteurs;
use App\Entity\User;
use App\Form\RecruteurType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecruteurController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this ->entityManager = $entityManager;
    }
    #[Route('/recruteur', name: 'app_recruteur')]
    public function index(
        Request $request,
    User $user = null,
    ManagerRegistry $doctrine
    ): Response
    {
        $recruteurs= new Recruteurs();
        $form = $this->createForm(RecruteurType::class, $recruteurs);
        $form->remove('recruteur');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $recruteurs = $form->getData();
            $user = $this->getUser();
            if ($user) {
                $user->setRecruteurs($recruteurs);
                $manager = $doctrine->getManager();
                $user = $form->getData();
                $manager->persist($user);
            }

            $this->entityManager->persist($recruteurs);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_account');
        }
        
        return $this->render('recruteur/index.html.twig', [
            'form' =>$form->createView(),
        ]);
    }
}
