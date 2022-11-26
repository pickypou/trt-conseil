<?php

namespace App\Controller;

use App\Entity\Annonces;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/admin'),IsGranted('ROLE_ADMIN')]
class AdminController extends AbstractController
{

    //list users
    #[Route('/list/{page?1}/{nbre?12}', name: 'app_list_user')]
    public function index(ManagerRegistry $doctrine, $page, $nbre): Response
    {
        $repository = $doctrine->getRepository(User::class);
        $nbusers = $repository->count([]);
      
        $nbrePage = ceil($nbusers / $nbre);

        $users = $repository->findBy([], [], $nbre, ($page - 1) * $nbre);
       
        return $this->render('admin/listUsers.html.twig', [
            'users' => $users,
            'isPaginated' => true,
            'nbrePage' => $nbrePage,
            'page' => $page,
            'nbre' => $nbre
        ]);
    }

   
    //detail users
    #[Route('/detail/{id<\d+>}', name: 'app_detail_user')]
    public function detail_user(ManagerRegistry $doctrine, $id): Response
    {
        $repository = $doctrine->getRepository(User::class);
        $user = $repository->find($id);
        
        return $this->render('admin/detail_user.html.twig', [
            'user' => $user,
                
        ]);
}
    //delete_user
    #[Route('/delete/{id}', name: 'app_delete_user')]
    public function deletePersonne(User $user = null, ManagerRegistry $doctrine): RedirectResponse
    {
        // Récupérer la personne
        if ($user) {
            // Si la personne existe => le supprimer et retourner un flashMessage de succés
            $manager = $doctrine->getManager();
            // Ajoute la fonction de suppression dans la transaction
            $manager->remove($user);
            // Exécuter la transacition
            $manager->flush();
            $this->addFlash('success', "La personne a été supprimé avec succès");
        } else {
            //Sinon  retourner un flashMessage d'erreur
            $this->addFlash('error', "Personne innexistante");
        }
        return $this->redirectToRoute('app_list_user');
    

    }

   


}