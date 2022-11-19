<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    #[Route('/account', name: 'app_account')]
    public function index(): Response
    {
        if ($this->isGranted('ROLE_ADMIN')) {
           return $this->render('admin/index.html.twig');
        }
        if ($this->isGranted('ROLE_MANAGER')) {
            return $this->render('admin/index.html.twig');
        }
        if ($this->isGranted('ROLE_RECRUTEUR')) {
            return $this->render('account/recruteur.html.twig');
        }
        return $this->render('account/index.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }
}
