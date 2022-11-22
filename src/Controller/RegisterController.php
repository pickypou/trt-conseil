<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/register', name: 'app_register')]
    public function index(Request $request, UserPasswordHasherInterface $paswwordHasher): Response
    {
        $notification = null;
        $user = new User();
       $form = $this->createForm(RegisterType::class, $user);
       $form->remove('roles');
       $form->handleRequest($request);
       if ($form->isSubmitted() && $form->isValid()) {
        $user = $form->getData();
            $search_email = $this->entityManager->getRepository(User::class)->findOneByEmail($user->getEmail());

        if (!$search_email) {
            $password = $paswwordHasher->hashPassword($user, $user->getPassword());

        $user->setPassword($password);
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $mail = new Mail();
        $content = "Bonjour"
         .$user->getfirstname().
         "TRT-Conseil vous permet une recherche d'emplois la mise en reletion avec des chef d'entrprise serrieuse
         n'oublier pas de finir la mise a jour de votre profile en déposent votre cv";
        $mail->send($user->getEmail(), $user->getFirstname(), 'Bienvenue sur TRT-CONSEIL', $content );
         $notification = "Votre inscription s est correctement déroulée. Vous pouvez dès à present accerder à votre compte";
        }else {
            $notification = "L emal que vous avait renseigner existe déjà.";
        }

       
       }
    

        return $this->render('register/index.html.twig', [
            'form'=>$form->createView(),
            'notification'=>$notification
        ]);
    }
}
