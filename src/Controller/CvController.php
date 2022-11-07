<?php

namespace App\Controller;

use App\Form\CvType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class CvController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    #[Route('/cv', name: 'app_cv')]
    public function index(Request $request, SluggerInterface $slugger): Response
    {
        $user = $this->getUser();

        $form = $this->createForm(CvType::class, $user);
        $form->remove('roles');
        $form->remove('password');

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $filePdf = $form->get('curriculumvitae')->getData();
            if ($filePdf) {
                $originalFileName = pathinfo($filePdf->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFileName);
                $newFilename = $safeFilename . '_' . uniqid() . '.' . $filePdf->guessExtension();
                try {
                    $filePdf->move(
                        $this->getParameter('cv_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                }
                $user->setCv($newFilename);
                $this->entityManager->persist($user);
                $this->entityManager->flush();
                return $this->redirectToRoute('app_account');
            }
        }
            
        
        return $this->render('account/cv.html.twig', [
           'form'=>$form->createView()
        ]);
    }
}
