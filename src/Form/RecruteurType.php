<?php

namespace App\Form;

use App\Entity\Recruteurs;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecruteurType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('company', TextType::class, [
            'label' => 'Votre entreprise',
            'attr' => [
                'placeholder' => 'Le grand restaurant'
            ]
        ])
            ->add('street', TextType::class, [
            'label' => 'Rue, Avenue, Boulevard, Place',
            'attr' => [
                'placeholder' => "Rue de la bonne bouffe"
            ]
        ])
            ->add('number', TextType::class, [
            'label' => 'Numéro',
            'attr' => [
                'placeholder' => '102'
            ]
        ])
            ->add('city', TextType::class, [
            'label' => 'Ville, lieu dit',
            'attr' => [
                'placeholder' => 'lille'
            ]
        ])
            ->add('postal_code', TextType::class, [
            'label' => 'Code postal',
            'attr' => [
                'placeholder' => '5900'
            ]
        ])
            ->add('recruteur')

        ->add(
            'submit',
            SubmitType::class,
            [
                'label' => 'Valider'
            ]
        )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recruteurs::class,
        ]);
    }
}
