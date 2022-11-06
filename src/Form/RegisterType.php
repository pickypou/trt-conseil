<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname',TextType::class, [
            'label' => 'Votre prénom',
            'required' => true,
            'attr' => ['placeholder' => 'Jule']
        ])
            ->add('lastname',TextType::class, [
            'label' => 'Votre nom',
            'required' => true,
            'attr' => ['placeholder' => 'Dupont']
        ])
            ->add('email',EmailType::class, [
            'label' => 'Votre adresse email',
            'required' => true,
            'attr' => ['placeholder' => "dupont@dupont.com"]
        ])
            ->add('roles')
            ->add('password',RepeatedType::class, [
            'type' => PasswordType::class,
            'invalid_message' => 'Le mot de passe et la confirmation doivent être identique',
            'label' => 'Votre mot de passe',
            'required' => true,
            'first_options' => [
                'label' => 'Mot de passe',

            ],
            'second_options' => [
                'label' => 'Merci de confirmer votre mot de passe'
            ]
        ])
        ->add('submit', SubmitType::class, [
            'label' => 'valider votre inscription'
        ])
        
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
