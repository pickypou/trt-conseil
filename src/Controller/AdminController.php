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
        $users = $repository->findAll();
        $nbuser =  $repository->count([]);
        $nbrePage = ceil($nbuser / $nbre);
        $users = $repository->findBy([], [], $nbre, ($page - 1) * $nbre);

        return $this->render('admin/listUsers.html.twig', [
            'users' => $users,
            'isPaginated' => true,
            'nbrePage'=>$nbrePage,
            'page'=>$page,
            'nbre'=>$nbre
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
    #[Route('/delete', name: 'app_delete_user')]
    public function delete_user(User $user = null,
     ManagerRegistry $doctrine
     ): RedirectResponse
    {
        $anotation = null;
        //recupérer user
        if($user){
            $manager = $doctrine->getManager();
            //ajoute la fonction de supression dans la transaction
            $manager->remove($user);
            //Executer la transaction
            $manager->flush();
            $anotation = "L'utilisateur à étét suprimer avec succès";


        }else {
            $anotation = "La supression à échouer";
        }


        return $this->redirectToRoute('app_list_user');
    }

    //list annonce
    #[Route('/annonces', name: 'app_annonce_all')]

    public function annoncesAlls(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Annonces::class);
        $annonces = $repository->findAll();

        return $this->render('admin/listAnnonces.html.twig', [
            'annonces' => $annonces
        ]);
    }



}