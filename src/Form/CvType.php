<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class CvType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
            'disabled' => true,
            'label' => 'Votre adresse email'
        ])
            ->add('roles')
            ->add('password')
            ->add('firstname', TextType::class, [
            'disabled' => true,
            'label' => 'Votre prénom'
        ])
            ->add('lastname', TextType::class, [
            'disabled' => true,
            'label' => 'Votre nom'
        ])
            ->add('curriculumvitae',FileType::class, [
            'label' => 'Déposer votre cv au format PDF (PDF file)',
            'mapped' => false,
            'required' => true,
            'constraints' => [
                new File([
                    'maxSize' => '1024k',
                    'mimeTypes' => [
                        'application/pdf',
                        'application/x_pdf',
                    ],
                    'mimeTypesMessage' => 'Merci de choisir un fichier valide',
                ])
            ],

        ])
        ->add('submit', SubmitType::class, [
            'label' => 'Envoyer mon cv'
        ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
