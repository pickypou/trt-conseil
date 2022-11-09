<?php

namespace App\Form;

use App\Entity\Annonces;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnnoncesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('company', TextType::class, [
                'mapped' => false,
                
                'label' => 'Votre entreprise',
              
            ])
            ->add('job', TextType::class, [
                'label' => "Veulliez renseiger quelle poste est à pourvoir"
            ])
            ->add('content', TextareaType::class, [
                'label' => "veuiller renseigner votre annonce"
            ])
            ->add('salaire', TextType::class, [
                'label' => 'veuiller renseigner le salaire net mensuelle'
            ])
            ->add('annonce')

            ->add('submit', SubmitType::class, [
                'label' => "je poste mon annonce"
            ]);;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Annonces::class,
        ]);
    }
}
