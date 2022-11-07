<?php

namespace App\Controller;

use App\Form\ChangePasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use \Symfony\Component\Security\Core\User\UserInterface;

class ChangePasswordController extends AbstractController
{  
    private $entitymanager;
    public function __construct(EntityManagerInterface $entitymanager)
    {
        $this->entitymanager = $entitymanager;
    }

        
    #[Route('/change/password', name: 'app_change_password')]
    public function index(Request $request, UserPasswordHasherInterface $passwordhasher): Response
    {
        $notification = null;

        $user = $this->getUser();

        $form = $this->createForm(ChangePasswordType::class, $user);
        $form->remove('roles');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $old_pwd = $form->get('new_password')->getData();
            if ($passwordhasher->isPasswordValid($user, $old_pwd)) {
                $new_pwd = $form->get('new_password')->getData();
                $password = $passwordhasher->hashPassword($user, $new_pwd);

                $user->setPassword($password);
                $this->entityManager->flush();
                $notification = "Votre mot de passe à été mis à jour";
            } else {
                $notification = "Votre mot de passe actuel n'est pas le bon";

                return $this->redirectToRoute('app_account');
 }
}
      
        return $this->render('account/changePassword.html.twig', [
            'form'=>$form->createView()
        ]);
   
    }
}